@extends('layouts.default')

@section('styles')
<style>
    .datatable-row {
        display: flex !important;
        align-items: center;
    }
</style>
@endsection

@section('content')
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <x-metronic.datatable.table-card>
            <x-slot name="header">
                <div x-data="{ open: false }" class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="w-100 card-toolbar justify-content-between">
                        <!--begin::Search Form-->
                        <div class="d-flex">
                            <x-metronic.datatable.search-input />

                            <x-metronic.button type="button" class="mx-2" style="light" @click="open = ! open">
                                البحث المتقدم
                            </x-metronic.button>
                        </div>
                        <!--end::Search Form-->

                           <!--begin::Button-->
                           <x-metronic.button-link href="{{ route('recruiters.create') }}">
                            <span class="svg-icon svg-icon-md">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                     viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                        <rect fill="#000000" opacity="0.3"
                                              transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) "
                                              x="4" y="11" width="16" height="2" rx="1"/>
                                    </g>
                                </svg>
                            </span>
                                أضف عميل 
                            </x-metronic.button-link>
                            <!--end::Button-->

                    </div>
                    <div x-show="open" class="w-100 card-toolbar">
                        <div class="col-md-4 my-2 my-md-0 pl-0">
                            <x-metronic.datatable.drop-down label="Status" selector="status_filter">
                                <x-metronic.datatable.drop-dowm-option value="1">
                                    {{ __('نشط') }}
                                </x-metronic.datatable.drop-dowm-option>
                                <x-metronic.datatable.drop-dowm-option value="0">
                                    {{ __('غير نشط') }}
                                </x-metronic.datatable.drop-dowm-option>
                            </x-metronic.datatable.drop-down>
                        </div>
                    </div>
                </div>
            </x-slot>
            <x-slot name="body">
                <div class="datatable datatable-bordered datatable-head-custom" id="datatable"></div>
            </x-slot>
        </x-metronic.datatable.table-card>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
@endsection

@section('scripts')
<script>
    <x-metronic.datatable.table data="{{ route('metronic.customers') }}" search-columns="user.name, user.phone" relation="user">
        <x-slot name="columns">
            <x-metronic.datatable.column field="user.name" title="{{ __('الأسم') }}" sort="off">
                <x-slot name="template">
                    ${row.user.name}
                </x-slot>
            </x-metronic.datatable.column>
            <x-metronic.datatable.column field="phone" title="{{ __('رقم الجوال') }}" sort="off">
                <x-slot name="template">
                    ${row.user.phone}
                </x-slot>
            </x-metronic.datatable.column>
            <x-metronic.datatable.column field="avatar" title="{{ __('الصورة الشخصية') }}" sort="off">
                <x-slot name="template">
                    <a href="javascript:;" type="button" data-toggle="modal" data-target="#popup${row.id}">
                        <div class="symbol symbol-50 mr-3">
                            <div class="symbol-label" style="background-image: url(${row.user.profile_photo_url})"></div>
                        </div>
                    </a>
                    <x-metronic.datatable.image-modal id="${row.id}" image="${row.user.profile_photo_url}" alt="${row.user.name}"/>
                </x-slot>
            </x-metronic.datatable.column>


            <x-metronic.datatable.column field="status" title="{{ __('الحالة') }}">
                <x-slot name="template">
                    <span class="label font-weight-bold label-lg label-light-${row.status === 1 ? 'success' : 'danger'} label-inline">
                        ${row.status === 1 ? 'نشط' : 'غير نشط'}
                    </span>
                </x-slot>
            </x-metronic.datatable.column>
        </x-slot>
        <x-slot name="actions">
            <x-metronic.datatable.actions-drop-down>

                <x-metronic.datatable.actions-drop-down-item href="javascript:;" data-id="${row.id}" data-update="status" class="w-100 update">
                    ${row.status === 1 ?
                        `<span class="svg-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M12,22 C6.4771525,22 2,17.5228475 2,12 C2,6.4771525 6.4771525,2 12,2 C17.5228475,2 22,6.4771525 22,12 C22,17.5228475 17.5228475,22 12,22 Z M12,20 C16.418278,20 20,16.418278 20,12 C20,7.581722 16.418278,4 12,4 C7.581722,4 4,7.581722 4,12 C4,16.418278 7.581722,20 12,20 Z M19.0710678,4.92893219 L19.0710678,4.92893219 C19.4615921,5.31945648 19.4615921,5.95262146 19.0710678,6.34314575 L6.34314575,19.0710678 C5.95262146,19.4615921 5.31945648,19.4615921 4.92893219,19.0710678 L4.92893219,19.0710678 C4.5384079,18.6805435 4.5384079,18.0473785 4.92893219,17.6568542 L17.6568542,4.92893219 C18.0473785,4.5384079 18.6805435,4.5384079 19.0710678,4.92893219 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                </g>
                            </svg>
                        </span>
                            {{ __('تعطيل') }}
                        `
                    :
                    `<span class="svg-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                <path d="M12.4208204,17.1583592 L15.4572949,11.0854102 C15.6425368,10.7149263 15.4923686,10.2644215 15.1218847,10.0791796 C15.0177431,10.0271088 14.9029083,10 14.7864745,10 L12,10 L12,7.17705098 C12,6.76283742 11.6642136,6.42705098 11.25,6.42705098 C10.965921,6.42705098 10.7062236,6.58755277 10.5791796,6.84164079 L7.5427051,12.9145898 C7.35746316,13.2850737 7.50763142,13.7355785 7.87811529,13.9208204 C7.98225687,13.9728912 8.09709167,14 8.21352549,14 L11,14 L11,16.822949 C11,17.2371626 11.3357864,17.572949 11.75,17.572949 C12.034079,17.572949 12.2937764,17.4124472 12.4208204,17.1583592 Z" fill="#000000"/>
                            </g>
                        </svg>
                    </span>
                        {{ __('تفعيل') }}
                    `
                    }
                </x-metronic.datatable.actions-drop-down-item>
                <x-metronic.datatable.actions-drop-down-item href="javascript:;" data-id="${row.id}" class="w-100 delete">
                    <span class="svg-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                            </g>
                        </svg>
                    </span>
                    {{ __('حذف') }}
                </x-metronic.datatable.actions-drop-down-item>
            </x-metronic.datatable.actions-drop-down>
        </x-slot>
        <x-slot name="extra">

            <x-metronic.datatable.search selector="status_filter" column="status" />

            $('body').on('click', '.update', function() {
                axios.post("{{ route('metronic.customer.status') }}", {
                        id: $(this).data("id"),
                        update: $(this).data("update")
                    })
                    .then(function (response) {
                        <x-metronic.datatable.reload />
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            })
            $('body').on('click', '.delete', function() {
                axios.post("{{ route('metronic.customer.destroy') }}", {
                        id: $(this).data("id"),
                    })
                    .then(function (response) {
                        <x-metronic.datatable.reload />
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            })
        </x-slot>
    </x-metronic.datatable.table>
</script>
@endsection
