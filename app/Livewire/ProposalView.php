<?php

namespace App\Livewire;

use App\Models\Bid;
use App\Models\BidTracker;
use App\Models\Project;
use App\Models\Proposal;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class ProposalView extends Component
{
    #[Url('projectId')]
    public $projectId;
    #[Url('proposalId')]
    public $proposalId;

    public $editingId = null;
    public $editingValue = '';
    public $editingField = '';

    public $editingStatus = false;
    public $editingNotes = false;
    public $editingFollowedUpDate = false;

    #[On('bid-tracker-created')]
    #[On('proposal-updated')]
    #[On('bid-created')]
    #[On('bid-deleted')]
    public function render()
    {
        return view('livewire.proposal-view', [
            'project' => Project::findOrFail($this->projectId),
            'proposal' => Proposal::findOrFail($this->proposalId)
        ]);
    }

    public function editDueDate($id)
    {
        $this->editingId = $id;

        $this->editingFollowedUpDate = true;
        $this->editingNotes = false;
        $this->editingStatus = false;

        $this->editingValue = BidTracker::find($id)->followed_up;
    }

    public function editNotes($id, $field)
    {
        $this->editingId = $id;

        $this->editingNotes = true;
        $this->editingStatus = false;
        $this->editingFollowedUpDate = false;

        $this->editingField = $field;
        $this->editingValue = BidTracker::find($id)->{$field};
    }

    public function editStatus($id)
    {
        $this->editingId = $id;

        $this->editingNotes = false;
        $this->editingStatus = true;
        $this->editingFollowedUpDate = false;
    }

    public function save()
    {
        $bidTracker = BidTracker::find($this->editingId);
        $bidTracker->{$this->editingField} = $this->editingValue;
        $bidTracker->save();
        $this->dispatch('updated-bid-tracker');
        $this->editingId = null;
        $this->editingField = '';
        $this->editingValue = '';
    }

    public function saveStatus($status)
    {
        $bidTracker = BidTracker::find($this->editingId);
        $bidTracker->status = $status;
        $bidTracker->save();
        // $this->dispatch('updated-bid-tracker-status');
        $this->editingStatus = false;
        $this->editingId = null;
    }

    public function saveDueDate()
    {
        $bidTracker = BidTracker::find($this->editingId);
        $bidTracker->followed_up = $this->editingValue;
        $bidTracker->save();
        $this->dispatch('updated-bid-tracker-due-date');
        $this->editingId = null;
        $this->editingValue = '';
    }
}
