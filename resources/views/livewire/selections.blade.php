<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<section class="w-full">
    <div class="pb-6 flex justify-between">
        <div class="flex items-center gap-2">
            <flux:icon.check-circle />
            <h1 class="text-3xl font-semibold">Selections</h1>
        </div>
    </div>

    <flux:separator/>

    <div class="mt-6">
        <div class="flex justify-between items-center">
            <div class="flex gap-2 items-center">
                <flux:icon.home />
                <h2 class="text-xl">Projects</h2>
            </div>
            @livewire('create-project-form')
        </div>

        <div class="mt-3 border rounded-lg bg-white">
            @foreach (App\Models\Project::get()->sortBy('name') as $project)
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
                        <flux:badge color="blue">{{ $project->super ? $project->super : 'N/A' }}</flux:badge>
                        <flux:badge color="green">{{ $project->status ? $project->status : 'N/A' }}</flux:badge>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
