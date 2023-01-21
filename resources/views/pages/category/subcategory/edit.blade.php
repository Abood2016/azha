@extends('layouts.default')

@section('content')
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <form action="{{ route('sub-categories.update', $subCategory) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <x-metronic.label for="name" value="{{ __('اسم القسم الفرعي') }}" />
                            <x-metronic.input value="{{ old('name', $subCategory->name) }}" id="name" name="name" type="text" class="mt-1 block w-full" autocomplete="name_ar" />
                            <x-metronic.input-error for="name" class="mt-2" />
                        </div>

                        <div class="col-lg-6 form-group">
                            <x-metronic.label for="category_id" value="{{ __('القسم الرئيسي') }}" />
                            <div class="mt-1">

                                <x-metronic.select name="category_id" data-size="7" data-live-search="true"
                                                   title="Select Category">

                                    @foreach ($categories as $category)
                                        <x-metronic.select-option value="{{old('category_id' , $category->id)}}" select-name="category_id"
                                                                  :loop-id="$category->id">
                                            {{ old('category_id' , $category->name) }}
                                        </x-metronic.select-option>
                                    @endforeach
                                </x-metronic.select>
                                <x-metronic.input-error for="category_id" class="mt-2" />
                            </div>
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
