<?php

namespace App\Livewire;

use App\Models\Account;
use App\Models\Contact;
use Livewire\Attributes\On;
use Livewire\Component;

class Accounts extends Component
{
    public $accounts;
    public $accountsWithoutContacts;

    #[On('account-created')]
    #[On('account-updated')]
    #[On('account-deleted')]
    #[On('contact-created')]
    #[On('contact-deleted')]
    public function render()
    {
        $this->accounts = Account::all()->sortBy('category_id');
        $this->accountsWithoutContacts = Account::doesntHave('contacts')->get();
        return view('livewire.accounts');
    }

    public function deleteContact($contactId)
    {
        Contact::findOrFail($contactId)->delete();
        $this->dispatch('contact-deleted');
    }
}
