<?php

namespace App\Livewire;

use App\Models\Proposal;
use Livewire\Component;

class EditProposalForm extends Component
{
    public $proposalId;

    public $status = '';
    public $name = '';
    public $scope = '';
    public $due_date;
    public $storage_url = '';
    
    public function render()
    {
        $proposal = Proposal::find($this->proposalId);

        $this->status = $proposal->status;
        $this->name = $proposal->name;
        $this->scope = $proposal->scope;
        $this->due_date = $proposal->due_date;
        $this->storage_url = $proposal->storage_url;

        return view('livewire.edit-proposal-form');
    }

    public function update()
    {
        $proposal = Proposal::find($this->proposalId);

        $proposal->update([
            'status' => $this->status,
            'name' => $this->name,
            'scope' => $this->scope,
            'due_date' => $this->due_date,
            'storage_url' => $this->storage_url,
        ]);
        $this->dispatch('proposal-updated');
        $this->modal('edit-proposal')->close();
    }
}
