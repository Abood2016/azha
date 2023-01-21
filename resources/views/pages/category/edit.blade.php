@extends('layouts.default')

@section('content')
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <x-metronic.label for="name" value="{{ __('Image') }}" />
                        <div class="col-9 p-0">
                            <div class="image-input image-input-empty image-input-outline" id="image"
                                style="background-image: url({{ $category->image_path }})">
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
                    </div>
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <x-metronic.label for="name" value="{{ __('Name') }}" />
                            <x-metronic.input value="{{ old('name', $category->name) }}" id="name" name="name" type="text" class="mt-1 block w-full" autocomplete="name_ar" />
                            <x-metronic.input-error for="name" class="mt-2" />
                        </div>

                    </div>

                </div>
                <div class="card-footer">
                    <x-metronic.secondary-button data-dismiss="modal" wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-metronic.secondary-button>

                    <x-metronic.button class="ml-2" wire:loading.attr="disabled">
                        {{ __('Save') }}
                    </x-metronic.button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    new KTImageInput("image");
    // Class definition

    var KTBootstrapSwitch = function() {

// Private functions
        var demos = function() {
            // minimum setup
            $('[data-switch=true]').bootstrapSwitch();
        };

        return {
            // public functions
            init: function() {
                demos();
            },
        };
    }();

    jQuery(document).ready(function() {
        KTBootstrapSwitch.init();
    });
</script>
@endsection
