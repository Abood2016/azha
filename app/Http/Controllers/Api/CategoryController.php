<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\PaginateController;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {

        $categories  = Category::get();
        return response()->json([
            'status' => true,
            'data' => $categories
        ]);
        die();
        return new CategoryResource($categories);

        die();
        $page = request('page') ?? 1;
        $categories  = Category::orderBy('created_at', 'desc')
            ->paginate(request('perpage') ?? 10, '*', 'page', $page);

        return PaginateController::paginate($categories, $request, null, true);
    }

    public function subCategory(Category $category){
        $getSubCategories = SubCategory::where('category_id' , $category->id)->get();
        return response()->json([
            'status' => true,
            'data' => $getSubCategories
        ]);
    }

}
