{{-- Aside --}}
<div class="aside aside-left {{ Metronic::printClasses('aside', false) }} d-flex flex-column flex-row-auto"
    id="kt_aside">

    {{-- Brand --}}
    <div class="brand flex-column-auto {{ Metronic::printClasses('brand', false) }}" id="kt_brand">
        <div class="brand-logo">
            <a href="#">
                <img class="border img-thumbnail mt-3" width="60%" alt="{{ config('app.name') }}" src="{{ global_asset('media/logos/logo-app.png') }}" />
            </a>
        </div>

        @if (config('layout.aside.self.minimize.toggle'))
        <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
            {{ Metronic::getSVG("media/svg/icons/Navigation/Angle-double-left.svg", "svg-icon-xl") }}
        </button>
        @endif

    </div>

    {{-- Aside menu --}}
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">

        @if (config('layout.aside.self.display') === false)
        <div class="header-logo">
            <a href="{{ url('/') }}">
                <img alt="{{ config('app.name') }}" src="{{ global_asset('media/logos/'.$kt_logo_image) }}" />
            </a>
        </div>
        @endif

        <div id="kt_aside_menu" class="aside-menu my-4 {{ Metronic::printClasses('aside_menu', false) }}"
            data-menu-vertical="1" {{ Metronic::printAttrs('aside_menu') }}>

            @if (in_array(request()->getHost(), config('tenancy.central_domains')))
            <ul class="menu-nav {{ Metronic::printClasses('aside_menu_nav', false) }}">
                {{ Menu::renderVerMenu(config('central_menu_aside.items')) }}
            </ul>
            @else
            <ul class="menu-nav {{ Metronic::printClasses('aside_menu_nav', false) }}">
                @if (auth()->user()->role === 0)
                    {{ Menu::renderVerMenu(config('menu_aside.items')) }}
                @else(auth()->user()->role === 1)
                    <?php
                    $menu = \App\Http\Controllers\Dashboard\Metronic\MenuAsideController::generateMenu();
                    ?>
                    {{ Menu::renderVerMenu($menu) }}
                @endif
            </ul>
            @endif
        </div>
    </div>

</div>
