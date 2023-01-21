@props(['value'])

<label {{ $attributes->merge(['class' => 'm-0']) }}>
    {{ $value ?? $slot }}
</label>