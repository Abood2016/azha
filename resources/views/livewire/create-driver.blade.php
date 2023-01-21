<div>
    <x-metronic.primary-button wire:click="confirmDriverCreation" wire:loading.attr="disabled">
        <span class="svg-icon svg-icon-md">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1" />
                    <rect fill="#000000" opacity="0.3"
                        transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) "
                        x="4" y="11" width="16" height="2" rx="1" />
                </g>
            </svg>
        </span>
        {{ __('New Record') }}
    </a>
    </x-metronic.primary-button>

    <!-- Delete User Confirmation Modal -->
    <x-metronic.dialog-modal wire:model="confirmingDriverCreation">
        <x-slot name="title">
            {{ __('Create Driver') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4" x-data="{}"
                x-on:confirming-create-user.window="setTimeout(() => $refs.password.focus(), 250)">
                <div class="mb-5">
                    <x-metronic.label for="name" value="{{ __('Name') }}" />
                    <x-metronic.input type="text" class="mt-1 block w-75" placeholder="{{ __('Name') }}"
                        x-ref="name" wire:model.defer="name" />
                    <x-metronic.input-error for="name" class="mt-2" />
                </div>
                <div class="mb-5">
                    <x-metronic.label for="email" value="{{ __('Email Address') }}" />
                    <x-metronic.input type="email" class="mt-1 block w-75" placeholder="{{ __('Email address') }}"
                        x-ref="email" wire:model.defer="email" />
                    <x-metronic.input-error for="email" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-metronic.secondary-button wire:click="$toggle('confirmingDriverCreation')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-metronic.secondary-button>

            <x-metronic.button class="ml-2" wire:click="createDriver" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-metronic.button>
        </x-slot>
    </x-metronic.dialog-modal>
</div>