<?php

namespace App\Http\Controllers;

use App\Pin;
use Illuminate\Http\Request;

class PinController extends Controller
{
    public function pins(){
        if(Auth::user()->isAdmin()){
            return view('pins');
        }
        return back();
    }
   public function addPin() {
     $this->validate(request(), [
        'name' => 'required|string|max:255',
        'group' => 'required|string|max:255',
        'color' =>  'required|string|max:255',

    ]);
    $pin= Pin::create([
        'name' => request('name'),
        'group' => request('group'),
        'color' => request('color'),
    ]);

        return back();

   }
   public function getPin(){
        $pin = Pin::get();
        return view ('pins', compact('pin'));
    }
    public function deletePin($id)
    {
        $pin = Pin::find($id);
        $pin->delete();
        return redirect('pins');
    }
}
