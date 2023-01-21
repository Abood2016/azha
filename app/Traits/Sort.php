<?php

namespace App\Traits;

use App\Filters\Filter;
use App\Filters\Search;
use App\Filters\Sort as FiltersSort;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;

trait Sort
{
    public function sort($model)
    {
        if ($model instanceof Model) {
            $model = $model::query();
        }

        return app(Pipeline::class)
            ->send($model)
            ->through([
                FiltersSort::class,
                Search::class,
                Filter::class
            ])
            ->thenReturn();
    }
}
