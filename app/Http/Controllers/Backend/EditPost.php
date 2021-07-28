<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditPost extends Component
{



    use WithFileUploads;
    public $post;
    public $postTitle;
    public $postContent;
    public $postCategory;
    public $postTags;
    public $postAttachments;
    public $postAttachmentsNames;
    public $oldAttachments;
    public $oldAttachmentsNames;

    protected $listeners = ['delete_attachments'];
    public function mount($post){
        $this->post = Post::findOrFail($post);
        $this->postTitle =  $this->post->title;
        $this->postContent =  $this->post->content;
        $this->postCategory =  $this->post->category;
        $this->postTags =  str_replace(['[',']','"'],'',str_replace(',',' ',$this->post->tags));
        $this->oldAttachments = json_decode($this->post->attachments);
        $this->oldAttachmentsNames = json_decode($this->post->attachments_names);
    }

    protected $rules = [
        'postTitle' => 'required',
        'postContent' => 'required',
        'postCategory' => 'required',
        'postTags' => 'nullable',
        'postAttachments' => 'nullable',
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function hydrate(){
        $this->emit('select2');
    }
    public function render()
    {
        $categories = Category::all();
        return view('backend.edit-post',['categories'=>$categories]);
    }

    public function discard(){
        redirect()->to(route('admin.posts'));
    }

    public function delete_attachments($i){
        $link = $this->oldAttachments[$i];
        $file = str_replace('/storage', '', $link);
        Storage::disk('public')->delete($file);
        array_splice($this->oldAttachments,$i,1); array_splice($this->oldAttachmentsNames,$i,1);
        if($this->oldAttachments){
            $new_attachments = json_encode($this->oldAttachments);
            $new_attachments_names = json_encode($this->oldAttachmentsNames);
        }else{
            $new_attachments = NULL;
            $new_attachments_names = NULL;
        }
        Post::where('id', $this->post->id)->update([
            'attachments_names'=>$new_attachments_names,
            'attachments' => $new_attachments,
        ]);

    }
    public function submit($status){
        $this->validate();
        $attachments = $this->postAttachments;
        if ($attachments) {
            for ($i=0; $i < sizeof($attachments); $i++) {
                $extension[$i] = $attachments[$i]->getClientOriginalExtension();
                $name[$i] = str_replace(' ','__',$attachments[$i]->getClientOriginalName());
                $fileName[$i] = str_replace('__','-',$name[$i]);
                $fileNameToStore[$i] = time() .'-'. $i .'.'.$extension[$i];
                $attachments[$i]->storeAs('public', $fileNameToStore[$i]);
                $postAttachments[$i] = '/storage/'.$fileNameToStore[$i];
            }
            $this->postAttachments = $postAttachments;
            $this->postAttachmentsNames = $fileName;
        }
        $old = $this->oldAttachments;
        $old_N = $this->oldAttachmentsNames;
        $new = $this->postAttachments;
        $new_N = $this->postAttachmentsNames;

        if ( $old && $new ) {
            $merged = array_merge($old,$new);
            $merged_n = array_merge($old_N,$new_N);
            $paths = json_encode($merged);
            $paths_names = json_encode($merged_n);
        }elseif($new){
            $paths = json_encode($new);
            $paths_names = json_encode($new_N);
        }elseif($old){
            $paths = json_encode($old);
            $paths_names = json_encode($old_N);
        }else{
            $paths = NULL;
            $paths_names = NULL;
        }
        $tags = $this->postTags;
        if($tags){
            $tags=explode(' ',$tags);
            $tags = json_encode($tags);
        }else{
            $tags=NULL;
        }
        Post::where('id', $this->post->id)->update([
            'status' =>$status,
            'title'=>$this->postTitle,
            'category'=>$this->postCategory,
            'content' => $this->postContent,
            'tags' => $tags,
            'attachments_names'=>$paths_names,
            'attachments' => $paths,
            'deleted_at' =>NULL,
        ]);
        $this->dispatchBrowserEvent('swal',[
            'html' =>'<span class="d-flex align-items-center fw-bold text-gray-800 mb-2"><i class="fas fa-check fa-2x text-green-500" style="margin-right:1rem;"></i>Your post '. $this->postTitle .' has been Updated !!</span>',
        ]);
        $this->emit('swal_success');
    }
}
