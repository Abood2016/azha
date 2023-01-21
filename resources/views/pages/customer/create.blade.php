@extends('layouts.default')

@section('content')
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <x-metronic.form-card action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
            <x-slot name="body">
                <div class="form-group row">
                    <div class="col-12 mb-4">
                        <x-metronic.label for="avatar" value="{{ __('Avatar') }}" />
                        <div class="col-9 p-0">
                            <div class="image-input image-input-empty image-input-outline" id="avatar"
                                style="background-image: url({{ global_asset('media/users/blank.png') }})">
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
                        <x-metronic.input id="name" name="name" type="text" class="mt-1 block w-full"
                            autocomplete="name" />
                        <x-metronic.input-error for="name" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="phone" value="{{ __('Phone Number') }}" />
                        <x-metronic.input id="phone" name="phone" type="tel" class="mt-1 block w-full"
                            autocomplete="phone" />
                        <x-metronic.input-error for="phone" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="email" value="{{ __('Email Address') }}" />
                        <x-metronic.input id="email" name="email" type="email" class="mt-1 block w-full"
                            autocomplete="email" />
                        <x-metronic.input-error for="email" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="gender" value="{{ __('Gender') }}" />
                        <x-metronic.select name="gender" data-size="7" data-live-search="true" title="Select Gender">
                            <x-metronic.select-option value="Male" select-name="gender" loop-id="Male">
                                {{ __('Male') }}
                            </x-metronic.select-option>
                            <x-metronic.select-option value="Fmale" select-name="gender" loop-id="Fmale">
                                {{ __('Fmale') }}
                            </x-metronic.select-option>
                        </x-metronic.select>
                        <x-metronic.input-error for="gender" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="address" value="{{ __('Address') }}" />
                        <x-metronic.input id="address" name="address" type="text" class="mt-1 block w-full" />
                        <x-metronic.input-error for="address" class="mt-2" />
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
</script>
@endsection