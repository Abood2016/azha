<x-metronic.form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <div x-data="{photoName: null, photoPreview: null}" class="mb-5">
            <!-- Profile Photo File Input -->
            <input type="file" class="d-none" wire:model="photo" x-ref="photo" x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

            <x-metronic.label for="photo" value="{{ __('Photo') }}" />

            <!-- Current Profile Photo -->
            <div class="mt-2" x-show="! photoPreview">
                <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                    class="rounded-circle h-80px w-80px object-cover">
            </div>

            <!-- New Profile Photo Preview -->
            <div class="mt-2" x-show="photoPreview">
                <span class="d-block rounded-circle h-80px w-80px"
                    x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                </span>
            </div>

            <x-metronic.secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                {{ __('Select A New Photo') }}
            </x-metronic.secondary-button>

            @if ($this->user->profile_photo_path)
            <x-metronic.secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                {{ __('Remove Photo') }}
            </x-metronic.secondary-button>
            @endif

            <x-metronic.input-error for="photo" class="mt-2" />
        </div>
        @endif

        <!-- Name -->
        <div class="col-6 col-sm-4 p-0">
            <x-metronic.label for="name" value="{{ __('Name') }}" />
            <x-metronic.input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name"
                autocomplete="name" />
            <x-metronic.input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-6 col-sm-4 mt-5 p-0">
            <x-metronic.label for="email" value="{{ __('Email') }}" />
            <x-metronic.input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-metronic.input-error for="email" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-metronic.action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-metronic.action-message>

        <x-metronic.button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-metronic.button>
    </x-slot>
</x-metronic.form-section>