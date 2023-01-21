@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-weight-bold text-danger">{{ __('Whoops! Something went wrong.') }}</div>

        <ul class="mt-3 font-size-sm text-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
