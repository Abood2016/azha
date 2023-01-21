<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UserIdFromRequest
{
    public function getUser()
    {
        return !in_array('POST', $this->route()->methods) ?
        $this->route()->parameter(Str::replaceLast('s', '', Str::before($this->route()->uri, '/')))->user->id : '';
    }
}