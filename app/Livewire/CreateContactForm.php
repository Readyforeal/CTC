<?php

namespace App\Livewire;

use App\Models\Account;
use App\Models\Contact;
use Livewire\Component;

class CreateContactForm extends Component
{
    public $accountId;

    public $name = '';
    public $email = '';
    public $phone_1 = '';
    public $phone_2 = '';
    public $preferred = '';

    public function render()
    {
        return view('livewire.create-contact-form');
    }

    public function clear()
    {
        $this->name = '';
        $this->email = '';
        $this->phone_1 = '';
        $this->phone_2 = '';
        $this->preferred = '';
    }

    public function store()
    {
        Contact::create([
            'account_id' => $this->accountId,
            'name' => $this->name,
            'email' => $this->email,
            'phone_1' => $this->phone_1,
            'phone_2' => $this->phone_2,
            'preferred' => $this->preferred
        ]);
        $this->dispatch('contact-created');
        $this->modal('create-contact-' . $this->accountId)->close();
    }
}
