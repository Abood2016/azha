<?php

namespace App\Traits;

use Illuminate\Pagination\Paginator;
trait PaginationOffset
{
    public function offset($total)
    {
        Paginator::currentPageResolver(function () {
            return request()->pagination['page'];
        });

        $offset = (request()->pagination['page'] - 1) * request()->pagination['perpage'];

        if ($offset >= $total) {
            $offset = 0;
            Paginator::currentPageResolver(function () {
                return 1;
            });
        }

        return $offset;
    }
}
