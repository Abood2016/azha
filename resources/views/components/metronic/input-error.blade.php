@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'font-size-sm text-danger']) }}>{{ $message }}</p>
@enderror
