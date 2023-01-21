<?php

namespace App\Http\Controllers\Application\Place;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\PaginateController;
use App\Jobs\CollectingPlaces;
use App\Models\Place;
use App\Models\Type;
use Illuminate\Http\Request;
use Validator;
class PlaceController extends Controller
{
    public function index(Request $request){
        $places = Place::search($request,true);
        return PaginateController::paginate($places,$request,'App\Http\Resources\PlaceResource');
    }
    public function store(Request $request){
        $rules = ['places' =>'required|array'];
        $valditor = Validator::make($request->all(), $rules);
        if ($valditor->fails()) {
            return response()->json($valditor->errors(), 401);
        }
        CollectingPlaces::dispatch($request->all());
        return response()->json([
            'status' =>true,
        ]);
    }
}
