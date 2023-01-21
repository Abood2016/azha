@extends('layouts.default')

@section('content')
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <x-metronic.form-card action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
            <x-slot name="body">
                <div class="form-group row">
                    <div class="col-lg-6 form-group">
                        <x-metronic.label for="name" value="{{ __('Name') }}" />
                        <x-metronic.input value="{{ old('name') }}" id="name" name="name" type="text" class="mt-1 block w-full" autocomplete="name" />
                        <x-metronic.input-error for="name" class="mt-2" />
                    </div>
                    <div class="col-lg-6 form-group">
                        <x-metronic.label for="name" value="{{ __('Is Business ?') }}" />
                        <div class="col-lg-1">
                           <span class="switch switch-icon">
                            <label>
                             <input type="checkbox"  name="is_business"/>
                             <span></span>
                            </label>
                           </span>
                        </div>
                    </div>
                    <div class="card p-7 col-lg-12">
                        <x-metronic.input-error for="permissions" class="mt-2" />
                        <table class="table role-table">
                            <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                             <tr class="mb-2">
                                 <th scope="row">Role Permission</th>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td> <input type="checkbox" class="all-check">Select All</td>
                            </tr>
                             @foreach($permissions as $index => $per)
                             <tr class="mb-2">
                                 <th scope="row">{{$per}} Management</th>
                                 <td><input type="checkbox" value="{{$index+1}}" name="permissions[]">Create</td>
                                 <td><input type="checkbox" value="{{$index+2}}" name="permissions[]">Read</td>
                                 <td><input type="checkbox" value="{{$index+3}}" name="permissions[]">Update</td>
                                 <td><input type="checkbox" value="{{$index+4}}" name="permissions[]">Delete</td>
                                 <td><input type="checkbox" class="select-row">Select All</td>
                             </tr>
                             @endforeach
                            </tbody>
                        </table>
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
    $('.select-row:checkbox').change(function() {
        // this will contain a reference to the checkbox
        if (this.checked) {

            $(this).closest('tr').find("[type='checkbox']").each(function( index ) {
                $(this).prop('checked', true);
            });
        } else {
            $(this).closest('tr').find("[type='checkbox']").each(function( index ) {
                $(this).prop('checked', false);
            });
        }
    });
</script>
@endsection