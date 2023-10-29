<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
#[Layout('layout.admin-layout')]

class EditUserProfile extends Component
{
    use WithFileUploads;
    public $user;
    public $username;
    public $email;
    public $phone;
    public $image;
    public $imagePath;

    public function mount($id)
    {
        $this->user = User::findOrFail($id);
        $this->email = $this->user->email;
        $this->username = $this->user->username;
        $this->phone = $this->user->phone;
        $this->imagePath = $this->user->image;
        
        
    }
    public function edit(){
        $data = $this->validate([
            'username'=> ['required','string','min:3','max:50'],
            'email'=> ['required','email'],
            'phone'=> ['required','numeric'],
            // 'image'=> ['image','mimes:jpg,jpeg,png'],
            
        ]);
        if($this->image){
            Storage::delete($this->user->image);
            $data['image'] = $this->image->store('uploads','public');
        }
            // 1 true                                  1 false
            // 1 true                                  2 true
            // 2 false                                 1 false
            // 2 false                                 2 true
        // if(Auth::user()->id == 1 || $this->user != 1){
            
            // }
                $this->user->update($data);
        
        return redirect(route('allUsers'))->with('success',"Account updated successfully");

    }
    
    public function render()
    {
        return view('livewire.admin.edit-user-profile');
    }
}
