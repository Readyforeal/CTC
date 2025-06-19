<?php

namespace App\Livewire;

use App\Models\Contact;
use App\Models\Project;
use App\Models\Proposal;
use Livewire\Component;

class CreateEmailForm extends Component
{
    public $projectId;
    public $proposalId;

    public $project;
    public $proposal;

    public $template = '';
    public $hasAttachment = false;

    public $contacts;

    public function render()
    {
        $this->project = Project::findOrFail($this->projectId);
        $this->proposal = Proposal::findOrFail($this->proposalId);

        $bidTrackers = collect();
        if($this->template == 'initial_request') {
            $bidTrackers = $this->proposal->bidTrackers;
        } else if($this->template == 'follow_up') {
            $bidTrackers = $this->proposal->bidTrackers->where('status', '!=', 'Received');
        } else if($this->template == 'update_all'){
            $bidTrackers = $this->proposal->bidTrackers;
        } else {
            $bidTrackers = collect();
        }

        $this->contacts = $bidTrackers
            ->pluck('account')->filter()->flatMap(function ($account) {
                return $account->contacts;
            })->pluck('email')->filter()->unique()->implode(';');
            
        return view('livewire.create-email-form', ['project' => $this->project, 'proposal' => $this->proposal, 'bidTrackers' => $bidTrackers]);
    }
    
}
