<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Archive extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $writer;
    public $pages = 15;
    protected $listeners = ['edit_post','delete_post'];

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('backend.archive',[
            'posts' => Post::where(function($query) {
                                $date = Carbon::today()->subYears(1);
                                $query->where('deleted_at','!=', NULL)
                                      ->orwhereDate('created_at', '<=', $date);
                            })
                            ->where(function($query) {
                                $query->where('title', 'like', '%'.$this->search.'%')
                                    ->orWhere('admin_username', 'like', '%'.$this->search.'%')
                                    ->orWhere('status', 'like', '%'.$this->search.'%')
                                    ->orWhere('category', 'like', '%'.$this->search.'%')
                                    ->orWhere('content', 'like', '%'.$this->search.'%');
                            })
                            ->orderBy('created_at','desc')->paginate($this->pages)]);

    }
    public function edit_post($id){
        if(true){
            redirect()->to(route('admin.posts.edit',$id));
        }else{
            $this->dispatchBrowserEvent('swal',[
                'html' =>'<span class="d-flex align-items-center  fw-bold text-gray-800 mb-2"><i class="fas fa-times fa-2x text-red-500" style="margin-right:1rem;"></i>You don\'t have permission to edit this post</span>',
            ]);
        }
    }
    public function delete_post($id){
        $post = Post::find($id);
        if($post){
            $post->delete();
            $this->dispatchBrowserEvent('swal',[
                'html' =>'<span class="d-flex align-items-center nowrap fw-bold text-gray-800 mb-2"><i class="fas fa-check fa-2x text-green-500" style="margin-right:1rem;"></i>Post has been deleted !!</span>',
            ]);
        }else{
            $this->dispatchBrowserEvent('swal',[
                'html' =>'<span class="d-flex align-items-center fw-bold text-gray-800 mb-2"><i class="fas fa-times fa-2x text-red-500" style="margin-right:1rem;"></i>You don\'t have permission to delete this post</span>',
            ]);
        }
    }
}
