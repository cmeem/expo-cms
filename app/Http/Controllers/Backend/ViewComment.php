<?php

namespace App\Http\Controllers\Backend;

use Livewire\Component;
use App\Models\Comments;

class ViewComment extends Component
{

    public $comment_id;
    public $comment_writer;
    public $comment_details;
    public $comment_status;
    protected $listeners = ['getComment'];

    public function render()
    {
        return view('backend.view-comment');
    }
    public function getComment($id){
        $getit = Comments::findOrFail($id);
        $this->comment_id = $getit->id;
        $this->comment_details = $getit->content;
        $this->comment_writer = $getit->writer;
        $this->comment_status = $getit->status;
    }
    public function change_status(){
        $this->dispatchBrowserEvent('model_dismiss');
        $this->emitUp('change_status',[$this->comment_id ,$this->comment_status]);
    }
}
