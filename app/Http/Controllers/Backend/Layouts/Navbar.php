<?php

namespace App\Http\Controllers\Backend\Layouts;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class Navbar extends Component
{
    public $navSearch;
    public $result;

    public function render()
    {
        return view('backend.layouts.navbar');
    }


    public function clear_cache(){
        Cache::clear();
        $this->dispatchBrowserEvent('swal',[
            'html' =>'<span class="d-flex align-items-center fw-bold mb-2"><i class="fas fa-check fa-2x text-green-400" style="margin-right:1rem;"></i>Cache has been cleared</span>',
        ]);
    }
    public function navSearchMethod(){
        if ($this->navSearch) {
            $this->dispatchBrowserEvent('showNavSearch');
            $this->result = Post::where('title', 'like', '%'.$this->navSearch.'%')
                                ->orWhere('admin_username', 'like', '%'.$this->navSearch.'%')
                                ->orWhere('status', 'like', '%'.$this->navSearch.'%')
                                ->orWhere('category', 'like', '%'.$this->navSearch.'%')
                                ->orWhere('content', 'like', '%'.$this->navSearch.'%')
                                ->orderBy('created_at','DESC')->take(10)->get();
        }else{
            $this->dispatchBrowserEvent('hideNavSearch');
            $this->result = null;
        }
    }

}
