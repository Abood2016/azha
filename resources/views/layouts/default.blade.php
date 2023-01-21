<!DOCTYPE html>
<html
    {{ Config::set('layout.self.rtl', true)  }}
    lang="{{\Illuminate\Support\Facades\App::currentLocale()}}"
    dir="rtl" {{ Metronic::printAttrs('html') }} {{ Metronic::printClasses('html') }}>

<head>
    <meta charset="utf-8"/>
    {{-- Title Section --}}
    <title>{{ config('app.name') }} | @yield('title', $page_title ?? '')</title>

    {{-- Meta Data --}}
    <meta name="description" content="@yield('page_description', $page_description ?? '')"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Favicon --}}

    <link rel="shortcut icon" href="{{ global_asset('media/logos/favicon.ico') }}"/>

    {{-- Fonts --}}
    {{ Metronic::getGoogleFontsInclude() }}

    {{-- Global Theme Styles (used by all pages) --}}
    @foreach(config('layout.resources.css') as $style)
        <link href="{{ config('layout.self.rtl') ? global_asset(Metronic::rtlCssPath($style)) : global_asset($style) }}"
              rel="stylesheet" type="text/css"/>
    @endforeach

    {{-- Layout Themes (used by all pages) --}}
    @foreach (Metronic::initThemes() as $theme)
        <link href="{{ config('layout.self.rtl') ? global_asset(Metronic::rtlCssPath($theme)) : global_asset($theme) }}"
              rel="stylesheet" type="text/css"/>
    @endforeach

    {{-- App CSS --}}
    <link rel="stylesheet" href="{{ global_asset('css/app.css') }}">
    @yield('head_css')
    {{-- Includable CSS --}}
    @yield('styles')
 <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        * {
            font-family: 'Cairo', sans-serif !important;
            /*font-family: 'IBM Plex Sans Arabic', sans-serif !important;*/
        }


        .dropdown-menu-right{
            display: none;
            position: absolute;
            right: 88%;
            will-change: transform;
            top: 0px;
            left: 0px;
            transform: translate3d(318px, 411px, 0px);

        }
        .dropdown-menu-anim-up{
            position: absolute;
            transform: translate3d(-20px, 45px, 0px);
            top: 0px;
            left: -34px;
            right: -211%;
            will-change: transform;
        }

    </style>
    @livewireStyles
    <script src="https://unpkg.com/vue-select@3.0.0"></script>
    <link rel="stylesheet" href="https://unpkg.com/vue-select@3.0.0/dist/vue-select.css">
    <script src="{{ global_asset('js/app.js') }}" defer></script>
    @yield('head_script')
</head>

<body {{ Metronic::printAttrs('body') }} {{ Metronic::printClasses('body') }}>

@if (config('layout.page-loader.type') != '')
    @include('layouts.partials._page-loader')
@endif

@include('layouts.base._layout')

{{-- Global Config (global config for global JS scripts) --}}
<script>
    var KTAppSettings = {!! json_encode(config('layout.js'), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) !!};
</script>

{{-- Global Theme JS Bundle (used by all pages)  --}}
@foreach(config('layout.resources.js') as $script)
    <script src="{{ global_asset($script) }}" type="text/javascript"></script>
@endforeach

{{-- Includable JS --}}
@yield('scripts')
<script type="text/javascript">
    @if(Session::has('message'))
        toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    // toastr.success("New order has been placed!");
    var type = "{{Session::get('alert-type','info')}}"
    switch (type) {
        case 'info':
            toastr.info("{{Session::get('message') }}");
            break;
        case 'success':
            toastr.success("{{Session::get('message') }}");
            break;
        case 'warning':
            toastr.warning("{{Session::get('message') }}");
            break;
        case 'error':
            toastr.error("{{Session::get('message') }}");
            break;
    }
    @endif
</script>

@livewireScripts
</body>
</html>

