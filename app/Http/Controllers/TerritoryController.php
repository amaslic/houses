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
            'active' => request('active'),
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
            $users = User::get();
            
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

    public function activeTerritory(){
        if(Auth::user()->isAdmin()){
      
            $territory = Territory::where('active', '1')->get();
            $locations = Marker::get();

            return view ('viewmap', compact('territory', 'locations'));
        }else {
            return back();
        }
    }

    public function deactivateTerritory($id){
        if(Auth::user()->isAdmin()){
      
            $territory = Territory::find($id);
            $territory->active = 0;
            $territory->save();

            return back();
            
        }else {
            return back();
        }
    }

    public function activateTerritory($id){
        if(Auth::user()->isAdmin()){
      
            $territory = Territory::find($id);
            $territory->active = 1;
            $territory->save();

            return back();
            
        }else {
            return back();
        }
    }

    
}
