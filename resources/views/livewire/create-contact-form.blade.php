<div>
    <flux:modal.trigger name="create-contact-{{ $accountId }}">
        <flux:button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-contact-{{ $accountId }}')">
            {{ __('Create contact') }}
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="create-contact-{{ $accountId }}" :show="$errors->isNotEmpty()" focusable class="w-xl" @close="clear">
        <form wire:submit="store" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Create contact') }}</flux:heading>
            </div>

            <flux:input wire:model="name" :label="__('Name')" type="text" />

            <flux:input wire:model="email" :label="__('Email')" type="email" />

            <flux:input mask="(999) 999-9999" wire:model="phone_1" :label="__('Office Phone')" type="phone" />

            <flux:input mask="(999) 999-9999" wire:model="phone_2" :label="__('Mobile Phone')" type="phone" />

            <flux:select wire:model="preferred" :label="__('Preferred Contact Method')">
                <flux:select.option value="">Select preferred method...</flux:select>
                <flux:select.option value="Call">Call</flux:select>
                <flux:select.option value="Text">Text</flux:select>
                <flux:select.option value="Email">Email</flux:select>
            </flux:select>

            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cancel') }}</flux:button>
                </flux:modal.close>

                <flux:button variant="primary" type="submit">{{ __('Create contact') }}</flux:button>
            </div>
        </form>
    </flux:modal>
</div>