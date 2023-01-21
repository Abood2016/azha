<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\PaginateController;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){

            $sliders = Slider::paginate();
           return PaginateController::paginate($sliders,$request);

        }

        return view('pages.slider.index', [
            'page_title' => __('البنرات'),
        ]);
    }
    public function create(){

        return view('pages.slider.create', [
            'page_title' => __('أضافة بنر جديد')
        ]);
    }
    public function store(Request $request){
        $rules = Slider::$rules;
        $rules += ['image' => 'required|mimes:jpeg,jpg,png|max:10000'];
        $request->validate($rules);
        $imageName = time() . '.' . $request->image->getClientOriginalName();
        $request->file('image')->storeAs('sliders', $imageName);
        $slider = Slider::create([
           'name' => $request->name,
           'image' => $imageName,
        ]);
        return back()->with(config('global.notification_add'));
    }
    public function update(Request $request,Slider $slider){
        $rules = Slider::$rules;

        $request->validate($rules);
        if($request->image){
            unlink(base_path().'/storage/app/public/sliders/'. $slider->image);
            $imageName = time() . '.' . $request->image->getClientOriginalName();
            $request->file('image')->storeAs('sliders', $imageName);
        }

        $slider->update([
            'name' => $request->name,
            'image' => $request->image?$imageName:$slider->image
        ]);
        return back()->with(config('global.notification_edit'));
    }
//    public function show(Request $request ,Slider $slider){
//       return $this->update($request,$slider);
//
//    }
    public function edit(Slider $slider){

        return view('pages.slider.edit', [
            'page_title' => __('Edit') . ' ' . $slider->name,
            'slider' => $slider,
        ]);
    }
    public function destroy(Slider $slider){
        unlink(base_path().'/storage/app/public/sliders/'. $slider->image);
        $slider->delete();
        return response()->json([
            'status' => true,
            'messages' => 'Slider has been deleted'
        ]);
    }
    public function makeActive(Slider $slider){
        $slider->update([
            'is_active' => !$slider->is_active
        ]);
        return response()->json([
            'status' => true,
        ]);
    }
}
