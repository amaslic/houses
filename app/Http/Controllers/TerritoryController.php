<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Territory;

class TerritoryController extends Controller
{
   
    public function createTerritory(){
        $territory = Territory::create([
            'user_id' => request('user_id'),
            'ltdlng' => request('ltdlng'),
            'color' => request('color'),
            'description' => request('description'),
        ]);
        return back();
    }

    public function userslist(){
        if(Auth::user()->isAdmin()){
            $users = User::get();
            $territory = Territory::get();
         
           
        
            return view ('addteritory', compact('users', 'territory'));
        }else {
            return back();
        }
    }
}
