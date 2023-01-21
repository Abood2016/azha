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
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="w-100 card-toolbar justify-content-between">
                        <!--begin::Search Form-->
                        <div class="d-flex">
                            <x-metronic.datatable.search-input />
                        </div>
                        <!--end::Search Form-->

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
    <x-metronic.datatable.table data="{{ route('contact.index') }}" search-columns="contact">
        <x-slot name="columns">
            <x-metronic.datatable.column field="name" title="{{ __('الأسم') }}">
                <x-slot name="template">
                    ${row.name}
                </x-slot>
            </x-metronic.datatable.column>
            <x-metronic.datatable.column field="email" title="{{ __('البريد الألكتروني') }}">
                <x-slot name="template">
                    ${row.email}
                </x-slot>
            </x-metronic.datatable.column>
        <x-metronic.datatable.column field="message" title="{{ __('الرسالة') }}">
            <x-slot name="template">
                ${row.message}
            </x-slot>
        </x-metronic.datatable.column>
        </x-slot>

        <x-slot name="actions">
            <x-metronic.datatable.actions-drop-down>
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
            $('body').on('click', '.delete', function() {
                axios.post("{{ route('contact.destroy') }}", {
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
