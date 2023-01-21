@props(['style' => 'dark'])

<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-' . $style]) }}>
    {{ $slot }}
</button>
