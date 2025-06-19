<?php

namespace App\Livewire;

use App\Models\Proposal;
use Livewire\Component;

class CreateProposalForm extends Component
{
    public $projectId;

    public $name = '';
    public $scope = '';
    public $due_date;
    public $storage_url = '';
    
    public function render()
    {
        return view('livewire.create-proposal-form');
    }

    public function store()
    {
        Proposal::create([
            'project_id' => $this->projectId,
            'name' => $this->name,
            'scope' => $this->scope,
            'due_date' => $this->due_date,
            'storage_url' => $this->storage_url
        ]);
        $this->dispatch('proposal-created');
        $this->modal('create-proposal')->close();
    }
}
