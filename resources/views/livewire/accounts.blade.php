<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<section class="w-full">
    <div class="pb-6 border-b flex justify-between">
        <div class="flex items-center gap-2">
            <flux:icon.user-circle />
            <h1 class="text-3xl font-semibold">Accounts</h1>
        </div>

        @livewire('create-account-form')
    </div>

    <div class="mt-6">

        <flux:text class="mb-3">Ensure all contacts are harmonious with Outlook and iCloud contacts</flux:text>

        @if($accountsWithoutContacts->count() > 0)
            <flux:callout class="mb-3" icon="exclamation-triangle" variant="danger" inline>
                <flux:callout.heading>Missing contact info</flux:callout.heading>
                <flux:callout.text>{{ $accountsWithoutContacts->count() }} accounts are missing contact information</flux:callout.text>
            </flux:callout>
        @endif

        @foreach (App\Models\Category::get() as $category)
            <div class="py-2">
                <flux:badge variant="solid" color="zinc">{{ $category->sort_order }}. {{ $category->name }}</flux:badge>
            </div>

            @foreach ($accounts->where('category_id', $category->id) as $account)
                <flux:callout class="{{ !$loop->first ? 'mt-2' : '' }}">
                    <flux:callout.heading>
                        <flux:modal.trigger name="view-account-{{ $account->id }} }}">
                            <p class="hover:cursor-pointer">
                                {{ $account->name }}
                                @if ($account->contacts->count() == 0)
                                    <flux:badge size="sm" color="red" class="ml-2">Missing info</flux:badge>
                                @endif
                            </p>
                        </flux:modal.trigger>

                        <flux:modal name="view-account-{{ $account->id }} }}" class="w-3xl" variant="flyout">
                            <div class="space-y-6">
    
                                <flux:heading class="flex gap-2">
                                    @livewire('edit-account-form', ['accountId' => $account->id], key('edit-account-' . $account->id))
                                    {{ $account->name }}
                                </flux:heading>
    
                                <div class="flex justify-between">
                                    <p class="text-xl flex items-center gap-1"><flux:icon.user-circle />Contacts</p>
                                    @livewire('create-contact-form', ['accountId' => $account->id], key($account->id))
                                </div>
    
                                <div class="border rounded-lg overflow-hidden">
                                    <table class="table-auto w-full">
                                        <thead class="border-b">
                                            <th class="text-left text-sm font-normal p-2">Name</th>
                                            <th class="text-left text-sm font-normal p-2">Email</th>
                                            <th class="text-left text-sm font-normal p-2">Office</th>
                                            <th class="text-left text-sm font-normal p-2">Mobile</th>
                                            <th class="text-left text-sm font-normal p-2">Preferred</th>
                                            <th></th>
                                        </thead>
    
                                        <tbody>
                                            @forelse ($account->contacts as $contact)
                                                <tr class="{{ !$loop->first ? 'border-t' : '' }} text-xs group">
                                                    <td class="p-2 hover:bg-zinc-100">{{ $contact->name }}</td>
                                                    <td class="p-2 hover:bg-zinc-100"><flux:link href="mailto:{{ $contact->email }}">{{ $contact->email }}</flux:link></td>
                                                    <td class="p-2 hover:bg-zinc-100">{{ $contact->phone_1 }}</td>
                                                    <td class="p-2 hover:bg-zinc-100">{{ $contact->phone_2 }}</td>
                                                    <td class="p-2 hover:bg-zinc-100">{{ $contact->preferred }}</td>
                                                    <td><flux:button wire:click="deleteContact({{ $contact->id }})" icon="trash" size="xs"></flux:button></td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
    
    
                                <p class="text-xl flex items-center gap-1"><flux:icon.document-currency-dollar />Bid Trackers</p>
                                    
                                @forelse ($account->bidTrackers->where('status', '!=', 'Received' ) as $bidTracker)
                                    <div class="border rounded-lg p-2">
                                        <flux:text>{{ $bidTracker->proposal->project->name }}</flux:text>
    
                                        <flux:link
                                            href="/project/{{ $bidTracker->proposal->project->id }}/proposal/{{ $bidTracker->proposal->id }}">
                                            {{ $bidTracker->proposal->name }}
                                        </flux:link>
    
                                        <div class="mt-2">
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
                                        </div>
                                    </div>
                                @empty
                                    <flux:text>No active or pending estimates at this time</flux:text>
                                @endforelse
                            </div>
                        </flux:modal>
                    </flux:callout.heading>
                </flux:callout>
            @endforeach
        @endforeach
    </div>
</section>
