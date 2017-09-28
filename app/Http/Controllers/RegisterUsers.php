<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;;
class RegisterUsers extends Controller
{
    public function registers(){
        if(Auth::user()->isAdmin()){
            return view('auth.registers');
        }
        return back();
    }
   public function register() {
     $this->validate(request(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'phone_number' => 'required',
        'sex' => 'required',
        'role' => 'required',

    ]);
    $user= User::create([
        'name' => request('name'),
        'email' => request('email'),
        'phone_number' => request('phone_number'),
        'password' => bcrypt(request('password')),
        'sex' => request('sex'),
        'role' => request('role'),
    ]);

        return back();

   }
}
