<?php

namespace App\Livewire;

use App\Models\Bid;
use App\Models\BidTracker;
use Livewire\Component;

class BidView extends Component
{
    public $bidId;

    public function render()
    {
        $bid = Bid::find($this->bidId);

        if(!$bid) {
            return '<div></div>';
        }

        return view('livewire.bid-view', ['bid' => $bid]);
    }

    public function delete()
    {
        $bid = Bid::find($this->bidId);
        $bidTracker = BidTracker::find($bid->bidTracker->id);
        $this->modal('view-bid-' . $this->bidId)->close();
        $this->dispatch('bid-deleted');
        $bid->delete();

        if($bidTracker->bids->count() == 0)
        {
            $bidTracker->status = "In progress";
            $bidTracker->save();
        }
    }
}
