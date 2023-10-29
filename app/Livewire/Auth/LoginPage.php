<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('layout.app')]
class LoginPage extends Component
{
    public $loginWith = 'email';
    public $email;
    public $password;
    public $phone;
    public function toggleLoginWith($val){
        $this->loginWith = $val;
    }
    public function loginWithEmail()
    {
        $data = $this->validate([
            'email'=> ['required','email'],
            'password'=> ['required','string','min:3','max:50'],
        ]);
        $is_logged = Auth::attempt($data);
        if($is_logged){
            return redirect(url('/redirect'));
        }else{
            return redirect(url('/login'));
        }
    }
    public function loginWithPhone()
    {
        $data = $this->validate([
            'phone'=> ['required','numeric'],
            'password'=> ['required','string','min:3','max:50'],
        ]);
        $is_logged = Auth::attempt($data);
        if($is_logged){
            return redirect(url('/redirect'));
        }else{
            return redirect(url('/login'));
        }
    }
    public function render()
    {
        return view('livewire.auth.login-page');
    }
}
