<?php

namespace App\Http\Controllers\Backend;

use Livewire\Component;
use App\Models\Category;

class EditCategory extends Component
{
    public $new_category_id;
    public $new_category_name;
    public $new_category_details;
    protected $listeners = ['getOldCategory'];
    function rules() {
        return [
            'new_category_name' => 'required|max:50|unique:categories,name,'.$this->new_category_id,
            'new_category_details' => 'nullable',
        ];
    }
    public function render()
    {
        return view('backend.edit-category');
    }
    public function getOldCategory($id){
        $new= Category::find($id);
        $this->new_category_id = $new->id;
        $this->new_category_name = $new->name;
        $this->new_category_details = $new->details;
    }
    public function edit_category(){
        $this->validate();
        Category::where('id',$this->new_category_id)->update([
            'name' =>$this->new_category_name,
            'details' =>$this->new_category_details
        ]);
        $this->dispatchBrowserEvent('CategorySuccess');
        $this->dispatchBrowserEvent('swal',[
            'html' =>'<span class="d-flex align-items-center nowrap fw-bold text-gray-800 mb-2"><i class="fas fa-check fa-2x text-green-500" style="margin-right:1rem;"></i>
            Category '. $this->new_category_name .' has been updated !!</span>',
        ]);

    }
}
