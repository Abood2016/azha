<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-clean-custom nav-link']) }}>
    {{ $slot }}
</button>
