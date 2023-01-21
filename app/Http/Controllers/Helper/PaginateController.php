<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaginateController extends Controller
{
    public static function paginate($data,$request = null,$resource = null){
        $items =  $data->items();
        if($request && $request['pagination']){
            $page = $request['pagination']['page']??$data->currentPage();
        }else{
            $page = $data->currentPage();
        }


        if(!is_null($resource))
        $items =  $resource::collection($items);
        $meta =  [
            'page' => $page,
            'pages' => $data->lastPage(),
            'perpage' => intval($data->perPage()),
            'total' => $data->total(),
        ];
        return response()->json([
            'status' =>true,
            'data' =>$items,
            'meta' => $meta
        ]);
    }
}
