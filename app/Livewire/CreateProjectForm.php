<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class CreateProjectForm extends Component
{
    public $name = '';
    public $address = '';
    public $super = '';
    public $status = '';
    public $storage_url = '';

    public function render()
    {
        return view('livewire.create-project-form');
    }

    public function store()
    {
        $project = Project::create([
            'name' => $this->name,
            'address' => $this->address,
            'super' => $this->super,
            'status' => $this->status,
            'storage_url' => $this->storage_url
        ]);

        $project->proposals()->create([
            'name' => 'Cost Plus Range Proposal',
            'scope' => '',
            'due_date' => '',
            'storage_url' => '',
        ]);

        $this->dispatch('project-created');
        $this->modal('create-project')->close();
    }
}
