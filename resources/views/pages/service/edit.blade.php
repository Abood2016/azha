@extends('layouts.default')

@section('content')
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <x-metronic.form-card action="{{ route('services.update', $service) }}" method="POST"
            enctype="multipart/form-data" update-form="on">
            <x-slot name="body">
                <div class="form-group row">
                    <div class="col-12 mb-4">
                        <x-metronic.label for="avatar" value="{{ __('Image') }}" />
                        <div class="col-9 p-0">
                            <div class="image-input" id="image">
                                <div class="image-input-wrapper" style="background-image: url({{ $service->image }})">
                                </div>

                                <label
                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="change" data-toggle="tooltip" title=""
                                    data-original-title="Change logo">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="image" accept=".png, .jpg, .jpeg, .svg"
                                        value="{{ old('image', $service->image) }}" />
                                </label>

                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                        </div>
                        <x-metronic.input-error for="image" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="category_id" value="{{ __('Sub Category') }}" />
                        <div class="mt-1">
                            <x-metronic.select name="category_id" data-size="7" data-live-search="true" title="Select">
                                @foreach ($categories as $category)
                                <x-metronic.select-option value="{{ $category->id }}" :loop-id="$category->id"
                                    :selected-id="$service->category_id">
                                    {{ $category->name }}
                                </x-metronic.select-option>
                                @endforeach
                            </x-metronic.select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="name" value="{{ __('Name') }}" />
                        <x-metronic.input value="{{ old('name', $service->name) }}" id="name" name="name" type="text"
                            class="mt-1 block w-full" autocomplete="name" />
                        <x-metronic.input-error for="name" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="base_fare" value="{{ __('Base Fare') }}" />
                        <x-metronic.input id="base_fare" name="base_fare" type="number" class="mt-1 block w-full"
                            autocomplete="base_fare" value="{{ old('base_fare', $service->base_fare) }}" />
                        <x-metronic.input-error for="base_fare" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="minimum_fare" value="{{ __('Minimum Fare') }}" />
                        <x-metronic.input id="minimum_fare" name="minimum_fare" type="number" class="mt-1 block w-full"
                            autocomplete="minimum_fare" value="{{ old('minimum_fare', $service->minimum_fare) }}" />
                        <x-metronic.input-error for="minimum_fare" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="per_minute" value="{{ __('Per Minute') }}" />
                        <x-metronic.input id="per_minute" name="per_minute" type="number" class="mt-1 block w-full"
                            autocomplete="per_minute" value="{{ old('per_minute', $service->per_minute) }}" />
                        <x-metronic.input-error for="per_minute" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="per_km" value="{{ __('Per Km') }}" />
                        <x-metronic.input id="per_km" name="per_km" type="number" class="mt-1 block w-full"
                            autocomplete="per_km" value="{{ old('per_km', $service->per_km) }}" />
                        <x-metronic.input-error for="per_km" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="commission" value="{{ __('Commission') }}" />
                        <x-metronic.input id="commission" name="commission" type="number" class="mt-1 block w-full"
                            autocomplete="commission" value="{{ old('commission', $service->commission) }}" />
                        <x-metronic.input-error for="commission" class="mt-2" />
                    </div>
                </div>
            </x-slot>
        </x-metronic.form-card>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('select').selectpicker();
    new KTImageInput("image");
</script>
@endsection