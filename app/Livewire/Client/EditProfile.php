<?php

namespace App\Livewire\Client;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('layout.clint-layout')]
class EditProfile extends Component
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
        $this->user = Auth::user();
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
        $this->user->update($data);
        return redirect(route('clientProfile',$this->user->id))->with('success',"Account updated successfully");

    }
    public function delete(){
        $this->user->delete();
        return redirect(route("login"));
    }
    public function render()
    {
        return view('livewire.client.edit-profile');
    }
}
