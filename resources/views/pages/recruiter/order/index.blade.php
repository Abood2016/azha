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
                    <div  class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="w-100 card-toolbar justify-content-between">
                            <!--begin::Search Form-->
                            <div class="d-flex">
                                <div class="card-toolbar">
                                    <div class="my-2 my-md-0 pl-0">
                                        <x-metronic.datatable.drop-down label="Status" selector="status_filter">
                                            <x-metronic.datatable.drop-dowm-option value="0">
                                                {{ __('Pending') }}
                                            </x-metronic.datatable.drop-dowm-option>
                                            <x-metronic.datatable.drop-dowm-option value="1">
                                                {{ __('Accept') }}
                                            </x-metronic.datatable.drop-dowm-option>
                                            <x-metronic.datatable.drop-dowm-option value="2">
                                                {{ __('Canceled By Customer') }}
                                            </x-metronic.datatable.drop-dowm-option>
                                            <x-metronic.datatable.drop-dowm-option value="5">
                                                {{ __('Canceled By Driver') }}
                                            </x-metronic.datatable.drop-dowm-option>
                                            <x-metronic.datatable.drop-dowm-option value="6">
                                                {{ __('Canceled By Admin') }}
                                            </x-metronic.datatable.drop-dowm-option>
                                            <x-metronic.datatable.drop-dowm-option value="7">
                                                {{ __('Complete') }}
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
        <x-metronic.datatable.table data="{{ route('driver.orders',$driver->id) }}" search-columns="id" relation="customers.user, drivers.user">
            <x-slot name="columns">
            <x-metronic.datatable.column field="customers.user.name" title="{{ __('Customer') }}" sort="off">
            <x-slot name="template">
            ${row.customer.user.name}
            </x-slot>
            </x-metronic.datatable.column>
            <x-metronic.datatable.column field="drivers.user.name" title="{{ __('Driver') }}" sort="off">
            <x-slot name="template">

            ${row.driver?row.driver.user?row.driver.user.name:` <span class="label font-weight-bold label-lg  label-light-info label-inline">{{ __('No Driver') }}</span>` : `
                <span class="label font-weight-bold label-lg  label-light-info label-inline">{{ __('No Driver') }}</span>
                    `}
            </x-slot>
            </x-metronic.datatable.column>
            <x-metronic.datatable.column field="pickup" title="{{ __('PickUp Location') }}" sort="off">
            <x-slot name="template">
            ${row.pickup_location.name?row.pickup_location.name:row.pickup_location.display_name?row.pickup_location.display_name:row.pickup_location.location.name}
            </x-slot>
            </x-metronic.datatable.column>
            <x-metronic.datatable.column field="drop" title="{{ __('Drop Location') }}" sort="off">
            <x-slot name="template">
            ${row.drop_location === null ? 'Customer guided the driver' : row.display_name_drop_of}
            </x-slot>
            </x-metronic.datatable.column>
            <x-metronic.datatable.column field="rate" title="{{ __('Rate') }}" sort="off">
            <x-slot name="template">
            ${
                    row.rate == 0 ?`<div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>`: row.rate == 1 ? `<div class="rating">
                        <i class="fa fa-star" style="color:#F9BA48;"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>`:row.rate == 2 ? `<div class="rating">
                        <i class="fa fa-star" style="color:#F9BA48;"></i>
                        <i class="fa fa-star" style="color:#F9BA48;"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>`:row.rate == 3 ? `<div class="rating">
                        <i class="fa fa-star" style="color:#F9BA48;"></i>
                        <i class="fa fa-star" style="color:#F9BA48;"></i>
                        <i class="fa fa-star" style="color:#F9BA48;"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>` : row.rate == 4 ? `<div class="rating">
                        <i class="fa fa-star" style="color:#F9BA48;"></i>
                        <i class="fa fa-star" style="color:#F9BA48;"></i>
                        <i class="fa fa-star" style="color:#F9BA48;"></i>
                        <i class="fa fa-star" style="color:#F9BA48;"></i>
                        <i class="fa fa-star"></i>
                    </div>` : row.rate == 5 ? `<div class="rating">
                        <i class="fa fa-star" style="color:#F9BA48;"></i>
                        <i class="fa fa-star" style="color:#F9BA48;"></i>
                        <i class="fa fa-star" style="color:#F9BA48;"></i>
                        <i class="fa fa-star" style="color:#F9BA48;"></i>
                        <i class="fa fa-star" style="color:#F9BA48;"></i>
                    </div>` : ``

                }
            </x-slot>
            </x-metronic.datatable.column>
            <x-metronic.datatable.column field="status" title="{{ __('Status') }}">
            <x-slot name="template">
            <span class="order label font-weight-bold label-lg label-light-${row.status === 0 ? 'dark' : (row.status === 1 ? 'primary' : (row.status === 2 ?'danger':row.status === 3? 'danger' :row.status === 4?'danger':row.status === 5?'danger':row.status === 6?'danger':row.status === 8?'success':''))} label-inline">
            ${row.status === 0 ? 'Pending' : (row.status === 1 ? 'Accepted' :
            (row.status === 2 ?'Cancel By Customer':row.status === 3? 'Not Found First Time' :
            row.status === 4?'Not Found Second Time':row.status === 5?'Cancel By Driver':row.status === 6?'Cancel By Admin':row.status === 8?'Completed':''))
            }
            </span>
            </x-slot>
            </x-metronic.datatable.column>
            </x-slot>
            <x-slot name="actions">
            <x-metronic.datatable.actions-drop-down>
            <x-metronic.datatable.actions-drop-down-item href="/orders/${row.id}">
            <span class="svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <rect x="0" y="0" width="24" height="24"/>
            <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
            <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
            </g>
            </svg>
            </span>
                {{ __('Details') }}
            </x-metronic.datatable.actions-drop-down-item>
        ${row.status === 0 ?`
         <x-metronic.datatable.actions-drop-down-item href="javascript:;" data-update="status"  data-id="${row.id} " class="update">
        <span class="svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <rect x="0" y="0" width="24" height="24"/>
            <path d="M12,22 C6.4771525,22 2,17.5228475 2,12 C2,6.4771525 6.4771525,2 12,2 C17.5228475,2 22,6.4771525 22,12 C22,17.5228475 17.5228475,22 12,22 Z M12,20 C16.418278,20 20,16.418278 20,12 C20,7.581722 16.418278,4 12,4 C7.581722,4 4,7.581722 4,12 C4,16.418278 7.581722,20 12,20 Z M19.0710678,4.92893219 L19.0710678,4.92893219 C19.4615921,5.31945648 19.4615921,5.95262146 19.0710678,6.34314575 L6.34314575,19.0710678 C5.95262146,19.4615921 5.31945648,19.4615921 4.92893219,19.0710678 L4.92893219,19.0710678 C4.5384079,18.6805435 4.5384079,18.0473785 4.92893219,17.6568542 L17.6568542,4.92893219 C18.0473785,4.5384079 18.6805435,4.5384079 19.0710678,4.92893219 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
            </g>
            </svg>
            </span>
                {{ __('Cancel Order') }}
            </x-metronic.datatable.actions-drop-down-item>
                `:``}

            </x-metronic.datatable.actions-drop-down>
        </x-slot>
        <x-slot name="extra">
            <x-metronic.datatable.search selector="status_filter" column="status" />

            $('body').on('click', '.update', function() {
                axios.post("{{ route('metronic.order.status') }}", {
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
                var order = $(this).data("id")
                axios.post(`/metronic/order/${order}`)
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