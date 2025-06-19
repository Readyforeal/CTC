<?php

namespace App\Livewire;

use App\Models\Account;
use Livewire\Component;

class EditAccountForm extends Component
{
    public $accountId;

    public $category_id;
    public $name;

    public function render()
    {
        $account = Account::find($this->accountId);
        $this->category_id = $account->category_id;
        $this->name = $account->name;
        return view('livewire.edit-account-form');
    }

    public function update()
    {
        $account = Account::find($this->accountId);
        $account->update([
            'category_id' => $this->category_id,
            'name' => $this->name,
        ]);
        $this->dispatch('account-updated');
        $this->modal('edit-account-' . $this->accountId)->close();
    }
}
