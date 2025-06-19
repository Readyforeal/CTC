<?php

namespace App\Livewire;

use App\Models\BidTracker;
use App\Models\Category;
use Illuminate\Support\Collection as Collection;
use Livewire\Component;

class CreateBidTrackerForm extends Component
{
    public $projectId;
    public $proposalId;

    public $category_id = '';
    public $account_id = '';

    public function render()
    {
        return view('livewire.create-bid-tracker-form');
    }

    public function store()
    {
        BidTracker::create([
            'project_id' => $this->projectId,
            'proposal_id' => $this->proposalId,
            'category_id' => $this->category_id,
            'account_id' => $this->account_id,
        ]);
        $this->dispatch('bid-tracker-created');
        $this->modal('create-tracker')->close();
    }

}
