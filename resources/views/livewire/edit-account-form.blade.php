<div>
    <flux:modal.trigger name="edit-account-{{ $accountId }}">
        <flux:button size="xs" icon="pencil-square" x-data="" x-on:click.prevent="$dispatch('open-modal', 'edit-account-{{ $accountId }}')"></flux:button>
    </flux:modal.trigger>

    <flux:modal name="edit-account-{{ $accountId }}" :show="$errors->isNotEmpty()" focusable class="w-xl">
        <form wire:submit="update" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Edit account') }}</flux:heading>
            </div>

            <flux:select wire:model.defer="category_id" :label="__('Category')">
                    <flux:select.option value="">Select category...</flux:select.option>
                    @foreach (App\Models\Category::get() as $category)
                        <flux:select.option value="{{ $category->id }}">{{ $category->name }}</flux:select.option>
                    @endforeach
            </flux:select>

            <flux:input wire:model="name" :label="__('Name')" type="text" />

            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cancel') }}</flux:button>
                </flux:modal.close>

                <flux:button variant="primary" type="submit">{{ __('Update account') }}</flux:button>
            </div>
        </form>
    </flux:modal>
</div>