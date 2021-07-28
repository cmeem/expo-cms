<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post;
use Livewire\Component;

class ViewPost extends Component
{
    public $post;
    public function mount(Post $post){
        $this->post = $post;
    }
    public function render()
    {
        return view('backend.view-post',['post']);
    }
}
