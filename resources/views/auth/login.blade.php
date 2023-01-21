@extends('layouts.guest')

@section('styles')
<link rel="stylesheet" href="{{ global_asset('css/pages/login/login-1.css') }}">
@endsection

@section('content')
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white">
        <!--begin::Aside-->
        <div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #00e6e6;">
            <!--begin::Aside Top-->
            <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                <!--begin::Aside header-->
                <a href="#" class="text-center mb-10">
                    <img src="{{ global_asset('media/logos/logo-letter-2.png') }}" class="max-h-70px" alt="" />
                </a>
                <!--end::Aside header-->
                <!--begin::Aside title-->
                <h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg" style="color: #0000004a;">
                  Welcome To
                    <br />Azhal </h3>
                <!--end::Aside title-->
            </div>
            <!--end::Aside Top-->
            <!--begin::Aside Bottom-->
            <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center"
                style="background-image: url({{ global_asset('media/svg/illustrations/login-visual-7.svg') }})">
            </div>
            <!--end::Aside Bottom-->
        </div>
        <!--begin::Aside-->
        <!--begin::Content-->
        <div
            class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
            <!--begin::Content body-->
            <div class="d-flex flex-column-fluid flex-center">
                <!--begin::Signin-->
                <div class="login-form login-signin">
                    <!--begin::Form-->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!--begin::Title-->
                        <div class="pb-13 pt-lg-0 pt-5">
                            <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">
                                {{ __('مرحبا بك في تم') }}
                            </h3>
                        </div>

                        <x-metronic.validation-errors class="mb-13" />

                        <!--begin::Title-->
                        <!--begin::Form group-->
                        <div class="form-group">
                            <label class="font-size-h6 font-weight-bolder text-dark">{{ __('البريد الألكتروني') }}</label>
                            <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg" type="email"
                                name="email" value="{{ old('email') }}" required autofocus />
                        </div>
                        <!--end::Form group-->
                        <!--begin::Form group-->
                        <div class="form-group">
                            <label class="font-size-h6 font-weight-bolder text-dark">{{ __(' كلمة المرور') }}</label>
                            <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg" type="password"
                            name="password" required autocomplete="current-password" />
                        </div>
                        {{-- @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5">{{ __('Forgot your password?') }}</a>
                                @endif --}}
                        <!--end::Form group-->

                        <!--begin::Action-->
                        <div class="pb-lg-0 pb-5">
                            <button type="submit"
                                class="btn btn-dark font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">
                                {{ __(' تسجيل دخول') }}
                            </button>
                        </div>
                        <!--end::Action-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Signin-->
            </div>
            <!--end::Content body-->
            <!--begin::Content footer-->
            <div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
                <div class="text-dark-50 font-size-lg font-weight-bolder mr-10">
                    <span class="mr-1">&copy;<script>document.write(new Date().getFullYear());</script></span>
                    <a href="http://keenthemes.com/metronic" target="_blank"
                        class="text-dark-75 text-hover-primary">{{ config('app.name') }}</a>
                </div>
            </div>
            <!--end::Content footer-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Login-->
</div>
@endsection
