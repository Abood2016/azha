@props(['submit'])

<div {{ $attributes->merge(['class' => '']) }}>
    <x-metronic.section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-metronic.section-title>

    <div class="mt-5 mt-md-0">
        <form wire:submit.prevent="{{ $submit }}">
            <div class="">
                {{ $form }}
            </div>

            @if (isset($actions))
            <div class="d-flex align-items-center justify-content-end pt-8">
            {{ $actions }}
            </div>
            @endif
        </form>
    </div>
</div>