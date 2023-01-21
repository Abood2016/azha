@extends('layouts.default')

@section('content')
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        @include('layouts.alert.session')
        <x-metronic.form-card action="{{ route('admins.store') }}" method="POST" enctype="multipart/form-data">
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
                            autocomplete="name" value="{{ old('name') }}" />
                        <x-metronic.input-error for="name" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="email" value="{{ __('Email Address') }}" />
                        <x-metronic.input id="email" name="email" type="email" class="mt-1 block w-full"
                            autocomplete="email" value="{{ old('email') }}"/>
                        <x-metronic.input-error for="email" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="password" value="{{ __('Password') }}" />
                        <x-metronic.input id="password" name="password" type="password" class="mt-1 block w-full"
                                          autocomplete="name" value="{{ old('password') }}" />
                        <x-metronic.input-error for="password" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="confirm_password" value="{{ __('Confirm Password') }}" />
                        <x-metronic.input id="confirm_password" name="confirm_password" type="password" class="mt-1 block w-full"
                                          autocomplete="confirm_password" value="{{ old('confirm_password') }}" />
                        <x-metronic.input-error for="confirm_password" class="mt-2" />
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <x-metronic.label for="role_id" value="{{ __('Roles') }}" />
                        <select class="form-control select2" id="kt_select2_3" name="role_id" >
                            @foreach($roles as $role)
                                <option value="{{$role->id}}"  {{ old('role_id') == $role->id ? "selected" : "" }} data-is_business="{{$role->is_business}}"  >{{$role->display_name}}</option>
                            @endforeach
                        </select>
                        <x-metronic.input-error for="role_id" class="mt-2" />
                    </div>

{{--                    <div class="col-lg-6 col-sm-12 mb-4" >--}}
{{--                        <div class="form-group">--}}
{{--                            <x-metronic.label for="place_id" value="{{ __('Business') }}" />--}}
{{--                            <div class="mt-1">--}}
{{--                                <input type="hidden" value="1" name="business" id="inputDisabled">--}}
{{--                                <x-metronic.select name="place_id" data-size="7"  id="kt_select2_4" data-live-search="true"--}}
{{--                                                   title="Select Business">--}}
{{--                                    @foreach ($places as $place)--}}
{{--                                        <x-metronic.select-option value="{{$place->id}}" select-name="place_id"--}}
{{--                                                                  :loop-id="$place->id">--}}
{{--                                            {{$place->name}}--}}
{{--                                        </x-metronic.select-option>--}}
{{--                                    @endforeach--}}
{{--                                </x-metronic.select>--}}
{{--                                <x-metronic.input-error for="place_id" class="mt-2" />--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
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
    $('.all-check:checkbox').change(function() {
        // this will contain a reference to the checkbox
        if (this.checked) {
            $("[type='checkbox']").each(function( index ) {
                $(this).prop('checked', true);;
            });
        } else {
            $("[type='checkbox']").each(function( index ) {
                $(this).prop('checked', false);;
            });
        }
    });

    $('#places').hide();
    $('#inputDisabled').prop("disabled", true);
    $('#kt_select2_3').change(function() {
        if($(this).find(':selected').data('is_business') == 1){
            $('#places').show();
            $('#inputDisabled').prop("disabled", false);
        }else{
            $('#places').hide();
            $('#inputDisabled').prop("disabled", true);
        }

    });

    if($('#kt_select2_3').find(':selected').data('is_business') == 1){
        $('#places').show();
        $('#inputDisabled').prop("disabled", false);
    }else{
        $('#places').hide();
        $('#inputDisabled').prop("disabled", true);
    }
</script>
@endsection