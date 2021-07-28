<?php

namespace App\Http\Controllers\Backend;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $pages = 20;
    protected $listeners = ['delete_category','updatingSearch'];
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('backend.categories',[
            'categories'=>Category::where(function($query) {
                                        $query->where('name', 'like', '%'.$this->search.'%')
                                            ->orWhere('details', 'like', '%'.$this->search.'%');
                                    })
                                    ->orderBy('created_at','desc')->paginate($this->pages)
        ]);
    }
    public function delete_category($id){
        if(true){
            Category::where('id',$id)->delete();
            $this->dispatchBrowserEvent('swal',[
                'html' =>'<span class="d-flex align-items-center nowrap fw-bold text-gray-800 mb-2"><i class="fas fa-check fa-2x text-green-500" style="margin-right:1rem;"></i>Post has been deleted !!</span>',
            ]);
        }else{
            $this->dispatchBrowserEvent('swal',[
                'html' =>'<span class="d-flex align-items-center fw-bold text-gray-800 mb-2"><i class="fas fa-times fa-2x text-red-500" style="margin-right:1rem;"></i>You don\'t have permission to delete this Category</span>',
            ]);
        }
    }
}
