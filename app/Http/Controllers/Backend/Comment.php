<?php

namespace App\Http\Controllers\Backend;

use App\Models\Comments;
use Livewire\Component;
use Livewire\WithPagination;

class Comment extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $status = '';
    public $pages = 30;
    protected $listeners = ['delete_comment','change_status'];

    public function render()
    {
        return view('backend.comment',[
            'comments' => Comments::where('status', 'like', '%'.$this->status.'%')
                                ->where(function($query) {
                                    $query->where('status', 'like', '%'.$this->search.'%')
                                    ->orWhere('writer', 'like', '%'.$this->search.'%')
                                    ->orWhere('content', 'like', '%'.$this->search.'%')
                                    ->orWhere('attachments', 'like', '%'.$this->search.'%');
                                })
                                ->orderBy('created_at','desc')->paginate($this->pages)
        ]);

    }
    public function change_status($comment){
            if($comment[1] == 'Approved' or $comment[1] == 'Deleted'){
                $new_status = 'Pending';
             }else{
                 $new_status = 'Approved';
             }
            $Comment = Comments::findOrFail($comment[0]);
            if($Comment){
                $Comment->update(['status'=>$new_status]);
                $this->dispatchBrowserEvent('swal',[
                    'html' =>'<span class="d-flex align-items-center fw-bold text-gray-800 mb-2"><i class="fas fa-check fa-2x text-green-500" style="margin-right:1rem;"></i>Comment has been Updated to '. $new_status .' !!</span>',
                ]);
            }else{
                $this->dispatchBrowserEvent('swal',[
                    'html' =>'<span class="d-flex align-items-center fw-bold text-gray-800 mb-2"><i class="fas fa-times fa-2x text-red-500" style="margin-right:1rem;"></i>You don\'t have permission to update this comment</span>',
                ]);
            }
    }
    public function delete_comment($id){
            $comment = Comments::findOrFail($id);
            if($comment && $comment->status != 'Deleted'){
                $comment->update(['status'=>'Deleted']);
                $this->dispatchBrowserEvent('swal',[
                    'html' =>'<span class="d-flex align-items-center fw-bold text-gray-800 mb-2"><i class="fas fa-check fa-2x text-green-500" style="margin-right:1rem;"></i>Comment has been Deleted !!</span>',
                ]);
            }else{
                $this->dispatchBrowserEvent('swal',[
                    'html' =>'<span class="d-flex align-items-center fw-bold text-gray-800 mb-2"><i class="fas fa-times fa-2x text-red-500" style="margin-right:1rem;"></i>You don\'t have permission to delete this comment</span>',
                ]);
            }
    }
    public function restore_comment($id){
        $comment = Comments::findOrFail($id);
        if($comment && $comment->status == 'Deleted'){
            $comment->update(['status'=>'Pending']);
            $this->dispatchBrowserEvent('swal',[
                'html' =>'<span class="d-flex align-items-center fw-bold text-gray-800 mb-2"><i class="fas fa-check fa-2x text-green-500" style="margin-right:1rem;"></i>Comment has been Restored !!</span>',
        ]);
        }else{
            $this->dispatchBrowserEvent('swal',[
                'html' =>'<span class="d-flex align-items-center fw-bold text-gray-800 mb-2"><i class="fas fa-times fa-2x text-red-500" style="margin-right:1rem;"></i>You don\'t have permission to delete this comment</span>',
            ]);
        }
    }
}
