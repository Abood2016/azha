<?php

namespace App\Filters;

use Illuminate\Support\Str;
use Closure;

class Filter
{
    public function handle($request, Closure $next)
    {
        if (is_null(request('query'))) {
            return $next($request);
        }

        $filterQuery = collect();

        foreach (request('query') as $index => $query) {
            if (Str::contains($index, 'filter.')) {
                $filterQuery->put($index, $query);
            }
        }

        $builder = $next($request);

        foreach ($filterQuery->toArray() as $index => $query) {
            $builder->search(Str::after($index, 'filter.'), $query);
        }

        return $builder;
    }
}
