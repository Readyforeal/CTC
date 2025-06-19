<div>
    <flux:modal.trigger name="edit-proposal">
        <flux:button x-data="" x-on:click.prevent="$dispatch('open-modal', 'edit-proposal')">
            {{ __('Edit Proposal') }}
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="edit-proposal" :show="$errors->isNotEmpty()" focusable class="w-xl">
        <form wire:submit="update" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Edit proposal') }}</flux:heading>
            </div>

            <flux:input wire:model="name" :label="__('Name')" type="text" />

            <flux:input wire:model="scope" :label="__('Scope')" type="text" />

            <flux:input wire:model="due_date" :label="__('Due Date')" type="date" />

            <flux:input wire:model="storage_url" :label="__('Storage URL')" type="text" />

            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cancel') }}</flux:button>
                </flux:modal.close>

                <flux:button variant="primary" type="submit">{{ __('Update proposal') }}</flux:button>
            </div>
        </form>
    </flux:modal>
</div>