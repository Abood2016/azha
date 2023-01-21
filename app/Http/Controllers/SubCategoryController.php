<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helper\PaginateController;
use App\Http\Requests\SubCategoryRequest;
use App\Http\Resources\SubCategoryResource;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(Request $request)
    {


        if ($request->ajax()) {
            $subCategories = SubCategory::search($request);
            return PaginateController::paginate($subCategories, $request, 'App\Http\Resources\SubCategoryResource');
        }
        return view('pages.category.subcategory.index', [
            'page_title' => __('الأقسام الفرعية'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.category.subcategory.create', [
            'page_title' => __('أضافة قسم فرعي'),
            'categories' => Category::all(['id', 'name']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(SubCategoryRequest $subCategoryRequest)
    {

        SubCategory::create([
            'key' => $this->convert($subCategoryRequest->name),
            'name' => $subCategoryRequest->name,
            'category_id' => $subCategoryRequest->category_id,
            'active' => 1
        ]);

        return redirect()->route('sub-categories.index')->with(config('global.notification_add'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        return view('pages.category.subcategory.edit', [
            'page_title' => __('Edit') . ' ' . $subCategory->name,
            'subCategory' => $subCategory,
            'categories' => Category::all(['id', 'name']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoryRequest $subCategoryRequest, SubCategory $subCategory)
    {

        $subCategoryRequest->key = $this->convert($subCategoryRequest->name);
        $subCategory->name = $subCategoryRequest->name;
        $subCategory->category_id = $subCategoryRequest->category_id;

        $subCategory->save();

        return redirect()->route('sub-categories.index')->with(config('global.notification_edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, SubCategory $subCategory)
    {
        $subCategory->update([
            'active' => !$request->active
        ]);
    }

    public function delete(SubCategory $subCategory)
    {

        $subCategory->delete();
        return response()->json([
            'status' => true,
            'messages' => 'Sub Category has been deleted'
        ]);

    }

    public function convert($string)
    {
        $string = str_replace(" ", "_", $string);
        return strtolower($string);
    }
}
