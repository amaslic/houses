<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marker;
use App\Pin;

use Auth;

class MarkerController extends Controller
{

    public function addmarker(){
    //      $this->validate(request(), [
    //     // 'user_id' => 'required|max:255',
    //     'latlng' => 'required',
    //     'status' =>  'required|max:255',

    // ]);
    $marker= Marker::create([
        'user_id' => Auth::id(),
        'latlng' => request('latlng'),
        'status' => request('marker'),
        'fullname' => request('fullname'),
        'email' => request('email'),
        'phonenumber' =>request('phone'),
        'notes'=>request('notes'),
      

    ]);
        return back();
        

    }
    public function editpin( $id){
        $editpins = Marker::find($id);
        $pins = Pin::get();
        return view('editpin',compact('editpins','pins'));

    }
    public function editmarker( $id){
        $marker = Marker::find($id);
        $marker->status = request('marker');
        $marker->fullname = request('fullname');
         $marker->email = request('email');
          $marker->phonenumber = request('phone');
           $marker->notes = request('notes');
           $marker->save();

           return redirect('home');
    }
}
