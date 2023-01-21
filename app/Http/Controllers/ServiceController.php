<?php

namespace App\Http\Controllers;

use App\Actions\App\ValidateAndStoreImage;
use App\Http\Controllers\Helper\PaginateController;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $services = Service::search($request);
            return PaginateController::paginate($services, $request, 'App\Http\Resources\ServiceResource');
        }
        return view('pages.service.index', [
            'page_title' => __('الخدمات'),
        ]);

    }

    public function show(Service $service)
    {
        $service = (new ServiceResource($service))->resolve();
        return view('pages.service.show', [
            'service' => $service
        ]);
    }

    public function create()
    {
        //
    }

    public function store(ServiceRequest $serviceRequest, ValidateAndStoreImage $validateAndStoreImage)
    {

        $category = Category::findOrFail($serviceRequest->category_id);

        $category->services()->create(
            $serviceRequest->validated() +
            $validateAndStoreImage->store('image', 'services', ['dimensions:width=17, height=34', 'max:2048'])
        );

        return redirect()->route('services.index');
    }

    public function edit(Service $service)
    {
        return view(
            'pages.service.edit',
            [
                'page_title' => __('Edit') . ' ' . $service->name,
                'service' => $service,
                'categories' => Category::select('id', 'name')->get()
            ]
        );
    }

    public function update(Request $request)
    {

        $service = Service::find($request->id);
        $service->update(['status' => Service::$cancelByAdmin]);

    }


}
