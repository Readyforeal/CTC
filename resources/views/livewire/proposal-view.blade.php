<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<section class="w-full">
    <div
        x-data="{ atTop: true }" 
        x-init="() => { 
            atTop = window.scrollY < 10;
            window.addEventListener('scroll', () => {
                atTop = window.scrollY < 10;
            });
        }"
        :class="{
            'bg-zinc-50 border-none': atTop,
            'bg-zinc-100/80 backdrop-blur-xl border p-3': !atTop
        }"
        class="transition-all duration-250 ease-out rounded-xl flex justify-between sticky top-3 z-10">
        <div>
            <h1 class="text-3xl font-semibold flex items-center gap-2">
                <flux:link variant="subtle" target="_blank" href="{{ $proposal->storage_url }}"><flux:icon.table-cells /></flux:link>
                {{ $proposal->name }}
            </h1>
            <div class="flex gap-2 items-center mt-1">
                <div>
                    <flux:text class="text-sm flex items-center gap-2">
                        <flux:link variant="subtle" target="_blank" href="{{ $proposal->project->storage_url }}"><flux:icon.folder /></flux:link>
                        <flux:link href="/project/{{ $project->id }}">
                            {{ $project->name }} - 
                            {{ $project->address }}
                        </flux:link>
                </flux:text>
                </div>
            </div>
            <flux:text class="mt-2 flex items-center gap-2">
                <flux:icon.bars-3-bottom-left />
                {{ $proposal->scope }}
            </flux:text>
        </div>

        @livewire('edit-proposal-form', ['proposalId' => $proposal->id])
    </div>

    <div class="mt-6">
        <div class="flex justify-between">
            <h1 class="text-3xl font-semibold">Bid Trackers</h1>

            <div class="flex gap-2"> 
                @livewire('create-email-form', ['projectId' => $project->id, 'proposalId' => $proposal->id])
                @livewire('create-bid-tracker-form', ['projectId' => $project->id, 'proposalId' => $proposal->id])
            </div>
        </div>

        <div class="relative mt-3 border border-collapse rounded-lg">
            <table class="table-fixed w-full">
                <thead class="border-b">
                    <tr>
                        <th class="text-left text-sm font-normal p-2"><flux:button variant="ghost" size="xs" icon="tag">Category</flux:button></th>
                        <th class="text-left text-sm font-normal p-2"><flux:button variant="ghost" size="xs" icon="user">Account</flux:button></th>
                        <th class="text-left text-sm font-normal p-2"><flux:button variant="ghost" size="xs" icon="calendar">Followed up</flux:button></th>
                        <th class="text-left text-sm font-normal p-2"><flux:button variant="ghost" size="xs" icon="pencil-square">Notes</flux:button></th>
                        <th class="text-left text-sm font-normal p-2"><flux:button variant="ghost" size="xs" icon="cursor-arrow-rays">Status</flux:button></th>
                        <th class="text-left text-sm font-normal p-2"><flux:button variant="ghost" size="xs" icon="cloud">Bid</flux:button></th>
                        <th class="text-left text-sm font-normal p-2"><flux:button variant="ghost" size="xs" icon="currency-dollar">Amount</flux:button></th>
                    </tr>
                </thead>
    
                <tbody>
                    @php
                        $lowestBidsByCategory = $proposal->bidTrackers
                            ->groupBy('category_id')
                            ->map(function ($trackers) {
                                return $trackers->flatMap->bids->sortBy('amount')->first();
                            })
                            ->filter(); // removes nulls
                    @endphp
                    @foreach ($proposal->bidTrackers as $bidTracker)    
                        <tr class="{{ !$loop->first ? 'border-t' : '' }} {{ $bidTracker->status == 'Received' ? 'bg-green-50' : '' }} text-sm">
                            <td class="p-2">
                                @php
                                    $colors = ['red', 'blue', 'green', 'yellow', 'purple', 'pink', 'indigo', 'gray', 'teal', 'orange'];

                                    $index = $bidTracker->category->id % count($colors);
                                    $color = $colors[$index];
                                @endphp
                                <flux:badge inset="top bottom" color="{{ $color }}">{{ $bidTracker->category->name }}</flux:badge>
                            </td>
                            <td class="p-2">{{ $bidTracker->account->name }}</td>
                            <td class="p-2 {{ ($editingFollowedUpDate && $editingId == $bidTracker->id) ? 'outline-2 outline-blue-300 rounded-lg' : '' }} relative" wire:click="editDueDate({{ $bidTracker->id }})">
                                {{ $bidTracker->followed_up }}
                                @if($editingFollowedUpDate and $editingId == $bidTracker->id)
                                    <div class="absolute bottom-full mb-2 left-0 right-0 z-10" wire:transition>
                                        <flux:input icon:trailing="arrow-turn-down-left" size="sm" type="date"
                                            wire:model.defer="editingValue"
                                            wire:keydown.enter="saveDueDate"
                                            wire:blur="$set('editingId', null)"
                                        />
                                    </div>
                                @endif
                            </td>
                            <td class="p-2 {{ ($editingNotes && $editingId == $bidTracker->id) ? 'outline-2 outline-blue-300 rounded-lg' : '' }} relative" wire:click="editNotes({{ $bidTracker->id }}, 'notes')">
                                {{ $bidTracker->notes }}
                                @if($editingNotes and $editingId == $bidTracker->id)
                                    <div class="absolute bottom-full mb-2 left-0 right-0 z-10" wire:transition>
                                        <flux:input icon:trailing="arrow-turn-down-left" size="sm" type="text"
                                            wire:model.defer="editingValue"
                                            wire:keydown.enter="save"
                                            wire:blur="$set('editingId', null)"
                                        />
                                    </div>
                                @endif
                            </td>
                            <td class="p-2 {{ ($editingStatus && $editingId == $bidTracker->id) ? 'outline-2 outline-blue-300 rounded-lg' : '' }} relative" wire:click="editStatus({{ $bidTracker->id }})">
                                
                                @switch($bidTracker->status)
                                    @case('Not started')
                                        <flux:badge inset="top bottom" as="button" color="zinc">{{ $bidTracker->status }}</flux:badge>
                                        @break
                                    @case('In progress')
                                        <flux:badge inset="top bottom" as="button" color="yellow">{{ $bidTracker->status }}</flux:badge>
                                        @break
                                    @case('Received')
                                        <flux:badge inset="top bottom" as="button" color="green">{{ $bidTracker->status }}</flux:badge>
                                        @break
                                    @case('Declined')
                                        <flux:badge inset="top bottom" as="button" color="red">{{ $bidTracker->status }}</flux:badge>
                                        @break
                                    @default
                                        
                                @endswitch

                                @if ($editingStatus and $editingId == $bidTracker->id)
                                    <div class="absolute bottom-full mb-2 left-0 right-0 z-10 border rounded-lg shadow-lg bg-zinc-50 p-1" wire:transition>
                                        <ul>
                                            <li class="hover:bg-zinc-100 hover:cursor-pointer p-1 rounded-lg" @click.stop wire:click="saveStatus('Not started')"><flux:badge as="button" color="zinc">Not started</flux:badge></li>
                                            <li class="hover:bg-zinc-100 hover:cursor-pointer p-1 rounded-lg" @click.stop wire:click="saveStatus('In progress')"><flux:badge as="button" color="yellow">In progress</flux:badge></li>
                                            <li class="hover:bg-zinc-100 hover:cursor-pointer p-1 rounded-lg" @click.stop wire:click="saveStatus('Received')"><flux:badge as="button" color="green">Received</flux:badge></li>
                                            <li class="hover:bg-zinc-100 hover:cursor-pointer p-1 rounded-lg" @click.stop wire:click="saveStatus('Declined')"><flux:badge as="button" color="red">Declined</flux:badge></li>
                                        </ul>
                                    </div>
                                @endif
                            </td>
                            {{-- <td class="p-2">
                                
                                @switch($bidTracker->status)
                                    @case('In progress')
                                        <flux:badge icon="clock" size="sm" color="yellow">{{ $bidTracker->status }}</flux:badge>
                                        @break
                                    @case('Received')
                                        <flux:badge icon="check-circle" size="sm" color="green">{{ $bidTracker->status }}</flux:badge>
                                        @break
                                    @default
                                        <flux:badge icon="minus-circle" size="sm" color="gray">{{ $bidTracker->status }}</flux:badge>
                                @endswitch
                                
                            </td> --}}
                            <td class="p-2 flex gap-2 items-center">
                                @livewire('create-bid-form', ['bidTrackerId' => $bidTracker->id], key('create-bid-form-' . $bidTracker->id))
                                @foreach($bidTracker->bids as $bid)
                                    @php
                                        $categoryId = $bidTracker->category_id;
                                        $lowestBid = $lowestBidsByCategory[$categoryId] ?? null;
                                        $isLowest = $lowestBid && $bid->id === $lowestBid->id;
                                    @endphp

                                    <div class="flex items-center gap-1">
                                        @livewire('bid-view', ['bidId' => $bid->id], key('bid-' . $bid->id))
                                        @if($isLowest)
                                            <span title="Lowest bid in category"><flux:icon.star variant="micro" class="text-amber-500" /></span>
                                        @endif
                                    </div>
                                @endforeach
                            </td>
                            <td class="p-2 text-right">
                                {{ Illuminate\Support\Number::currency($bidTracker->bids()->latest()->first()->amount ?? '0.00') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="p-3 border rounded-xl flex justify-between sticky bottom-3 z-10 bg-zinc-100">
        <flux:text variant="strong" class="flex gap-2 items-center">
            @php
                $total = $proposal->bidTrackers
                    ->groupBy('category_id')
                    ->map(function ($trackers) {
                        // For each category group, collect all bids and find the lowest amount
                        return $trackers->flatMap->bids->min('amount');
                    })
                    ->filter() // Filter out nulls (in case a group has no bids)
                    ->sum();
            @endphp
            <flux:icon.currency-dollar /> Total Low: {{ Illuminate\Support\Number::currency($total) }}
        </flux:text>
    
        <flux:text variant="strong" class="flex gap-2 items-center">
            @if($proposal->bidTrackers->count() > 0)
                <flux:icon.chart-bar-square /> Received: {{ round(($proposal->bidTrackers->where('status', '=', 'Received')->count() / $proposal->bidTrackers->count()) * 100) }}%
            @endif
        </flux:text>
    </div>
</section>