<div>
    <flux:modal.trigger name="create-tracker">
        <flux:button variant="primary" x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-tracker')">
            {{ __('Create tracker') }}
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="create-tracker" :show="$errors->isNotEmpty()" focusable class="w-xl">
        <form wire:submit="store" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Create tracker') }}</flux:heading>
            </div>

            <flux:select wire:model.live="category_id" :label="__('Category')">
                    <flux:select.option value="">Select category...</flux:select.option>
                @foreach (App\Models\Category::get() as $category)
                    <flux:select.option value="{{ $category->id }}">{{ $category->name }}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:select wire:model.live="account_id" :label="__('Account')">
                <flux:select.option value="">Select account...</flux:select.option>
                @forelse (App\Models\Account::where('category_id', $category_id)->get() as $account)
                    <flux:select.option value="{{ $account->id }}">{{ $account->name }}</flux:select.option>
                @empty

                @endforelse
            </flux:select>

            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cancel') }}</flux:button>
                </flux:modal.close>

                <flux:button variant="primary" type="submit">{{ __('Create tracker') }}</flux:button>
            </div>
        </form>
    </flux:modal>
</div>