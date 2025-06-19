<div>
    <flux:modal.trigger name="create-bid-{{ $bidTrackerId }}">
        <flux:button square size="xs" icon="plus" x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-bid-{{ $bidTrackerId }}')"></flux:button>
    </flux:modal.trigger>

    <flux:modal name="create-bid-{{ $bidTrackerId }}" :show="$errors->isNotEmpty()" focusable class="w-xl" @close="clear">
        <form wire:submit="store" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Create bid') }}</flux:heading>
            </div>

            <flux:input type="file" wire:model="file" label="Upload file" />
            
            <flux:input wire:model="details" :label="__('Details')" type="text" />
            
            <flux:input wire:model="amount" :label="__('Amount')" type="number" />
            
            <flux:input wire:model="storage_url" :label="__('Storage URL')" type="text" />
            
            <flux:checkbox wire:model="reviewed" :label="__('Reviewed')" />

            <flux:checkbox wire:model="printed" :label="__('Printed')" />

            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cancel') }}</flux:button>
                </flux:modal.close>

                <flux:button variant="primary" type="submit">{{ __('Create bid') }}</flux:button>
            </div>
        </form>
    </flux:modal>
</div>