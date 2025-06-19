<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    /** @use HasFactory<\Database\Factories\BidFactory> */
    use HasFactory;

    protected $fillable = ['project_id', 'proposal_id', 'account_id', 'category_id', 'details', 'reviewed', 'printed', 'amount', 'storage_url'];

    public function bidTracker()
    {
        return $this->belongsTo(BidTracker::class);
    }
}
