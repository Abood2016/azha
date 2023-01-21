<?php

namespace App\Http\Controllers\Application\Type;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\PaginateController;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function show(Request $request, Type $type)
    {
        $places = $type->places()->when($request->search, function ($q) use ($request) {
            return $q->where('name', 'LIKE', '%' . $request->search . '%');
        })->paginate(20);
        return PaginateController::paginate($places, null, 'App\Http\Resources\PlaceResource');

    }
}
