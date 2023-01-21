<?php

namespace App\Filters;

use Closure;
use Illuminate\Support\Str;

class Sort
{
    public function handle($request, Closure $next)
    {
        $builder = $next($request);

        if (!request()->has('sort')) {
            return $builder->orderBy('id', 'desc');
        }
        
        if (str_contains(request()->sort['field'], '.')) {

            $table = strtolower(Str::after(get_class($builder->get()[0]), 'App\Models\\')) . 's';
            $before = Str::before(request()->sort['field'], '.');
            $after = Str::after(request()->sort['field'], '.');

            return $builder->select($table . '.*')
            ->join($before . 's', $before . 's' . '.id', '=', $table . '.' .  $before . '_id')
            ->orderBy($before . 's' . '.' . $after, request()->sort['sort']);

        }

        return $builder->orderBy(request()->sort['field'], request()->sort['sort']);
    }
}
