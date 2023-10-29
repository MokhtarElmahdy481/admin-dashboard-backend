<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
#[Layout('layout.admin-layout')]
class AllUsers extends Component
{
    use WithPagination;
    public $search;
    public $searchBy = "username";
    public $username;
    public $email;
    public $password;
    public $phone;
    public $image;
    public function setSearchBy($val){
        $this->searchBy = $val;
    }
    public function delete($id){
        if($id == 1){
        return redirect(route('allUsers'))->with('error',"Account Adminstrator can not be deleted");
        }
        $user = User::findOrFail($id);
        $user->delete();
        return redirect(route('allUsers'))->with('success',"Account deleted successfully");
    }
    
    public function showPermissions(){
        dd(Auth::user()->role->permisions->contains('title','List'));
    }
    public function store(){
        $data = $this->validate([
            'username'=> ['required','string','min:3','max:50'],
            'email'=> ['required','email','unique:users,email'],
            'password'=> ['required','string','min:3','max:50'],
            'phone'=> ['required','numeric','unique:users,phone'],
            'image'=> ['nullable','image','mimes:jpg,jpeg,png'],
        ]);
        if($this->image){
            $data['image'] = $this->image->store('uploads','public');
        }
        User::create($data);

        $this->reset('username','email','password','phone','image');
        session()->flash("success","Account Created Successfully");
        return redirect(route("login"));
    }
    public function render()
    {
        $users = User::latest()->where($this->searchBy,"like","%{$this->search}%")->paginate(5);
        
        return view('livewire.admin.all-users',compact("users"));
    }
}
