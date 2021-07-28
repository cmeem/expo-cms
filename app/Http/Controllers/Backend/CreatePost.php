<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;
    public $postTitle;
    public $postContent;
    public $postCategory;
    public $postTags;
    public $postAttachments;
    public $postAttachmentsNames;

    protected $rules = [
        'postTitle' => 'required|unique:posts,title|max:100',
        'postContent' => 'required',
        'postCategory' => 'required',
        'postTags' => 'nullable',
        'postAttachments' => 'nullable',
        'postAttachmentsNames' => 'nullable',
    ];

    public function hydrate(){
        $this->emit('select2');
    }
    public function render()
    {
        $categories = Category::all();
        return view('backend.create-post',['categories'=>$categories]);
    }
    public function discard(){
        $this->postTitle = '';
        $this->postContent = '';
        $this->postCategory = '';
        $this->postTags = '';
        $this->postAttachments = '';
        $this->postAttachmentsNames = '';
        $this->resetErrorBag();
        redirect()->to(route('admin.dashboard'));
    }

    public function submit($status){
        $this->validate();
        $attachments = $this->postAttachments;
        if ($attachments) {
            for ($i=0; $i < sizeof($attachments); $i++) {
                $extension[$i] = $attachments[$i]->getClientOriginalExtension();
                $name[$i] = str_replace(' ','__',$attachments[$i]->getClientOriginalName());
                $fileName[$i] = str_replace('__','-',$name[$i]);
                $fileNameToStore[$i] = time().'-'. $i .'.'.$extension[$i];
                $attachments[$i]->storeAs('public', $fileNameToStore[$i]);
                $postAttachments[$i] = '/storage/'.$fileNameToStore[$i];
            }
            $this->postAttachments = $postAttachments;
            $this->postAttachmentsNames = $fileName;
        }
        if ($this->postAttachments) {
            $paths = json_encode($this->postAttachments);
            $paths_names = json_encode($this->postAttachmentsNames);
        }else{
            $paths_names = NULL;
            $paths = NULL;
        }
        $tags = $this->postTags;
        if($tags){
            $tags=explode(' ',$tags);
            $tags = json_encode($tags);
        }else{
            $tags=NULL;
        }
        Post::create([
            'status' =>$status,
            'admin_id'=>auth()->user()->id,
            'admin_username'=>auth()->user()->username,
            'title'=>$this->postTitle,
            'category'=>$this->postCategory,
            'content' => $this->postContent,
            'tags' => $tags,
            'attachments_names' => $paths_names,
            'attachments' => $paths,
        ]);
        $this->dispatchBrowserEvent('swal',[
            'html' =>'<span class="d-flex align-items-center fw-bold text-gray-800 mb-2"><i class="fas fa-check fa-2x text-green-500" style="margin-right:1rem;"></i>Your post has been '. $status .'ed.</span>',
        ]);
        $this->emit('swal_success');
    }

}
