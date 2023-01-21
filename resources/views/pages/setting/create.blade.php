@extends('layouts.default')
@section('head_script')
    <script src="https://cdn.ckeditor.com/ckeditor5/12.3.1/classic/ckeditor.js"></script>
@endsection
@section('content')
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <x-metronic.form-card action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
                <x-slot name="body">


                        {{-- <div class="col-12 mb-4">

                            <x-metronic.label for="avatar" value="{{ __('Logo') }}"/>
                            <div class="col-9 p-0">
                                <div class="image-input" id="kt_image_2">
                                    <div class="image-input-wrapper"
                                         style="background-image: url({{ $settings->logo }})">
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
                        </div> --}}
                        {{-- <div class="col-lg-1 col-sm-12 mb-4">
                            <x-metronic.label for="color" value="{{ __('Color') }}"/>
                            <x-metronic.input id="color" name="color" type="color" class="mt-1 block w-full"
                                              value="{{ isset($settings->color) }}"/>
                            <x-metronic.input-error for="color" class="mt-2"/>
                        </div> --}}



                    <div class="form-group row">

                        <div class="col-4 mb-4">
                            <label>{{__('من نحن')}}</label>
                            <textarea class="form-control" name="about_us" rows="10">
                                {{$settings?$settings->about_us:''}}
                            </textarea>
                        </div>


                        <div class="col-4 mb-4">
                            <label>{{__('سياسة الخصوصية')}}</label>
                            <textarea class="form-control" name="privacy" rows="10">
                                {{$settings?$settings->privacy:''}}
                            </textarea>
                        </div>


                        <div class="col-4 mb-4">
                            <label>{{__('الأحكام والشروط')}}</label>
                            <textarea class="form-control" name="terms" rows="10">
                                {{$settings?$settings->terms:''}}
                            </textarea>
                        </div>



                        <div class="col-4 mb-4">

                            <label>{{__('فيسبوك')}}</label>
                            <input class="form-control" name="url_facebook" type="text"
                                   value="{{$settings?$settings->url_facebook:''}}">


                        </div>

                        <div class="col-4 mb-4">
                            <label>{{__('انستقرام')}}</label>
                            <input class="form-control" name="url_facebook" type="text"
                                   value="{{$settings?$settings->url_instagram:''}}">

                        </div>
                        <div class="col-4 mb-4">

                            <label>{{__('تويتر')}}</label>
                            <input class="form-control" name="url_twitter" type="text"
                                   value="{{$settings?$settings->url_twitter:''}}">

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
        // Class definition

        var KTCkeditor = function () {
            // Private functions
            var demos = function () {
                ClassicEditor
                    .create(document.querySelector('#kt-ckeditor-5'))
                    .then(editor => {
                        console.log(editor);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            } // Private functions
            var demos1 = function () {
                ClassicEditor
                    .create(document.querySelector('#kt-ckeditor-6'))
                    .then(editor => {
                        console.log(editor);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }

            return {
                // public functions
                init: function () {
                    demos();
                    demos1();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function () {
            KTCkeditor.init();
        });
    </script>
@endsection
