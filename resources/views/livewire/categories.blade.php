<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<section class="w-full">
    <div class="pb-6 border-b flex justify-between">
        <div class="flex items-center gap-2">
            <flux:icon.tag />
            <h1 class="text-3xl font-semibold">Categories</h1>
        </div>
        @livewire('create-category-form')
    </div>

    <div class="mt-6">
        <div class="mt-3">
            @foreach (App\Models\Category::get()->sortBy('sort_order') as $category)
                <div class="py-2 relative">
                    <flux:badge variant="solid" color="zinc" wire:click="editCategory({{ $category->id }})">{{ $category->sort_order }}. {{ $category->name }}</flux:badge>
                    
                    @if ($editingCategory and $editingId == $category->id)
                        <div class="absolute bottom-full mb-2 left-0 z-10 border rounded-lg shadow-lg bg-zinc-50 p-1 flex gap-1" wire:transition>
                            <flux:input size="sm" type="number"
                                wire:model.defer="editingSortOrder"
                                wire:keydown.enter="save"
                                wire:blur="$set('editingId', null)"
                            />
                            <flux:input icon:trailing="tag" size="sm" type="text"
                                wire:model.defer="editingName"
                                wire:keydown.enter="save"
                                wire:blur="$set('editingId', null)"
                            />
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
