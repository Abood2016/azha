@extends('layouts.default')

@section('content')
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <x-metronic.form-card action="{{ route('driver.notification.store') }}" method="POST"
            enctype="multipart/form-data">
            <x-slot name="body">
                <div class="form-group row">
                    <div class="col-12 mb-4">
                        <x-metronic.label for="avatar" value="{{ __('Image') }}" />

                        <div class="col-9 p-0">
                            <div class="image-input image-input-empty image-input-outline" id="image"
                                style="background-image: url({{ global_asset('media/users/blank.png') }})">
                                <div class="image-input-wrapper"></div>
                                <label
                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="change" data-toggle="tooltip" title=""
                                    data-original-title="Change image">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                    <x-metronic.input-error for="image" class="mt-2" />
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="cancel" data-toggle="tooltip" title="Cancel image">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="remove" data-toggle="tooltip" title="Remove image">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-12 col-sm-12 mb-4">
                        <div class="form-group">
                            <x-metronic.label for="customer_id" value="{{ __('Driver') }}" />
                            <div class="mt-1">

                                <x-metronic.select name="driver_id" data-size="7" data-live-search="true"
                                    title="Select Driver">
                                    <x-metronic.select-option value="-1" select-name="driver_id"
                                                              :loop-id="-1">
                                        All Drivers
                                    </x-metronic.select-option>
                                    @foreach ($drivers as $driver)
                                    <x-metronic.select-option value="{{ $driver->id }}" select-name="driver_id"
                                        :loop-id="$driver->id">
                                        {{ $driver->user->name }}
                                    </x-metronic.select-option>
                                    @endforeach
                                </x-metronic.select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <div class="form-group">
                            <x-metronic.label for="title_ar" value="{{ __('Title Ar') }}" />
                            <x-metronic.input id="title_ar" name="title_ar" type="text" class="mt-1 block w-full"
                                              autocomplete="title_ar" />
                            <x-metronic.input-error for="title_ar" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <div class="form-group">
                            <x-metronic.label for="title_en" value="{{ __('Title En') }}" />
                            <x-metronic.input id="title_en" name="title_en" type="text" class="mt-1 block w-full"
                                              autocomplete="title_en" />
                            <x-metronic.input-error for="title_en" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="body_ar" value="{{ __('Body Ar') }}" />
                        <x-metronic.textarea id="body_ar" name="body_ar" class="mt-1 block w-full" autocomplete="body_ar" />
                        <x-metronic.input-error for="body_ar" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="body_en" value="{{ __('Body En') }}" />
                        <x-metronic.textarea id="body_en" name="body_en" class="mt-1 block w-full" autocomplete="body_en" />
                        <x-metronic.input-error for="body_en" class="mt-2" />
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
