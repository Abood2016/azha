<?php

namespace App\Filters;

use App\Models\User;
use Closure;
use Illuminate\Support\Str;

class Search
{
    public function handle($request, Closure $next)
    {
        if (is_null(request('query')) || is_null(array_values(request('query'))[0])) {
            return $next($request);
        }

        // // dd($next($request)->get());
        // foreach (request('query') as $index => $query) {
        //     foreach (explode(', ', $index) as $searchModel) {
        //         dd($searchModel);
        //         return $next($request)
        //             ->where('', 'like', "%{$query}%");
        //     }
        // }

        foreach (request('query') as $index => $searchQuery) {
            foreach (explode(', ', $index) as $attribute) {

                // $next($request)->when(
                //     str_contains($attribute, '.'),
                //     $next($request)
                //         ->orWhereHas(request('relation'), function ($query) use ($searchQuery, $attribute) {
                //             $query->where(Str::after($attribute, '.'), 'like', "%{$searchQuery}%");
                //         }),
                //     $next($request)
                //         ->where($attribute, 'like', "%{$searchQuery}%")
                // );

                $next($request)->when(
                    str_contains($attribute, '.'),
                    function ($query) use ($searchQuery, $attribute) {
                        foreach (explode(', ', request('relation')) as $relation) {
                            $query
                                ->orWhereHas($relation, function ($query) use ($searchQuery, $attribute) {
                                    $query->where(Str::afterLast($attribute, '.'), 'like', "%{$searchQuery}%");
                                });
                        }
                    },
                    function ($query) use ($searchQuery, $attribute) {
                        $query
                            ->where($attribute, 'like', "%{$searchQuery}%");
                    }
                );
            }
            // $tickets = $next($request)
            //     ->where('name', 'like', "%{$searchQuery}%")
            //     ->orWhereHas(request('relation'), function ($query) use ($searchQuery) {
            //         $query->where('name', 'like', "%{$searchQuery}%");
            //     });

            return $next($request);

            // dd(explode(', ', $index)[1]);
            // foreach (explode(', ', $index) as $searchModel) {
            // dd($searchModel);
            // $eloquent = 'App\Models\\' . explode(', ', $index)[1];
            // // dd(Str::ucfirst(request('relation')));
            // // dd($eloquent);
            // if (explode(', ', $index)[1] === Str::ucfirst(request('relation'))) {
            //     return $eloquent::search($query)->get()->load(request('relation'));
            // }
            // return $eloquent::search($query)->get()->load(request('relation'));
            // }
        }


        // $searchQuery = collect();

        // $model = request('model');

        // foreach (request('query') as $index => $query) {

        //     if (!Str::contains($index, 'filter')) {
        //         foreach (explode(', ', $index) as $searchModel) {

        //             $users = User::search($query)->get();

        //             if ($searchModel === 'Customer') {
        //                 $this->searchForUser($users, 'customer', $model, $searchQuery);
        //             } else if ($searchModel === 'Driver') {
        //                 $this->searchForUser($users, 'driver', $model, $searchQuery);
        //             } else {

        //                 $eloquent = 'App\Models\\' . $searchModel;

        //                 if (Str::lower(Str::plural($searchModel)) === $model) {

        //                     foreach ($this->search($eloquent, $query) as $value) {
        //                         $searchQuery->push($value);
        //                     }

        //                     return $searchQuery->flatten();
        //                 } else {

        //                     if ($eloquent === 'App\Models\Payable') {
        //                         $eloquent = 'App\Models\User';
        //                     }

        //                     $values = is_null($model) ? $this->search($eloquent, $query) : $this->search($eloquent, $query)->load($model);

        //                     foreach ($values as $value) {
        //                         if (is_null($model)) {
        //                             $searchQuery->push($value);
        //                         } else {

        //                             $searchQuery->push($value->$model->load(Str::lower($searchModel)));
        //                         }
        //                     }

        //                     return $searchQuery->flatten();
        //                 }
        //             }
        //         }
        //     }
        // }

        // return $searchQuery->flatten();
    }

    // protected function searchForUser($users, $type, $model, $searchQuery)
    // {
    //     foreach ($users as $user) {
    //         if ($user->$type()->exists()) {
    //             if (is_null($model)) {
    //                 $searchQuery->push($user->$type()->first());
    //             } else {
    //                 $searchQuery->push($user->$type()->with($model)->first()->$model()->get());
    //             }
    //         }
    //     }
    // }

    // protected function search($eloquent, $query)
    // {
    //     return $eloquent::search($query)->get();
    // }
}
