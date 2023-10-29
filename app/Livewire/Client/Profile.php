<?php

namespace App\Livewire\Client;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layout.clint-layout')]
class Profile extends Component
{
    public function showAuth(){
        dump(Auth::user());
    }
    public function render()
    {
        $user = Auth::user();
        return view('livewire.client.profile',compact("user"));
    }
}
