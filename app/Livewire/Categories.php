<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;

class Categories extends Component
{
    public $editingId;
    public $editingName;
    public $editingSortOrder;

    public $editingCategory = false;

    #[On('category-created')]
    public function render()
    {
        return view('livewire.categories');
    }

    public function editCategory($id)
    {
        $this->editingId = $id;
        $category = Category::find($this->editingId);
        $this->editingName = $category->name;
        $this->editingSortOrder = $category->sort_order;
        $this->editingCategory = true;
    }

    public function save()
    {
        $category = Category::find($this->editingId);
        $category->update([
            'sort_order' => $this->editingSortOrder,
            'name' => $this->editingName,
        ]);
        $this->editingId = null;
        $this->editingCategory = false;
    }
}
