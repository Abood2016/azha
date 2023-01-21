<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public $guarded = [];
    public static function search($request){
        $sort_field  = $request['sort']['field']??'id';
        $sort_type  = $request['sort']['sort']??'desc';
        $enum = [0,1];
        $page = $request['pagination']['page']??1;
        $qeury = $request['query']?$request['query']['query']:null;
        return self::when($qeury, function ($q) use ($request,$qeury)  {
            return $q->where('name', 'like', '%' . $qeury . '%')
                ->orWhere('id',$qeury);
        })->orderBy($sort_field,$sort_type)->paginate($request['pagination']['perpage']??10,'*','page',$page);
    }

}
