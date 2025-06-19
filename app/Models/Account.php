<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    /** @use HasFactory<\Database\Factories\AccountFactory> */
    use HasFactory;

    protected $fillable = ['category_id', 'name'];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function bidTrackers()
    {
        return $this->hasMany(BidTracker::class);
    }
}
