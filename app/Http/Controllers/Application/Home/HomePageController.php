<?php

namespace App\Http\Controllers\Application\Home;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\PaginateController;
use App\Http\Resources\SliderReosurce;
use App\Http\Resources\TypeReosurce;
use App\Models\Category;
use App\Models\Place;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Type;
use App\Traits\GetIndexData;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
   public function index(){
       $sliders = $this->section_sliders();
//       $types = $this->section_types();
         return response()->json([
           'status' =>true,
           'data' =>$sliders
       ]);
   }
    public function section_sliders(){
        $sliders_collect = collect();
        $sliders = Slider::where('is_active',1)->get();
        return $sliders_collect->add(['data_type'=>'sliders','title' => __(''),'content' =>SliderReosurce::collection($sliders)]);
    }
    public function section_types(){
        $types_collect = collect();
        $types = Type::where('active',1)->get();
        return  $types_collect->add(['data_type'=>'types','title' => __('Types'),'content' =>TypeReosurce::collection($types)]);
    }

    public function search(Request $request){

        if($request->header('freelancer')){
            $data =  Category::query()->where('name', $request->name )->get();
        }else{
            $data = Service::where('name', 'LIKE', '%'. $request->name .'%')->where('status' , 1)->get();
        }
        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

}
