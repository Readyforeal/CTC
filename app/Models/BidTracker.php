<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidTracker extends Model
{
    /** @use HasFactory<\Database\Factories\BidTrackerFactory> */
    use HasFactory;

    protected $fillable = ['project_id', 'proposal_id', 'category_id', 'account_id', 'followed_up', 'notes', 'status'];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
}
