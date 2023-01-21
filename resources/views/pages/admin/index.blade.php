@extends('layouts.default')

@section('styles')
    <style>
        .datatable-row {
            display: flex !important;
            align-items: center;
        }
        .card-toolbar div:last-child {
            padding-right: 0 !important;
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

                                {{--                            <x-metronic.button type="button" class="mx-2" style="light" @click="open = ! open">--}}
                                {{--                                Filters--}}
                                {{--                            </x-metronic.button>--}}
                            </div>
                            <!--end::Search Form-->
                            <!--begin::Button-->
                            <x-metronic.button-link href="{{ route('admins.create') }}">
                            <span class="svg-icon svg-icon-md">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                     viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1" />
                                        <rect fill="#000000" opacity="0.3"
                                              transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) "
                                              x="4" y="11" width="16" height="2" rx="1" />
                                    </g>
                                </svg>
                            </span>
                                New Record
                            </x-metronic.button-link>
                            <!--end::Button-->
                        </div>
                        <div x-show="open" class="w-100 card-toolbar">
                            <div class="col-md-4 my-2 my-md-0 pl-0">
                                <x-metronic.datatable.drop-down label="Status" selector="status_filter">
                                    <x-metronic.datatable.drop-dowm-option value="1">
                                        {{ __('Active') }}
                                    </x-metronic.datatable.drop-dowm-option>
                                    <x-metronic.datatable.drop-dowm-option value="0">
                                        {{ __('Blocked') }}
                                    </x-metronic.datatable.drop-dowm-option>
                                </x-metronic.datatable.drop-down>
                            </div>
                            <div class="col-md-4 my-2 my-md-0 pl-0">
                                <x-metronic.datatable.drop-down label="Connection" selector="connection_filter">
                                    <x-metronic.datatable.drop-dowm-option value="1">
                                        {{ __('Online') }}
                                    </x-metronic.datatable.drop-dowm-option>
                                    <x-metronic.datatable.drop-dowm-option value="0">
                                        {{ __('Offline') }}
                                    </x-metronic.datatable.drop-dowm-option>
                                </x-metronic.datatable.drop-down>
                            </div>
                            <div class="col-md-4 my-2 my-md-0 pl-0">
                                <x-metronic.datatable.drop-down label="Approve" selector="approve_filter">
                                    <x-metronic.datatable.drop-dowm-option value="0">
                                        {{ __('Pending') }}
                                    </x-metronic.datatable.drop-dowm-option>
                                    <x-metronic.datatable.drop-dowm-option value="1">
                                        {{ __('Approved') }}
                                    </x-metronic.datatable.drop-dowm-option>
                                    <x-metronic.datatable.drop-dowm-option value="2">
                                        {{ __('Declined') }}
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

        <x-metronic.datatable.table data="{{ route('admins.index') }}" search-columns="query">
            <x-slot name="columns">
            <x-metronic.datatable.column field="user.name" title="{{ __('Name') }}">
            <x-slot name="template">
            ${row.name}
            </x-slot>
            </x-metronic.datatable.column>
            <x-metronic.datatable.column field="email" title="{{ __('Email') }}">
            <x-slot name="template">
            ${row.email}
            </x-slot>
            </x-metronic.datatable.column>
            <x-metronic.datatable.column field="display_name_role" title="{{ __('Role') }}">
            <x-slot name="template">
            ${row.display_name_role}
            </x-slot>
            </x-metronic.datatable.column>
            <x-metronic.datatable.column field="avatar" title="{{ __('Avatar') }}" sort="off">
            <x-slot name="template">
            <a href="javascript:;" type="button" data-toggle="modal" data-target="#popup${row.id}">
            <div class="symbol symbol-50 mr-3">
            <div class="symbol-label" style="background-image: url(${row.profile_photo_url})"></div>
            </div>
            </a>
            <x-metronic.datatable.image-modal id="${row.id}" image="${row.profile_photo_url}" alt="${row.name}"/>
            </x-slot>
            </x-metronic.datatable.column>
            <x-metronic.datatable.column field="deleted_at" title="{{ __('Status') }}">
            <x-slot name="template">
            <span class="label font-weight-bold label-lg label-light-${row.deleted_at? 'danger' : 'success'} label-inline">
            ${row.deleted_at?'Deleted' : 'Active'}
            </span>
            </x-slot>
            </x-metronic.datatable.column>

            </x-slot>
            <x-slot name="actions">
            <x-metronic.datatable.actions-drop-down>

            <x-metronic.datatable.actions-drop-down-item href="/admins/${row.id}/edit">
            <span class="svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <rect x="0" y="0" width="24" height="24"/>
            <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
            <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
            </g>
            </svg>
            </span>
                {{ __('Edit') }}
            </x-metronic.datatable.actions-drop-down-item>
            <x-metronic.datatable.actions-drop-down-item href="javascript:;" data-id="${row.id}" data-update="status" class="w-100 delete">
            ${row.deleted_at?
                `<span class="svg-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                <path d="M12.4208204,17.1583592 L15.4572949,11.0854102 C15.6425368,10.7149263 15.4923686,10.2644215 15.1218847,10.0791796 C15.0177431,10.0271088 14.9029083,10 14.7864745,10 L12,10 L12,7.17705098 C12,6.76283742 11.6642136,6.42705098 11.25,6.42705098 C10.965921,6.42705098 10.7062236,6.58755277 10.5791796,6.84164079 L7.5427051,12.9145898 C7.35746316,13.2850737 7.50763142,13.7355785 7.87811529,13.9208204 C7.98225687,13.9728912 8.09709167,14 8.21352549,14 L11,14 L11,16.822949 C11,17.2371626 11.3357864,17.572949 11.75,17.572949 C12.034079,17.572949 12.2937764,17.4124472 12.4208204,17.1583592 Z" fill="#000000"/>
                            </g>
                        </svg>
                    </span>
{{ __('Active') }}
            `
    :
            `<span class="svg-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M12,22 C6.4771525,22 2,17.5228475 2,12 C2,6.4771525 6.4771525,2 12,2 C17.5228475,2 22,6.4771525 22,12 C22,17.5228475 17.5228475,22 12,22 Z M12,20 C16.418278,20 20,16.418278 20,12 C20,7.581722 16.418278,4 12,4 C7.581722,4 4,7.581722 4,12 C4,16.418278 7.581722,20 12,20 Z M19.0710678,4.92893219 L19.0710678,4.92893219 C19.4615921,5.31945648 19.4615921,5.95262146 19.0710678,6.34314575 L6.34314575,19.0710678 C5.95262146,19.4615921 5.31945648,19.4615921 4.92893219,19.0710678 L4.92893219,19.0710678 C4.5384079,18.6805435 4.5384079,18.0473785 4.92893219,17.6568542 L17.6568542,4.92893219 C18.0473785,4.5384079 18.6805435,4.5384079 19.0710678,4.92893219 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                        </g>
                    </svg>
                </span>
{{ __('Block') }}
            `
}
            </x-metronic.datatable.actions-drop-down-item>



            </x-metronic.datatable.actions-drop-down>
            </x-slot>
            <x-slot name="extra">

            <x-metronic.datatable.search selector="status_filter" column="filter.status" />
            <x-metronic.datatable.search selector="connection_filter" column="filter.connection" />
            <x-metronic.datatable.search selector="approve_filter" column="filter.approve" />


            $('body').on('click', '.delete', function() {
                axios.delete("admins/"+$(this).data("id"))
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