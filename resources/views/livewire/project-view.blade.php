<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<section class="w-full">
    <div class="pb-6 flex justify-between">
        <div>
            <h1 class="text-3xl font-semibold flex items-center gap-2">
                @if($project->storage_url)
                    <flux:link variant="subtle" target="_blank" href="{{ $project->storage_url }}"><flux:icon.folder /></flux:link>
                @endif
                {{ $project->name }}
            </h1>
            <flux:text class="text-accent">{{ $project->address }}</flux:text>
        
            <div class="mt-2">
                <flux:badge color="{{ $project->status == 'Active' ? 'lime' : 'orange' }}">{{ $project->status }}</flux:badge>
                <flux:badge color="blue">{{ $project->super }}</flux:badge>
            </div>
        </div>

        @livewire('edit-project-form', ['projectId' => $project->id])
    </div>
    
    <flux:separator />

    <div class="mt-6">
        <div class="flex justify-between">
            <h1 class="text-xl font-semibold">Proposals</h1>
            @livewire('create-proposal-form', ['projectId' => $project->id])
        </div>

        <div class="mt-3 space-y-2">
            @foreach ($project->proposals as $proposal)
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
</section>
