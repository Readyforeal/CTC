<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;

    protected $fillable = ['account_id', 'name', 'email', 'phone_1', 'phone_2', 'preferred'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
