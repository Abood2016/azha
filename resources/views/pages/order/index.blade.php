@extends('layouts.default')

@section('styles')
    <style>
        .datatable-row {
            display: flex !important;
            align-items: center;
        }

        .btn i {
            width: 18px;
            font-size: 1rem;
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
                                <div class="card-toolbar">
                                    <div class="my-2 my-md-0 pl-2">
                                        <x-metronic.datatable.drop-down label="حالة الطلب" selector="status_filter">
                                            <x-metronic.datatable.drop-dowm-option value="0">
                                                {{ __('فيد الأنتظار') }}
                                            </x-metronic.datatable.drop-dowm-option>
                                            <x-metronic.datatable.drop-dowm-option value="1">
                                                {{ __('مقبول') }}
                                            </x-metronic.datatable.drop-dowm-option>

                                            <x-metronic.datatable.drop-dowm-option value="5">
                                                {{ __('مرفوض') }}
                                            </x-metronic.datatable.drop-dowm-option>


                                        </x-metronic.datatable.drop-down>
                                    </div>

                                </div>
                                {{--                            <x-metronic.datatable.search-input />--}}

                                {{--                            <x-metronic.button type="button" class="mx-2" style="light" @click="open = ! open">--}}
                                {{--                                Filters--}}
                                {{--                            </x-metronic.button>--}}
                            </div>
                            <!--end::Search Form-->

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
        <x-metronic.datatable.table data="{{ route('orders.index') }}" search-columns="id"
                                    relation="customers.user, drivers.user">
            <x-slot name="columns">


                <x-metronic.datatable.column field="serives_id" title="{{ __('رقم الخدمة') }}" sort="off">
                    <x-slot name="template">
                        # ${row.service_id}
                    </x-slot>
                </x-metronic.datatable.column>


                <x-metronic.datatable.column field="customer" title="{{ __('العميل') }}" sort="off">
                    <x-slot name="template">
                        ${row.customer}
                    </x-slot>
                </x-metronic.datatable.column>

                <x-metronic.datatable.column field="message" title="{{ __(' تفاصيل عرض الطلب ') }}" sort="off">
                    <x-slot name="template">
                        ${row.message}
                    </x-slot>
                </x-metronic.datatable.column>


                <x-metronic.datatable.column field="status" title="{{ __('الحالة') }}">
                    <x-slot name="template">
                    <span
                        class="order label font-weight-bold label-lg label-light-${row.status === 0 ? 'dark' : (row.status === 1 ? 'primary' : (row.status === 2 ?'danger':row.status === 3? 'danger' :row.status === 4?'danger':row.status === 5?'danger':row.status === 6?'danger':row.status === 8?'success':''))} label-inline">
                        ${row.status === 0 ? 'قيد الأنتظار' : (row.status === 1 ? 'تمت الموافقة عليه' :
                        (row.status === 2 ? 'مرفوض' : ' '))
                    }
                    </span>
                    </x-slot>
                </x-metronic.datatable.column>


            </x-slot>

            <x-slot name="extra">
                <x-metronic.datatable.search selector="status_filter" column="status"/>

            </x-slot>
        </x-metronic.datatable.table>
    </script>
@endsection
