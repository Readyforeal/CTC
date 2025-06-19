<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<section class="w-full">
    <div class="pb-6 flex justify-between">
        <div class="flex items-center gap-2">
            <flux:icon.currency-dollar />
            <h1 class="text-3xl font-semibold">Estimating</h1>
        </div>
    </div>

    <flux:separator/>

    <div class="grid grid-cols-3 gap-4 mt-6">
        <div>
            <div class="flex gap-2 items-center">
                <flux:icon.document-currency-dollar />
                <h2 class="text-xl">Proposals</h2>
            </div>

            <div class="mt-3">
                @foreach (App\Models\Proposal::where('status', '!=', 'Completed')->get() as $proposal)
                    <flux:callout>
                        <flux:callout.heading class="justify-between">
                            <flux:link class="ml-1" href="/project/{{ $proposal->project->id }}/proposal/{{ $proposal->id }}">{{ $proposal->name }}</flux:link>
                            <div>
                                Due date {{ $proposal->due_date }}
                                <flux:badge class="ml-2">{{ $proposal->status }}</flux:badge>
                            </div>
                        </flux:callout.heading>
                    </flux:callout>
                @endforeach
            </div>
        </div>

        <div class="col-span-2">

            <div class="flex justify-between items-center">
                <div class="flex gap-2 items-center">
                    <flux:icon.home />
                    <h2 class="text-xl">Projects</h2>
                </div>
                @livewire('create-project-form')
            </div>

            <div class="mt-3 grid grid-cols-2 gap-2">
                @foreach ($projects as $project)
                    <flux:callout>
                        <flux:callout.heading>
                            <flux:link href="/project/{{ $project->id }}">{{ $project->name }}</flux:link>
                        </flux:heading>

                        <flux:callout.text>
                            {{ $project->address }}
                            <flux:spacer></flux:spacer>
                            <flux:badge class="mt-1" color="lime">{{ $project->status }}</flux:badge>
                            <flux:badge class="mt-1" color="blue">{{ $project->super }}</flux:badge>
                        </flux:callout.text>
                        

                        @if ($project->storage_url != '')
                            <flux:callout.link href="{{ $project->storage_url }}"><flux:icon.cloud class="inline" /> OneDrive</flux:callout.link>
                        @endif
                        
                    </flux:callout>
                @endforeach
            </div>
        </div>
    </div>
</section>
