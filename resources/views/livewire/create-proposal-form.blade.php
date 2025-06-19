<div>
    <flux:modal.trigger name="create-proposal">
        <flux:button variant="primary" x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-proposal')">
            {{ __('Create Proposal') }}
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="create-proposal" :show="$errors->isNotEmpty()" focusable class="w-xl">
        <form wire:submit="store" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Create proposal') }}</flux:heading>
            </div>

            <flux:input wire:model="name" :label="__('Name')" type="text" />

            <flux:input wire:model="scope" :label="__('Scope')" type="text" />

            <flux:input wire:model="due_date" :label="__('Due Date')" type="date" />

            <flux:input wire:model="storage_url" :label="__('Storage URL')" type="text" />

            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cancel') }}</flux:button>
                </flux:modal.close>

                <flux:button variant="primary" type="submit">{{ __('Create proposal') }}</flux:button>
            </div>
        </form>
    </flux:modal>
</div>