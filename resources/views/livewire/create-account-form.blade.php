<div>
    <flux:modal.trigger name="create-account">
        <flux:button variant="primary" x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-account')">
            {{ __('Create account') }}
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="create-account" :show="$errors->isNotEmpty()" focusable class="w-xl">
        <form wire:submit="store" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Create account') }}</flux:heading>
            </div>

            <flux:select wire:model.live="category_id" :label="__('Category')">
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

                <flux:button variant="primary" type="submit">{{ __('Create account') }}</flux:button>
            </div>
        </form>
    </flux:modal>
</div>