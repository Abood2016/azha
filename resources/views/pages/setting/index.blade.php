@extends('layouts.default')

@section('content')
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <x-metronic.form-card action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
                <x-slot name="body">
                    <div class="form-group row">
                        <div class="col-12 mb-4">

                            <x-metronic.label for="avatar" value="{{ __('Logo') }}"/>
                            <div class="col-9 p-0">
                                <div class="image-input" id="kt_image_2">
                                    <div class="image-input-wrapper"
                                         style="background-image: url({{ $settings[0]->logo }})">
                                    </div>

                                    <label
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="change" data-toggle="tooltip" title=""
                                        data-original-title="Change logo">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="logo" accept=".png, .jpg, .jpeg"/>
                                    </label>

                                    <span
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                                </div>
                            </div>
                            <x-metronic.input-error for="logo" class="mt-2"/>
                        </div>
                        <div class="col-lg-1 col-sm-12 mb-4">
                            <x-metronic.label for="color" value="{{ __('Color') }}"/>
                            <x-metronic.input id="color" name="color" type="color" class="mt-1 block w-full"
                                              value="{{ isset($settings[0]->color) }}"/>
                            <x-metronic.input-error for="color" class="mt-2"/>
                        </div>
                    </div>
                </x-slot>
            </x-metronic.form-card>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection

@section('scripts')
    <script>
        var avatar2 = new KTImageInput('kt_image_2');
    </script>
@endsection
