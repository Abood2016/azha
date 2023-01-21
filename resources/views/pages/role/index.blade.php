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
                        <x-metronic.button-link href="{{route('roles.create')}}">
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

    <x-metronic.datatable.table data="{{route('roles.index')}}" search-columns="query">
        <x-slot name="columns">
            <x-metronic.datatable.column field="name" title="{{ __('Name') }}" sort="off">
                <x-slot name="template">
                    ${row.name}
                </x-slot>
            </x-metronic.datatable.column>
        </x-slot>
        <x-slot name="actions">
            <x-metronic.datatable.actions-drop-down>
                <x-metronic.datatable.actions-drop-down-item href="/roles/${row.id}/edit">
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



            </x-metronic.datatable.actions-drop-down>
        </x-slot>
    </x-metronic.datatable.table>
</script>
@endsection