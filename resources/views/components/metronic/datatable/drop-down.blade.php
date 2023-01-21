<div class="d-flex align-items-center">
    <label class="mr-3 mb-0 d-none d-md-block">{{ __($label) }}:</label>
    <select id="{{ $selector }}"{!! $attributes->merge(['class' => 'form-control form-control-solid']) !!}>
        <option value="">All</option>
        {{ $slot }}
    </select>
</div>