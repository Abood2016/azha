<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\PaginateController;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Facade\FlareClient\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::search($request);
            return PaginateController::paginate($categories, $request, 'App\Http\Resources\CategoryResource');
        }
        return view('pages.category.index', [
            'page_title' => __('الأقسام'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.category.create', [
            'page_title' => __('أضافة قسم'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(CategoryRequest $categoryRequest)
    {
        $imageName = time() . '.' . $categoryRequest->image->getClientOriginalName();
        $categoryRequest->file('image')->storeAs('categories', $imageName);

        Category::create([
            'key' => $this->convert($categoryRequest->name),
            'name' => $categoryRequest->name,
            'image' => $imageName,
            'active' => 1
        ]);
        return redirect()->route('categories.index')->with(config('global.notification_add'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('pages.category.edit', [
            'page_title' => __('Edit') . ' ' . $category->name,
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $updateCategoryRequest, Category $category)
    {

        $imageName = null;

        if ($updateCategoryRequest->image) {
            if ($category->image != 'https://icons.iconarchive.com/icons/guillendesign/variations-3/256/Default-Icon-icon.png')
                unlink(base_path() . '/storage/app/public/categories/' . $category->image);
            $imageName = time() . '.' . $updateCategoryRequest->image->getClientOriginalName();
            $updateCategoryRequest->file('image')->storeAs('categories', $imageName);
        }

        $category->key = $this->convert($updateCategoryRequest->name);
        $category->name = $updateCategoryRequest->name;
        $category->image = $imageName ?? $category->image;

        $category->save();

        return redirect()->route('categories.index')->with(config('global.notification_edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {
        $category->update([
            'active' => !$request->active
        ]);
    }

    public function delete(Category $category)
    {
        $category->delete();
        return response()->json([
            'status' => true,
            'messages' => 'Category has been deleted'
        ]);

    }

    public function convert($string)
    {
        $string = str_replace(" ", "_", $string);
        return strtolower($string);
    }

}
