<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
#[Layout('layout.app')]
class RegisterPage extends Component
{
    use WithFileUploads;
    public $username;
    public $email;
    public $password;
    public $phone;
    public $image;
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
        return view('livewire.auth.register-page');
    }
}
