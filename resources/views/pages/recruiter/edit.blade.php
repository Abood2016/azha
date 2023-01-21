@extends('layouts.default')

@section('content')
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <x-metronic.form-card action="{{ route('recruiters.update', $recruiter) }}" method="POST"
            enctype="multipart/form-data" update-form="on">
            <x-slot name="body">
                <div class="form-group row">
                    <div class="col-12 mb-4">
                        <x-metronic.label for="avatar" value="{{ __('Avatar') }}" />
                        <div class="col-9 p-0">
                            <div class="image-input image-input-empty image-input-outline" id="avatar"
                                style="background-image: url({{ $recruiter->user->profile_photo_url }})">
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
                        <x-metronic.label for="name" value="{{ __('الأسم') }}" />
                        <x-metronic.input id="name" name="name" value="{{ old('name', $recruiter->user->name) }}"
                            type="text" class="mt-1 block w-full" autocomplete="name" />
                        <x-metronic.input-error for="name" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="phone" value="{{ __('رقم الجوال') }}" />
                        <x-metronic.input id="phone" name="phone" value="{{ old('phone', $recruiter->user->phone) }}"
                            type="tel" class="mt-1 block w-full" autocomplete="phone" />
                        <x-metronic.input-error for="phone" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="email" value="{{ __('البريد الألكتروني ') }}" />
                        <x-metronic.input id="email" name="email" value="{{ old('email', $recruiter->user->email) }}"
                            type="email" class="mt-1 block w-full" autocomplete="email" />
                        <x-metronic.input-error for="email" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="licence_number" value="{{ __('كلمة المرور') }}" />
                        <x-metronic.input id="password" name="password"
                            value="{{ old('password', $recruiter->password) }}" type="password"
                            class="mt-1 block w-full" autocomplete="password" />
                        <x-metronic.input-error for="password" class="mt-2" />
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
