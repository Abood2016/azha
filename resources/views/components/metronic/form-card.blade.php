@props(['updateForm' => null])

<div class="card card-custom">
    <form {{ $attributes->merge(['x-data' => "{ buttonDisabled: false }"]) }}>
        @csrf
        @if ($updateForm === 'on')
            @method('PATCH')
        @endif
        <div class="card-body">
            {{ $body }}
        </div>
        <div class="card-footer">
            <x-metronic.secondary-button data-dismiss="modal" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-metronic.secondary-button>

            <x-metronic.button x-on:click="buttonDisabled = true" x-bind:disabled="buttonDisabled" class="ml-2"
                wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-metronic.button>
        </div>
    </form>
</div>