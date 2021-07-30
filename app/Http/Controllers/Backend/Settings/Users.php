<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $pages = 15;
    protected $listeners = ['delete_user'];

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('backend.settings.users',[
            'users' => User::where(function($query) {
                      $query->where('name', 'like', '%'.$this->search.'%')
                            ->orWhere('email', 'like', '%'.$this->search.'%')
                            ->orWhere('status', 'like', '%'.$this->search.'%');
                            })
                            ->orderBy('created_at','desc')->paginate($this->pages)
        ]);

    }
    public function change_status($id){
        $user = User::findOrFail($id);
        if($user->status == 'active'){
            $user->update(['status'=>'inactive']);
            $this->dispatchBrowserEvent('swal',[
                'html' =>'<span class="d-flex align-items-center  fw-bold text-gray-800 mb-2"><i class="fas fa-check fa-2x text-green-500" style="margin-right:1rem;"></i>User has been deactivated</span>',
            ]);
        }elseif($user->status == 'inactive'){
            $user->update(['status'=>'active']);
            $this->dispatchBrowserEvent('swal',[
                'html' =>'<span class="d-flex align-items-center  fw-bold text-gray-800 mb-2"><i class="fas fa-check fa-2x text-green-500" style="margin-right:1rem;"></i>User has been activated</span>',
            ]);
        }else{
            $this->dispatchBrowserEvent('swal',[
                'html' =>'<span class="d-flex align-items-center fw-bold text-gray-800 mb-2"><i class="fas fa-times fa-2x text-red-500" style="margin-right:1rem;"></i>You don\'t have permission to change this user status</span>',
            ]);
        }

    }
    public function delete_user($id){
        $user = User::findOrFail($id);
        if($user){
            $user->delete();
            $this->dispatchBrowserEvent('swal',[
                'html' =>'<span class="d-flex align-items-center nowrap fw-bold text-gray-800 mb-2"><i class="fas fa-check fa-2x text-green-500" style="margin-right:1rem;"></i>User has been deleted !!</span>',
            ]);
        }else{
            $this->dispatchBrowserEvent('swal',[
                'html' =>'<span class="d-flex align-items-center fw-bold text-gray-800 mb-2"><i class="fas fa-times fa-2x text-red-500" style="margin-right:1rem;"></i>You don\'t have permission to delete this User</span>',
            ]);
        }
    }
}
