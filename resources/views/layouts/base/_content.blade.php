{{-- Content --}}
@if (config('layout.content.extended'))
    @yield('content')
    {{ $slot }}
@else
    <div class="d-flex flex-column-fluid">
        <div class="{{ Metronic::printClasses('content-container', false) }}">
            @yield('content')
        </div>
    </div>
@endif
