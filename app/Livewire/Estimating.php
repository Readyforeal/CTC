<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;

class Estimating extends Component
{
    public $projects;

    #[On('project-created')]
    public function render()
    {
        $this->projects = Project::all();
        return view('livewire.estimating');
    }
}
