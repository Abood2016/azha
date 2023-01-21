<div {{ $attributes->merge(['class' => 'card card-custom']) }}>
    {{ $header ??= '' }}
    <div class="card-body">
        {{ $body }}
    </div>
</div>