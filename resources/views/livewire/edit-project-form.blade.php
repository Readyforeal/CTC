<div>
    <flux:modal.trigger name="edit-project">
        <flux:button x-data="" x-on:click.prevent="$dispatch('open-modal', 'edit-project')">
            {{ __('Edit project') }}
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="edit-project" :show="$errors->isNotEmpty()" focusable class="w-xl">
        <form wire:submit="update" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Edit project') }}</flux:heading>
            </div>

            <flux:input wire:model="name" :label="__('Name')" type="text" />

            <flux:input wire:model="address" :label="__('Address')" type="text" />

            <flux:input wire:model="super" :label="__('Super')" type="text" />

            <flux:select wire:model="status" :label="__('Status')">
                <flux:select.option value="">Select status...</flux:select.option>
                <flux:select.option value="Estimating">Estimating</flux:select.option>
                <flux:select.option value="Active">Active</flux:select.option>
            </flux:select>

            <flux:input wire:model="storage_url" :label="__('Storage URL')" type="text" />

            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cancel') }}</flux:button>
                </flux:modal.close>

                <flux:button variant="primary" type="submit">{{ __('Update project') }}</flux:button>
            </div>
        </form>
    </flux:modal>
</div>