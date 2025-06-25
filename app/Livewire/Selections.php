<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Selections extends Component
{
    #[On('project-created')]
    public function render()
    {
        return view('livewire.selections');
    }
}
