<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\PaginateController;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Algolia\AlgoliaSearch\Exceptions\NotFoundException;

class FreelancerServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $cancel = [2, 5, 6];
        $services = Service::whereNotIn('status', [ 0 , 3, 4])

            ->when(isset($request->status) && $request->status != 'null', function ($q) use ($request, $cancel) {
                if ($request->status == 2) {
                    return $q->whereIn('status', $cancel);
                }
                return $q->where('status', $request->status);
            })->orderBy('created_at', 'desc')->paginate($request->perpage ?? 10);
        return PaginateController::paginate($services, null, 'App\Http\Resources\ServiceResource');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {


        try {
            $service = Service::findOrFail($service->id);
            return response()->json([
                'status' => true,
                'data' => new ServiceResource($service)
            ]);
         } catch (NotFoundException $e) {
             return response()->json(['status' => 400, 'message' =>'There is not servcie ']);
         }



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
