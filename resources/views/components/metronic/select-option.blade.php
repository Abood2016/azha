@props(['loopId' => '', 'selectedId' => '', 'selectName' => ''])

<option {!! $attributes->merge(['value' => '']) !!}
    @if (old($selectName) == $loopId) selected="selected" @endif
    @if($loopId === $selectedId) selected="selected" @endif
        {{ old('selectName') == $loopId ? "selected" : "" }}
>
    {{ $slot }}
</option>