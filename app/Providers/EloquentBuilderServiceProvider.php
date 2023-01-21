<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class EloquentBuilderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('search', function ($attributes, string $searchTerm) {
            $this->where(function (Builder $query) use ($attributes, $searchTerm) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->when(
                        str_contains($attribute, '.'),
                        function (Builder $query) use ($attribute, $searchTerm) {
                            if (substr_count($attribute, '.') === 1) {
                                [$relationName, $relationAttribute] = explode('.', $attribute);

                                $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $searchTerm) {
                                    $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                                });
                            } else {

                                [$relationName, $relationAttribute, $extraRelationName, $extraRelationAttribute] = explode('.', $attribute);

                                $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $extraRelationName, $extraRelationAttribute, $searchTerm) {
                                    $query->orWhereHas($relationAttribute, function (Builder $query) use ($extraRelationName, $extraRelationAttribute, $searchTerm) {
                                        $query->orWhereHas($extraRelationName, function (Builder $query) use ($extraRelationAttribute, $searchTerm) {
                                            $query->where($extraRelationAttribute, 'LIKE', "%{$searchTerm}%");
                                        });
                                    });
                                });
                            }
                        },
                        function (Builder $query) use ($attribute, $searchTerm) {
                            dd('here');
                            $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                        }
                    );
                    // }
                }
            });

            return $this;
        });
    }
}
