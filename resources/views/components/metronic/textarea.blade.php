@props(['rows' => '5', 'cols' => '33'])

<textarea {!! $attributes->merge(['class' => 'form-control form-control-solid']) !!}
          rows="{{ $rows }}" cols="{{ $cols }}"
          style="resize: none;">
</textarea>