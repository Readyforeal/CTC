<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<section class="w-full">
    <div class="pb-6 border-b flex justify-between">
        <div>
            <h1 class="text-3xl font-semibold">{{ $proposal->name }}</h1>
            <div class="flex gap-2 items-center my-3">
                <div>
                    <p class="text-sm font-bold">{{ $project->name }}</p>
                    <p class="text-sm">{{ $project->address }}</p>
                </div>
            </div>
            <flux:text>{{ $proposal->scope }}</flux:text>

            @if ($proposal->storage_url != '')
                <div class="mt-2 flex items-center gap-1 ">
                    <flux:icon.cloud variant="mini" class="inline text-blue-500" />
                    <flux:link variant="subtle" href="{{ $project->storage_url }}">OneDrive</flux:link>
                </div>
            @endif
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

        <div class="mt-3 border border-collapse rounded-lg">
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
                    @foreach ($proposal->bidTrackers as $bidTracker)    
                        <tr class="{{ !$loop->first ? 'border-t' : '' }} {{ $bidTracker->status == 'Received' ? 'bg-green-50' : '' }} text-sm">
                            <td class="p-2">{{ $bidTracker->category->name }}</td>
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
                                        <flux:badge variant="pill" color="zinc">{{ $bidTracker->status }}</flux:badge>
                                        @break
                                    @case('In progress')
                                        <flux:badge variant="pill" color="yellow">{{ $bidTracker->status }}</flux:badge>
                                        @break
                                    @case('Received')
                                        <flux:badge variant="pill" color="green">{{ $bidTracker->status }}</flux:badge>
                                        @break
                                    @case('Declined')
                                        <flux:badge variant="pill" color="red">{{ $bidTracker->status }}</flux:badge>
                                        @break
                                    @default
                                        
                                @endswitch

                                @if ($editingStatus and $editingId == $bidTracker->id)
                                    <div class="absolute bottom-full mb-2 left-0 right-0 z-10 border rounded-lg shadow-lg bg-zinc-50 p-1" wire:transition>
                                        <ul>
                                            <li class="hover:bg-zinc-100 hover:cursor-pointer p-1 rounded-lg" @click.stop wire:click="saveStatus('Not started')"><flux:badge variant="pill" color="zinc">Not started</flux:badge></li>
                                            <li class="hover:bg-zinc-100 hover:cursor-pointer p-1 rounded-lg" @click.stop wire:click="saveStatus('In progress')"><flux:badge variant="pill" color="yellow">In progress</flux:badge></li>
                                            <li class="hover:bg-zinc-100 hover:cursor-pointer p-1 rounded-lg" @click.stop wire:click="saveStatus('Received')"><flux:badge variant="pill" color="green">Received</flux:badge></li>
                                            <li class="hover:bg-zinc-100 hover:cursor-pointer p-1 rounded-lg" @click.stop wire:click="saveStatus('Declined')"><flux:badge variant="pill" color="red">Declined</flux:badge></li>
                                        </ul>
                                    </div>
                                @endif
                            </td>
                            {{-- <td class="p-2">
                                
                                @switch($bidTracker->status)
                                    @case('In progress')
                                        <flux:badge variant="pill" icon="clock" size="sm" color="yellow">{{ $bidTracker->status }}</flux:badge>
                                        @break
                                    @case('Received')
                                        <flux:badge variant="pill" icon="check-circle" size="sm" color="green">{{ $bidTracker->status }}</flux:badge>
                                        @break
                                    @default
                                        <flux:badge variant="pill" icon="minus-circle" size="sm" color="gray">{{ $bidTracker->status }}</flux:badge>
                                @endswitch
                                
                            </td> --}}
                            <td class="p-2 flex gap-2 items-center">
                                @livewire('create-bid-form', ['bidTrackerId' => $bidTracker->id], key('create-bid-form-' . $bidTracker->id))
                                @foreach($bidTracker->bids as $bid)
                                    @livewire('bid-view', ['bidId' => $bid->id], key('bid-' . $bid->id))
                                @endforeach
                            </td>
                            <td class="p-2">
                                ${{ $bidTracker->bids()->latest()->first()->amount ?? '0.00' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
