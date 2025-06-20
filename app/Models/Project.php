<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = ['name', 'address', 'super', 'status', 'storage_url'];

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }
}
