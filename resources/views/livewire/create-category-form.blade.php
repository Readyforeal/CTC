<div>
    <flux:modal.trigger name="create-category">
        <flux:button variant="primary" x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-category')">
            {{ __('Create category') }}
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="create-category" :show="$errors->isNotEmpty()" focusable class="w-xl">
        <form wire:submit="store" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Create category') }}</flux:heading>
            </div>

            <flux:input wire:model="sort_order" :label="__('Sort order')" type="number" />

            <flux:input wire:model="name" :label="__('Name')" type="text" />

            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cancel') }}</flux:button>
                </flux:modal.close>

                <flux:button variant="primary" type="submit">{{ __('Create category') }}</flux:button>
            </div>
        </form>
    </flux:modal>
</div>