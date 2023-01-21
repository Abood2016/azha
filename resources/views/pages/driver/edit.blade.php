@extends('layouts.default')

@section('content')
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <x-metronic.form-card action="{{ route('drivers.update', $driver) }}" method="POST"
            enctype="multipart/form-data" update-form="on">
            <x-slot name="body">
                <div class="form-group row">
                    <div class="col-12 mb-4">
                        <x-metronic.label for="avatar" value="{{ __('Avatar') }}" />
                        <div class="col-9 p-0">
                            <div class="image-input image-input-empty image-input-outline" id="avatar"
                                style="background-image: url({{ $driver->user->profile_photo_url }})">
                                <div class="image-input-wrapper"></div>
                                <label
                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="change" data-toggle="tooltip" title=""
                                    data-original-title="Change image">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="photo" accept=".png, .jpg, .jpeg" />
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
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="name" value="{{ __('Name') }}" />
                        <x-metronic.input id="name" name="name" value="{{ old('name', $driver->user->name) }}"
                            type="text" class="mt-1 block w-full" autocomplete="name" />
                        <x-metronic.input-error for="name" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="phone" value="{{ __('Phone Number') }}" />
                        <x-metronic.input id="phone" name="phone" value="{{ old('phone', $driver->user->phone) }}"
                            type="tel" class="mt-1 block w-full" autocomplete="phone" />
                        <x-metronic.input-error for="phone" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="email" value="{{ __('Email Address') }}" />
                        <x-metronic.input id="email" name="email" value="{{ old('email', $driver->user->email) }}"
                            type="email" class="mt-1 block w-full" autocomplete="email" />
                        <x-metronic.input-error for="email" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="licence_number" value="{{ __('Licence Number') }}" />
                        <x-metronic.input id="licence_number" name="licence_number"
                            value="{{ old('licence_number', $driver->licence_number) }}" type="text"
                            class="mt-1 block w-full" autocomplete="licence_number" />
                        <x-metronic.input-error for="licence_number" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="licence_expire_date" value="{{ __('Licence Expire Date') }}" />
                        <x-metronic.input id="licence_expire_date" name="licence_expire_date"
                            value="{{ old('licence_expire_date', $driver->licence_expire_date) }}" type="text"
                            class="mt-1 block w-full" readonly />
                        <x-metronic.input-error for="licence_expire_date" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="vehicle_brand" value="{{ __('Vehicle Brand') }}" />
                        <x-metronic.input id="vehicle_brand" name="vehicle_brand"
                            value="{{ old('vehicle_brand', $driver->vehicle_brand) }}" type="text"
                            class="mt-1 block w-full" autocomplete="vehicle_brand" />
                        <x-metronic.input-error for="vehicle_brand" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="vehicle_model" value="{{ __('Vehicle Model') }}" />
                        <x-metronic.input id="vehicle_model" name="vehicle_model"
                            value="{{ old('vehicle_model', $driver->vehicle_model) }}" type="text"
                            class="mt-1 block w-full" autocomplete="vehicle_model" />
                        <x-metronic.input-error for="vehicle_model" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="vehicle_name" value="{{ __('Vehicle Name') }}" />
                        <x-metronic.input id="vehicle_name" name="vehicle_name"
                            value="{{ old('vehicle_name', $driver->vehicle_name) }}" type="text"
                            class="mt-1 block w-full" autocomplete="vehicle_name" />
                        <x-metronic.input-error for="vehicle_name" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="vehicle_color" value="{{ __('Vehicle Color') }}" />
                        <x-metronic.input id="vehicle_color" name="vehicle_color"
                            value="{{ old('vehicle_color', $driver->vehicle_color) }}" type="text"
                            class="mt-1 block w-full" autocomplete="vehicle_color" />
                        <x-metronic.input-error for="vehicle_color" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="vehicle_registration_number"
                            value="{{ __('Vehicle Registration Number') }}" />
                        <x-metronic.input id="vehicle_registration_number" name="vehicle_registration_number"
                            value="{{ old('vehicle_registration_number', $driver->vehicle_registration_number) }}"
                            type="text" class="mt-1 block w-full" autocomplete="vehicle_registration_number" />
                        <x-metronic.input-error for="vehicle_registration_number" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="vehicle_purchase_year" value="{{ __('Vehicle Purchase Year') }}" />
                        <x-metronic.input id="vehicle_purchase_year" name="vehicle_purchase_year"
                            value="{{ old('vehicle_purchase_year', $driver->vehicle_purchase_year) }}" type="text"
                            class="mt-1 block w-full" readonly />
                        <x-metronic.input-error for="vehicle_purchase_year" class="mt-2" />
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
    new KTImageInput("avatar");
    $('#vehicle_purchase_year').datepicker({
        autoclose: true,
        minViewMode: 2,
        format: 'yyyy',
        endDate: new Date().getFullYear().toString()
    });
    $('#licence_expire_date').datepicker({
        autoclose: true,
        todayHighlight: true,
        orientation: 'bottom',
        format: 'd/m/yyyy',
        startDate: new Date()
    });
</script>
@endsection