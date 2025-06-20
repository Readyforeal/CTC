<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class EditProjectForm extends Component
{
    public $projectId;

    public $name;
    public $address;
    public $super;
    public $status;
    public $storage_url;

    public function render()
    {
        $project = Project::find($this->projectId);

        $this->name = $project->name;
        $this->address = $project->address;
        $this->super = $project->super;
        $this->status = $project->status;
        $this->storage_url = $project->storage_url;
        
        return view('livewire.edit-project-form', ['project' => $project]);
    }

    public function update()
    {
        $project = Project::find($this->projectId);

        $project->update([
            'name' => $this->name,
            'address' => $this->address,
            'super' => $this->super,
            'status' => $this->status,
            'storage_url' => $this->storage_url
        ]);

        $this->dispatch('project-updated');
        $this->modal('edit-project')->close();
    }
}
