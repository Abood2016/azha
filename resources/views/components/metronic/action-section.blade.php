<div class="" {{ $attributes }}>
    <x-metronic.section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-metronic.section-title>

    <div class="mt-5 mt-md-0">
        {{-- <div class="px-4 py-5 p-sm-6 bg-white"> --}}
            {{ $content }}
        {{-- </div> --}}
    </div>
</div>
