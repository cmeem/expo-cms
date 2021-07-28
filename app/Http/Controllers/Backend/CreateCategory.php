<?php

namespace App\Http\Controllers\Backend;

use Livewire\Component;
use App\Models\Category;

class CreateCategory extends Component
{

    public $category_name;
    public $category_details;
    protected $rules = [
        'category_name' => 'required|unique:categories,name|max:50',
        'category_details' => 'nullable',
    ];
    public function render()
    {
        return view('backend.create-category');
    }
    public function create_category(){
        $this->validate();
        Category::create([
            'name' =>$this->category_name,
            'details' =>$this->category_details
        ]);
        $this->dispatchBrowserEvent('CategorySuccess');
        $this->dispatchBrowserEvent('swal',[
            'html' =>'<span class="d-flex align-items-center nowrap fw-bold text-gray-800 mb-2"><i class="fas fa-check fa-2x text-green-500" style="margin-right:1rem;"></i>
            Category '. $this->category_name .' has been created !!</span>',
        ]);

    }
}
