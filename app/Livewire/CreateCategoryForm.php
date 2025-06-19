<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CreateCategoryForm extends Component
{
    public $sort_order = '';
    public $name = '';
    
    public function render()
    {
        return view('livewire.create-category-form');
    }

    public function store()
    {
        Category::create([
            'sort_order' => $this->sort_order,
            'name' => $this->name,
        ]);
        $this->dispatch('category-created');
        $this->modal('create-category')->close();
    }
}
