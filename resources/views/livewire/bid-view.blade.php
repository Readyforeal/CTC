<div>
    <flux:modal.trigger name="view-bid-{{ $bid->id }}">
        <flux:button icon="document-text" size="xs" x-data="" x-on:click.prevent="$dispatch('open-modal', 'view-bid-{{ $bid->id }}')">
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="view-bid-{{ $bid->id }}" :show="$errors->isNotEmpty()" focusable variant="flyout">
        <form wire:submit="update" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('View bid') }}</flux:heading>
            </div>

            <h1 class="text-xl">{{ $bid->bidTracker->account->name }}</h1>

            <flux:text>{{ $bid->details }}</flux:text>

            <flux:text class="text-xl">${{ $bid->amount }}</flux:text>

            <div class="flex gap-2 items-center">
                <flux:icon.check-circle class="{{ $bid->reviewed ? 'opacity-100' : 'opacity-20' }}" />
                <flux:text>Reviewed</flux:text>
            </div>

            <div class="flex gap-2 items-center">
                <flux:icon.check-circle class="{{ $bid->printed ? 'opacity-100' : 'opacity-20' }}" />
                <flux:text>Printed</flux:text>
            </div>

            <flux:link target="_blank" href="{{ asset('storage/' . $bid->local_storage_url) }}">File</flux:link>

            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Close') }}</flux:button>
                </flux:modal.close>

                <flux:button variant="primary" type="submit">{{ __('Update bid') }}</flux:button>
                
                <flux:button wire:click="delete" icon="trash" variant="filled" />
            </div>
        </form>
    </flux:modal>
</div>