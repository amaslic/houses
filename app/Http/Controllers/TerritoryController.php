<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Territory;
use App\Marker;

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
            
           
            $territory = Territory::get();
            $users = User::where('id', 'user_id')->get();
            
            return view ('addteritory', compact('users', 'territory'));
        }else {
            return back();
        }
    }

    public function territoryByUser($id){
        if(Auth::user()->isAdmin()){
            $users = User::find($id);
            $territory = Territory::where('user_id', $id)->get();
            $locations = Marker::where('user_id', $id)->get();

            return view ('viewusermap', compact('users', 'territory', 'locations'));
        }else {
            return back();
        }
    }
}
