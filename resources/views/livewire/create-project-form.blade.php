<div>
    <flux:modal.trigger name="create-project">
        <flux:button variant="primary" size="xs" x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-project')">
            {{ __('Create project') }}
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="create-project" :show="$errors->isNotEmpty()" focusable class="w-xl">
        <form wire:submit="store" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Create project') }}</flux:heading>
            </div>

            <flux:input wire:model="name" :label="__('Name')" type="text" />

            <flux:input wire:model="address" :label="__('Address')" type="text" />

            <flux:input wire:model="super" :label="__('Super')" type="text" />

            <flux:input wire:model="status" :label="__('Status')" type="text" />

            <flux:input wire:model="storage_url" :label="__('Storage URL')" type="text" />

            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cancel') }}</flux:button>
                </flux:modal.close>

                <flux:button variant="primary" type="submit">{{ __('Create project') }}</flux:button>
            </div>
        </form>
    </flux:modal>
</div>