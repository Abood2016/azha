@props(['style' => 'primary'])

<a {{ $attributes->merge(['class' => 'font-weight-bold btn-sm btn btn-'.$style]) }}>
    {{ $slot }}
</a>
