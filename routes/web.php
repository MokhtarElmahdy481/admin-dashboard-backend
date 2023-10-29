<?php

use App\Livewire\Admin\AllUsers;
use App\Livewire\Admin\EditUserProfile;
use App\Livewire\Admin\Permisions;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Client\EditProfile;
use App\Livewire\Client\Profile;
use App\Livewire\Role;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/redirect', function () {
    if(Auth::user()->role_id == 1){
        return redirect(route("allUsers"));
    }else{
        if(! Auth::user()->id ){
            return redirect(url('/'));
        }
        return redirect(route("clientProfile",Auth::user()->id));

    }
});


Route::get('/lang/{language}', function ($language) {
    if (in_array($language, ['en', 'ar'])) {
        session(['locale' => $language]);
    }
    return redirect()->back();
});

Route::middleware('guest')->group(function(){

    Route::get('/register', RegisterPage::class)->name("register");
    Route::get('/login', LoginPage::class)->name("login");
});
Route::get('/logout', function () {
    Auth::logout();
    return redirect(route('login'));
})->name("logout")->middleware("auth");


// Admin
Route::group(["prefix"=>"admin","middleware"=>['auth','is_admin']],function(){
    Route::get('/users', AllUsers::class)->name("allUsers");
    Route::get('/edit/{id}', EditUserProfile::class)->name("editUserProfile")->middleware('permission:Edit');
    Route::get("/roles", Role::class)->name("allRoles")->middleware('permission:List');
    Route::get("/permissions", Permisions::class)->name("allpermissions");
});
Route::group(["prefix"=>"client","middleware"=>'auth'],function(){
    Route::get('/{id}', Profile::class)->name("clientProfile");
    Route::get('/edit/{id}', EditProfile::class)->name("editClientProfile");

});
