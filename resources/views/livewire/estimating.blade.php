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

            <div class="mt-3 space-y-2">
                @foreach (App\Models\Proposal::where('status', '!=', 'Accepted')->get() as $proposal)   
                    <flux:callout>
                        <div class="flex justify-between">
                            <flux:text class="text-xs">{{ $proposal->project->name }}</flux:text>
                            <flux:text class="text-xs">Due: {{ $proposal->due_date ? $proposal->due_date : 'No date assigned' }}</flux:text>
                        </div>
                        <flux:callout.heading class="justify-between">
                            <flux:link class="ml-1" href="/project/{{ $proposal->project->id }}/proposal/{{ $proposal->id }}">{{ $proposal->name }}</flux:link>
                            <div>
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

            <div class="mt-3 border rounded-lg bg-white">
                @foreach ($projects as $project)
                    <div class="p-2 hover:bg-zinc-50 flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <flux:link target="_blank" href="{{ $project->storage_url }}">
                                <flux:icon.folder />
                            </flux:link>
                            <flux:link href="/project/{{ $project->id }}">
                                {{ $project->name }} - {{ $project->address }}
                            </flux:link>
                        </div>

                        <div class="flex items-center gap-2">
                            <flux:badge color="blue">{{ $project->super }}</flux:badge>
                            <flux:badge color="green">{{ $project->status }}</flux:badge>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
