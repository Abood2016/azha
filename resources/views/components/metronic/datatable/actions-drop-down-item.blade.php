<li class="nav-item px-2">
    <x-metronic.nav-link {{ $attributes->merge(['class' => 'btn btn-clean-custom px-4']) }}>
        {{ $slot }}
    </x-metronic.nav-link>
</li>