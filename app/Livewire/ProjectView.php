<?php

namespace App\Livewire;

use App\Models\Project as ProjectModel;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class ProjectView extends Component
{
    #[Url]
    public $projectId;

    #[On('proposal-created')]
    #[On('project-updated')]
    public function render()
    {
        return view('livewire.project-view', ['project' => ProjectModel::findOrFail($this->projectId)]);
    }
}
