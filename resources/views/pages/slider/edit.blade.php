@extends('layouts.default')

@section('content')
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            @include('layouts.alert.session')
            <x-metronic.form-card action="/sliders/{{$slider->id}}" method="POST" enctype="multipart/form-data">
                <x-slot name="body">
                    <div class="form-group row">
                        <div class="col-12 mb-4">
                            <x-metronic.label for="avatar" value="{{ __('Avatar') }}" />
                            <div class="col-9 p-0">
                                <div class="image-input image-input-empty image-input-outline" id="avatar"
                                     style="background-image: url({{  $slider->image_path }})">
                                    <div class="image-input-wrapper"></div>
                                    <label
                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                            data-action="change" data-toggle="tooltip" title=""
                                            data-original-title="Change image">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="image" accept=".png, .jpg, .jpeg" />
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
                            <x-metronic.input-error for="image" class="mt-2" />
                        </div>
                        <div class="col-lg-12 col-sm-12 mb-4">
                            <x-metronic.label for="name" value="{{ __('Name') }}" />
                            <x-metronic.input id="name" name="name" type="text" class="mt-1 block w-full"
                                              autocomplete="name" value="{{ $slider->name }}" />
                            <x-metronic.input-error for="name" class="mt-2" />
                        </div>
                    </div>
                </x-slot>
            </x-metronic.form-card>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        new KTImageInput("avatar");

    </script>
@endsection