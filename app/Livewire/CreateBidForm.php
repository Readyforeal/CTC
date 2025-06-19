<?php

namespace App\Livewire;

use Illuminate\Support\Str;
use App\Models\BidTracker;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateBidForm extends Component
{
    use WithFileUploads;

    public $bidTrackerId;

    public $details = '';
    public $reviewed = false;
    public $printed = false;
    public $amount = 0;
    #[Validate('file|max:4096')]
    public $file;
    public $storage_url = '';

    public function render()
    {
        return view('livewire.create-bid-form');
    }

    public function clear()
    {
        $this->details = '';
        $this->reviewed = false;
        $this->printed = false;
        $this->amount = 0;
        $this->file = null;
        $this->storage_url = '';
    }

    public function store()
    {
        $bidTracker = BidTracker::find($this->bidTrackerId);
        $bid = $bidTracker->bids()->create([
            'project_id' => $bidTracker->proposal->project->id,
            'proposal_id' => $bidTracker->proposal->id,
            'account_id' => $bidTracker->account_id,
            'category_id' => $bidTracker->category_id,
            'details' => $this->details,
            'reviewed' => $this->reviewed,
            'printed' => $this->printed,
            'amount' => $this->amount,
            'storage_url' => $this->storage_url,
        ]);

        if($this->file)
        {
            $cleanName = 'Estimate from ' . $bidTracker->account->name . '-' . $bidTracker->proposal->project->name;
            $timestamp = now()->format('Ymd_His');
            $filename = $timestamp . '-' . Str::slug($cleanName) . '.pdf';

            $filePath = $this->file->storeAs(path: 'bids', name: $filename);
            $bid->local_storage_url = $filePath;
            $bid->save();
        }

        $bidTracker->status = "Received";
        $bidTracker->save();

        $this->dispatch('bid-created');
        $this->modal('create-bid-' . $bidTracker->id)->close();
    }
}
