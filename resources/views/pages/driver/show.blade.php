@extends('layouts.default')

@section('styles')
<style>
    .h-475px {
        height: 475px !important;
    }
    .overflow-y-scroll {
        overflow-y: scroll;
    }
</style>
@endsection

@section('content')
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="d-flex">
                    <!--begin::Pic-->
                    <div class="flex-shrink-0 mr-7">
                        <div class="symbol symbol-50 symbol-lg-120">
                            <img alt="Pic" src="{{ $driver->user->profile_photo_url }}" style="object-fit: contain;" />
                        </div>
                    </div>
                    <!--end::Pic-->
                    <!--begin: Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <!--begin::User-->
                            <div class="mr-3">
                                <div class="d-flex align-items-center mr-3">
                                    <!--begin::Name-->
                                    <a href="#"
                                        class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">
                                        {{ $driver->user->name }}
                                    </a>
                                    <!--end::Name-->
                                    <span
                                        class="label label-light-success label-inline font-weight-bolder mr-1">{{ __('Driver') }}</span>
                                </div>
                                <!--begin::Contacts-->
                                <div class="d-flex flex-wrap my-2">
                                    <a href="#"
                                        class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                        <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path
                                                        d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
                                                        fill="#000000" />
                                                    <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
                                                </g>
                                            </svg>
                                        </span>{{ $driver->user->email }}</a>
                                    <a href="#"
                                        class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                        <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path
                                                        d="M11.914857,14.1427403 L14.1188827,11.9387145 C14.7276032,11.329994 14.8785122,10.4000511 14.4935235,9.63007378 L14.3686433,9.38031323 C13.9836546,8.61033591 14.1345636,7.680393 14.7432841,7.07167248 L17.4760882,4.33886839 C17.6713503,4.14360624 17.9879328,4.14360624 18.183195,4.33886839 C18.2211956,4.37686904 18.2528214,4.42074752 18.2768552,4.46881498 L19.3808309,6.67676638 C20.2253855,8.3658756 19.8943345,10.4059034 18.5589765,11.7412615 L12.560151,17.740087 C11.1066115,19.1936265 8.95659008,19.7011777 7.00646221,19.0511351 L4.5919826,18.2463085 C4.33001094,18.1589846 4.18843095,17.8758246 4.27575484,17.613853 C4.30030124,17.5402138 4.34165566,17.4733009 4.39654309,17.4184135 L7.04781491,14.7671417 C7.65653544,14.1584211 8.58647835,14.0075122 9.35645567,14.3925008 L9.60621621,14.5173811 C10.3761935,14.9023698 11.3061364,14.7514608 11.914857,14.1427403 Z"
                                                        fill="#000000" />
                                                </g>
                                            </svg>
                                        </span>{{ $driver->user->phone }}</a>
                                </div>
                                <!--end::Contacts-->
                            </div>
                            <!--begin::User-->
                        </div>
                        <!--end::Title-->
                        <!--begin::Content-->
                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                            <!--begin::Description-->
                            <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">
                                <div class="d-flex align-items-center flex-wrap mt-8">
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mr-15 mb-2">
                                        <span class="mr-4">
                                            <i class="fas fa-star display-4 text-muted font-weight-bolder"></i>
                                        </span>
                                        <div class="d-flex flex-column text-dark-75">
                                            <span class="font-weight-bolder font-size-sm">{{ __('Rating') }}</span>
                                            <span class="font-weight-bolder font-size-h5">
                                                <span
                                                    class="text-dark-50 font-weight-bold"></span>{{ $driver->averageRating }}</span>
                                        </div>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mr-15 mb-2">
                                        <span class="mr-4">
                                            <i class="fas fa-car-side display-4 text-muted font-weight-bolder"></i>
                                        </span>
                                        <div class="d-flex flex-column text-dark-75">
                                            <span class="font-weight-bolder font-size-sm">{{ __('Orders') }}</span>
                                            <span class="font-weight-bolder font-size-h5">
                                                <span
                                                    class="text-dark-50 font-weight-bold"></span>{{ $driver->orders()->count() }}</span>
                                        </div>
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mr-15 mb-2">
                                        <span class="mr-4">
                                            <i class="fas fa-wallet display-4 text-muted font-weight-bolder"></i>
                                        </span>
                                        <div class="d-flex flex-column text-dark-75">
                                            <span class="font-weight-bolder font-size-sm">{{ __('Balance') }}</span>
                                            <span class="font-weight-bolder font-size-h5">
                                                <span class="text-dark-50 font-weight-bold">₪
                                                </span>{{ $driver->user->balance }}</span>
                                        </div>
                                    </div>
                                    <!--end::Item-->
                                </div>
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Info-->
                </div>
            </div>
        </div>
        <!--end::Card-->
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <!--begin::Card-->
                <div class="card card-custom h-475px">
                    <!--begin::Header-->
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">{{ __('Transactions') }}</span>
                            <span class="d-flex font-size-sm font-weight-bold mt-3 text-muted w-100">
                                <span class="align-items-center d-flex mr-5">
                                    <span class="label label-sm label-primary mr-2"></span>
                                    {{ __('Deposit Confirmed') }}
                                </span>
                                <span class="align-items-center d-flex mr-5">
                                    <span class="label label-sm label-warning mr-2"></span>
                                    {{ __('Deposit Unconfirmed') }}
                                </span>
                                <span class="align-items-center d-flex mr-5">
                                    <span class="label label-sm label-danger mr-2"></span>
                                    {{ __('Withdraw') }}
                                </span>
                            </span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-4 border-0 overflow-y-scroll">
                        @foreach ($driver->user->transactions->sortByDesc('id') as $transaction)

                        <div class="mb-6">
                            <!--begin::Content-->
                            <div class="d-flex align-items-center flex-grow-1">
                                <!--begin::Section-->
                                <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column align-items-cente py-2 w-75">
                                        <!--begin::Title-->
                                        <span class="text-dark-75 font-weight-bold font-size-lg mb-1">
                                            {{ $transaction->uuid }}
                                        </span>
                                        <!--end::Title-->
                                        <span class="text-muted font-weight-bold">{{ __('Created at') }}:
                                            {{ $transaction->created_at }}</span>
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Label-->

                                    <span
                                        class="label label-lg label-light-{{ $transaction->type === 'deposit' && $transaction->confirmed == 0 ? 'warning' : ($transaction->type === 'deposit' ? 'primary' : 'danger') }} label-inline font-weight-bolder py-4">
                                        ₪ {{ $transaction->type === 'deposit' ? '+' : '' }}
                                        {{ $transaction->amount }}
                                    </span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Content-->
                        </div>

                        @endforeach

                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
            <div class="col-lg-6 col-sm-12">
                <!--begin::Card-->
                <div class="card card-custom h-475px">
                    <!--begin::Header-->
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">{{ __('Car Information') }}</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-4">
                        <div class="form-group row my-2">
                            <label class="col-4 col-form-label">{{ __('Licence Number') }}:</label>
                            <div class="col-8">
                                <span
                                    class="form-control-plaintext font-weight-bolder">{{ $driver->licence_number }}</span>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label class="col-4 col-form-label">{{ __('Licence Expire Date') }}:</label>
                            <div class="col-8">
                                <span
                                    class="form-control-plaintext font-weight-bolder">{{ $driver->licence_expire_date }}</span>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label class="col-4 col-form-label">{{ __('Brand') }}:</label>
                            <div class="col-8">
                                <span
                                    class="form-control-plaintext font-weight-bolder text-capitalize">{{ $driver->vehicle_brand }}</span>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label class="col-4 col-form-label">{{ __('Model') }}:</label>
                            <div class="col-8">
                                <span
                                    class="form-control-plaintext font-weight-bolder text-capitalize">{{ $driver->vehicle_model }}</span>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label class="col-4 col-form-label">{{ __('Name') }}:</label>
                            <div class="col-8">
                                <span
                                    class="form-control-plaintext font-weight-bolder text-capitalize">{{ $driver->vehicle_name }}</span>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label class="col-4 col-form-label">{{ __('Color') }}:</label>
                            <div class="col-8">
                                <span
                                    class="form-control-plaintext font-weight-bolder text-capitalize">{{ $driver->vehicle_color }}</span>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label class="col-4 col-form-label">{{ __('Registration Number') }}:</label>
                            <div class="col-8">
                                <span
                                    class="form-control-plaintext font-weight-bolder">{{ $driver->vehicle_registration_number }}</span>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label class="col-4 col-form-label">{{ __('Purchase Year') }}:</label>
                            <div class="col-8">
                                <span
                                    class="form-control-plaintext font-weight-bolder">{{ $driver->vehicle_purchase_year }}</span>
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
        </div>


    </div>
    <!--end::Container-->
</div>
@endsection