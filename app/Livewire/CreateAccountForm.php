<?php

namespace App\Livewire;

use App\Models\Account;
use Livewire\Component;

class CreateAccountForm extends Component
{
    public $category_id;
    public $name = '';

    public function render()
    {
        return view('livewire.create-account-form');
    }

    public function store()
    {
        Account::create([
            'category_id' => $this->category_id,
            'name' => $this->name
        ]);

        $this->dispatch('account-created');
        $this->modal('create-account')->close();
    }
}
