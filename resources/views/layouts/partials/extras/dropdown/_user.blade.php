@if (config('layout', 'extras/user/dropdown/style') == 'light')
{{-- Header --}}
<div class="d-flex align-items-center p-4 rounded-top">
    {{-- Symbol --}}
    <div class="symbol symbol-md bg-light-primary mr-3 flex-shrink-0">
        <img src="{{ global_asset('media/users/300_21.jpg') }}" alt="" />
    </div>
user
    {{-- Text --}}
    <div class="text-dark m-0 flex-grow-1 mr-3 font-size-h5">{{ Auth::user()->name }}</div>
</div>
<div class="separator separator-solid"></div>
@else
{{-- Header --}}
<div class="d-flex align-items-center justify-content-between flex-wrap p-4 bgi-size-cover bgi-no-repeat rounded-top">
    <div class="d-flex align-items-center mr-2">
        {{-- Symbol --}}
        <div class="symbol bg-white-o-15 mr-3">
            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
        </div>

        {{-- Text --}}
        <div class="text-dark m-0 flex-grow-1 mr-3 font-size-h5">{{ Auth::user()->name }}</div>
    </div>
</div>
@endif

<div class="separator separator-solid"></div>

{{-- Nav --}}
<div class="navi navi-spacer-x-0 pt-4">
    {{-- Item --}}
    <a href="{{ route('profile.show') }}" class="navi-item px-8">
        <div class="navi-link">
            <div class="navi-icon mr-4">
                <span class="svg-icon svg-icon-2x">
                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-04-19-122603/theme/html/demo1/dist/../src/media/svg/icons/General/User.svg--><svg
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path
                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                            <path
                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                fill="#000000" fill-rule="nonzero" />
                        </g>
                    </svg>
                    <!--end::Svg Icon--></span>
            </div>
            <div class="navi-text">
                <div class="font-weight-bold">
                    My Profile
                </div>
                <div class="text-muted">
                    Account settings and more
                </div>
            </div>
        </div>
    </a>

    {{-- Footer --}}
    <div class="navi-separator mt-3"></div>
    <div class="navi-footer px-8 py-5">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
            this.closest('form').submit();" class="btn btn-secondary font-weight-bold">Sign Out</a>
        </form>
    </div>
</div>





