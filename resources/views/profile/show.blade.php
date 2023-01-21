@extends('layouts.default')

@section('content')
<div class="row">
    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
    <div class="col-lg-12">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                @livewire('profile.update-profile-information-form')
            </div>
        </div>
    </div>
    @endif

    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
    <div class="col-lg-12">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                @livewire('profile.update-password-form')
            </div>
        </div>
    </div>
    <div class="mt-10 sm:mt-0">
    </div>
    @endif

    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
    <div class="col-lg-12">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                @livewire('profile.two-factor-authentication-form')
            </div>
        </div>
    </div>
    <div class="mt-10 sm:mt-0">
    </div>
    @endif

    <div class="col-lg-12">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>
        </div>
    </div>

    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
    <div class="col-lg-12">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="mt-10 mt-sm-0">
                    @livewire('profile.delete-user-form')
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection