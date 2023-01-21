@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                            {{ __('Order for') . ' ' . $order['customer']['user']['name']}}
                        </h3>


                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card card-custom card-fit card-border h-100">
                                <div class="card-header">
                                    <div class="card-title">
                                    <span class="card-icon">
                                        <i class="fas fa-box"></i>
                                    </span>
                                        <h3 class="card-label">{{ __('Customer Information') }}</h3>
                                    </div>
                                </div>
                                <div class="card-body pt-2">
                                    <div class="form-group row my-2">
                                        <label class="col-4 col-form-label">{{ __('Name') }}:</label>
                                        <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$order['customer']['user']['name']}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row my-2">
                                        <label class="col-4 col-form-label">{{ __('Phone') }}:</label>
                                        <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$order['customer']['user']['phone']}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row my-2">
                                        <label class="col-4 col-form-label">{{ __('Gender') }}:</label>
                                        <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$order['customer']['gender']}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row my-2">
                                        <label class="col-4 col-form-label">{{ __('Address') }}:</label>
                                        <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$order['customer']['address']}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card card-custom card-fit card-border h-100">
                                <div class="card-header">
                                    <div class="card-title">
                                    <span class="card-icon">
                                        <i class="fas fa-box"></i>
                                    </span>
                                        <h3 class="card-label">{{ __('Driver Information') }}</h3>
                                    </div>
                                </div>
                                <div class="card-body pt-2">
                                    @if(!is_null($order['driver_id']))
                                        <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __('Name') }}:</label>
                                            <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$order['driver']['user']['name']}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __('Phone') }}:</label>
                                            <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$order['driver']['user']['phone']}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __('Rate') }}:</label>
                                            <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$order['driver']['rate']}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __('Count Orders') }}:</label>
                                            <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$order['driver']['count_order']}}</span>
                                            </div>
                                        </div>
                                    @else
                                        No Driver
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card card-custom card-fit card-border h-100">
                                <div class="card-header">
                                    <div class="card-title">
                                    <span class="card-icon">
                                        <i class="fas fa-box"></i>
                                    </span>
                                        <h3 class="card-label">{{ __('Pick up Location') }}</h3>
                                    </div>
                                </div>
                                <div class="card-body pt-2">
                                    <div class="form-group row my-2">
                                        <label class="col-4 col-form-label">{{ __('Name') }}:</label>
                                        <div class="col-8">
                                            <span
                                                class="form-control-plaintext font-weight-bolder">{{$order['display_name_pick_up']}}</span>
                                        </div>
                                    </div>

                                    <div class="form-group row my-2">
                                        <label class="col-4 col-form-label">{{ __('Coordinates') }}:</label>
                                        <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$order['pickup_point']['lat']}} , {{$order['pickup_point']['lng']}}</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card card-custom card-fit card-border h-100">
                                <div class="card-header">
                                    <div class="card-title">
                                    <span class="card-icon">
                                        <i class="fas fa-box"></i>
                                    </span>
                                        <h3 class="card-label">{{ __('Drop of Location') }}</h3>
                                    </div>
                                </div>
                                <div class="card-body pt-2">
                                    <div class="form-group row my-2">
                                        <label class="col-4 col-form-label">{{ __('Name ( Map ) ') }}:</label>
                                        <div class="col-8">
                                            <span
                                                class="form-control-plaintext font-weight-bolder">{{$order['display_name_drop_of']}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row my-2">
                                        <label class="col-4 col-form-label">{{ __('Name ( Manual)') }}:</label>
                                        <div class="col-8">
                                            <span
                                                class="form-control-plaintext font-weight-bolder">{{$order['drop_of_text']}}</span>
                                        </div>
                                    </div>
                                    @if(isset($order['drop_point']))
                                        <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __('Coordinates') }}:</label>
                                            <div class="col-8">
                                            <span
                                                class="form-control-plaintext font-weight-bolder">{{$order['drop_point']['lat']}} , {{$order['drop_point']['lng']}}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card card-custom card-fit card-border h-100">
                                <div class="card-header">
                                    <div class="card-title">
                                    <span class="card-icon">
                                        <i class="fas fa-receipt"></i>
                                    </span>
                                        <h3 class="card-label">{{ __('Order Information') }}</h3>
                                    </div>
                                </div>
                                <div class="card-body pt-2">

                                    <div class="form-group row my-2">
                                        <label class="col-4 col-form-label">{{ __('Status') }}:</label>
                                        <div class="col-8">
                                            <span class="form-control-plaintext text-{{$order['status'] == 0?'dark':($order['status'] == 1?'primary':($order['status'] == 2 ? 'danger': ($order['status'] == 3?'warning'
                                                : ($order['status'] == 4 ? 'warning' : ($order['status'] == 5 ? 'danger' : ($order['status'] == 6 ?'danger':($order['status'] == 8?'success' : '')))))))}} font-weight-bolder">{{$order['status_name']}}</span>
                                        </div>
                                    </div>
                                    @if(isset($order['invoice_image']))
                                        <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __('Invoice Image') }}:</label>
                                            <a href="javascript:;" type="button" data-toggle="modal"
                                               data-target="#popup1">
                                                <div class="symbol symbol-50 mr-3">
                                                    <div class="symbol-label"
                                                         style="background-image: url({{$order['invoice_image']}})"></div>
                                                </div>
                                            </a>
                                            <x-metronic.datatable.image-modal id="1"
                                                                              image="{{$order['invoice_image']}}"/>
                                        </div>
                                    @endif
                                    @if(isset($order['invoice_price']))
                                        <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __('Invoice Price') }}:</label>
                                            <div class="col-8">
                                                <span class="form-control-plaintext text-danger font-weight-bolder">{{$order['invoice_price']}} ₪</span>
                                            </div>
                                        </div>
                                    @endif
                                    @if($order['reason'])
                                        <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __('Cancellation Reason') }}:</label>
                                            <div class="col-8">
                                            <span
                                                class="form-control-plaintext  font-weight-bolder">{{$order['reason']['reason']}}</span>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group row my-2">
                                        <label class="col-4 col-form-label">{{ __('Create At') }}:</label>
                                        <div class="col-8">
                                            <span
                                                class="form-control-plaintext font-weight-bolder">{{date('Y-m-d', strtotime($order['created_at']))}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row my-2">
                                        <label class="col-4 col-form-label">{{ __('Rate') }}:</label>
                                        <div class="col-8">
                                            <span class="form-control-plaintext font-weight-bolder">
                                                @for($i = 1 ; $i <= 5 ; $i++)
                                                    @if($i <= $order['rate'])
                                                        <i class="fa fa-star" style="color:#F9BA48;"></i>
                                                    @else
                                                        <i class="fa fa-star"></i>
                                                    @endif
                                                @endfor
                                            </span>
                                        </div>
                                    </div>

                                    @if($order['bad_rating_reason'])
                                        <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __('Rating Reason') }}:</label>
                                            <div class="col-8">
                                            <span
                                                class="form-control-plaintext text-danger  font-weight-bolder">{{$order['bad_rating_reason']}}</span>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group row my-2">
                                        <label class="col-4 col-form-label">{{ __('Type') }}:</label>
                                        <div class="col-8">
                                            <span class="form-control-plaintext font-weight-bolder">{{$order['is_barq']?'Barq':'Normal'}} ( {{$order['created_by']}})</span>
                                        </div>
                                    </div>
                                    <div class="form-group row my-2">
                                        <label class="col-4 col-form-label">{{ __('Delivery Notes') }}:</label>
                                        <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$order['delivery_notes']}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row my-2">
                                        <label class="col-4 col-form-label">{{ __('Record Voice') }}:</label>
                                        <div class="col-8">

                                        <span
                                            class="form-control-plaintext font-weight-bolder"> <audio controls>
                                            <source src="{{$order['record_voice']}}" type="audio/mp4">
                                            Your browser does not support the audio element.
                                        </audio></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card card-custom card-fit card-border h-100">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h3 class="card-label">{{ __('Activities') }}</h3>
                                    </div>
                                </div>
                                {{-- Body --}}
                                <div class="card-body pt-4">
                                    <div class="timeline timeline-6 mt-3">
                                        @foreach($order['activities'] as  $key => $activity)
                                            <!--begin::Item-->
                                            <div class="timeline-item align-items-start">
                                                <!--begin::Label-->
                                                <div
                                                    class="timeline-label font-weight-bolder text-dark-75 font-size-lg">{{date('h:i A', strtotime($key))}}</div>
                                                <!--end::Label-->
                                                <!--begin::Badge-->
                                                <div class="timeline-badge">
                                                    <i class="fa fa-genderless text-{{$activity == 0?'dark':($activity == 1?'primary':($activity == 2 ? 'danger': ($activity == 3?'warning'
                                                : ($activity == 4 ? 'warning' : ($activity == 5 ? 'danger' : ($activity == 6 ?'danger':($activity == 7?'primary' : ($activity == 8?'success' : ''))))))))}} icon-xl"></i>
                                                </div>
                                                <!--end::Badge-->
                                                <!--begin::Content-->
                                                <div class="timeline-content d-flex">
                                                <span class="font-weight-bolder text-{{$activity == 0?'dark':($activity == 1?'primary':($activity == 2 ? 'danger': ($activity == 3?'warning'
                                                : ($activity == 4 ? 'warning' : ($activity == 5 ? 'danger' : ($activity == 6 ?'danger':($activity == 7?'primary' : ($activity == 8?'success' : ''))))))))}} pl-3 font-size-lg">
                                                {{$activity == 0?'Pending':($activity == 1?'Accepted':($activity == 2 ? 'Cancel By Customer': ($activity == 3?'Not Found'
                                                : ($activity == 4 ? 'Not Found Try Again' : ($activity == 5 ? 'Cancel By Driver' : ($activity == 6 ?'Cancel By Admin':($activity == 7?'Picked at' : ($activity == 8?'Completed' : ''))))))))}}
                                                </span>
                                                </div>
                                                <!--end::Content-->
                                            </div>
                                            <!--end::Item-->
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card card-custom card-fit card-border h-100">
                                <div class="card-header">
                                    <div class="card-title">
                                    <span class="card-icon">
                                        <i class="fas fa-box"></i>
                                    </span>
                                        <h3 class="card-label">{{ __('Payment Details') }}</h3>
                                    </div>
                                </div>
                                <div class="card-body pt-2">
                                    <div class="form-group row my-2">
                                        <label class="col-4 col-form-label">{{ __('Charge') }}:</label>
                                        <div class="col-8">
                                            <span
                                                class="form-control-plaintext font-weight-bolder">₪ {{$order['charge']}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row my-2">
                                        <label class="col-4 col-form-label">{{ __('Deliver Price') }}:</label>
                                        <div class="col-8">
                                            <span
                                                class="form-control-plaintext font-weight-bolder">₪  {{$order['charge'] - $order['commission']}}</span>
                                        </div>
                                    </div>

                                    <div class="form-group row my-2">
                                        <label class="col-4 col-form-label">{{ __('Commission') }}:</label>
                                        <div class="col-8">
                                            <span
                                                class="form-control-plaintext font-weight-bolder">₪  {{$order['commission']}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row my-2">
                                        <label class="col-4 col-form-label">{{ __('status') }}:</label>
                                        <div class="col-8">
                                            <span
                                                class="form-control-plaintext font-weight-bolder">{{$order['is_paid'] ?'Paid':'Waiting'}}</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(!is_null($order['driver_id']))
        <div class="row">
            <div class="col-12">
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-body pt-0" id="app">
                        <route-map :drop_point="{{json_encode($order['drop_point'])}}"
                                   :pickup_point="{{json_encode($order['pickup_point'])}}"
                                   :coordinates="{{json_encode($order['coordinates'])}}"
                                   :driver_id="{{json_encode($order['driver_id'])}}"
                                   :order_id="{{json_encode($order['id'])}}"
                                   :order_status="{{json_encode($order['status'])}}"></route-map>
                    </div>
                </div>
            </div>
        </div>
    @endif



    @if(isset($available_drivers))
        <!-- Modal-->
        <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body" style="height: 300px;">
                        <div class="card-body">

                            <form action="{{route('manual-assign-order',$order['id'])}}" id="form" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-form-label text-left col-lg-12 col-sm-12">Avialable
                                        Drivers</label>
                                    <div class=" col-lg-12 col-md-9 col-sm-12">
                                        <x-metronic.select name="driver_id" class="form-control select2" data-size="7"
                                                           id="kt_select2_3" data-live-search="true"
                                                           title="Select Driver">
                                            @foreach($available_drivers as $driver)
                                                <x-metronic.select-option value="{{$driver->id}}"
                                                                          select-name="driver_id"
                                                >
                                                    {{$driver->user->name}}
                                                </x-metronic.select-option>
                                            @endforeach
                                        </x-metronic.select>
                                        <x-metronic.input-error for="driver_id" class="mt-2"/>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">
                                Close
                            </button>
                            <a href="javascript:void(0) " id="submit" class="btn btn-primary font-weight-bold">Save
                                changes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
@section('scripts')
    <script type="module">
        const app = new Vue({
            el: '#app',
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#manual_assign').click(function () {
                var html = ``;
                axios.get("{{ route('nearest-drivers') }}").then(function (response) {
                    var data = response.data.data;
                    for (var i = 0; i < data.length; i++) {
                        html += `<x-metronic.select-option value="` + data[i].id + `" select-name="driver_id"
                                                                      :loop-id="` + data[i].id + `">
                                               ` + data[i].id + `
                                            </x-metronic.select-option>`;
                    }
                    $('#kt_select2_3').html(html);
                    console.log("html", html)
                })
                    .catch(function (error) {
                        console.log(error);
                    });
                $('#exampleModalScrollable').modal('show');
                $('select').selectpicker();
            })
            $('#submit').click(function () {
                var conceptName = $('select').find(":selected").text();
                if (conceptName != '') {
                    $('#form').submit();
                }
            })
        });
    </script>

@endsection
