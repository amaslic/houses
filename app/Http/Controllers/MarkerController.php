<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marker;
use App\Pin;

use Auth;

class MarkerController extends Controller
{

    public function addmarker(){
   
   $status = request('marker');
   $icon = Pin::where('name', $status)->select('color')->first();
   $icon = $icon->color.'.png';
    $marker= Marker::create([
        'user_id' => Auth::id(),
        'latlng' => request('latlng'),
        'status' => request('marker'),
        'fullname' => request('fullname'),
        'email' => request('email'),
        'phonenumber' =>request('phone'),
        'notes'=>request('notes'),
        'icon'=>$icon,
      

    ]);
        return back();
        

    }
    public function editpin( $id){
        $editpins = Marker::find($id);
        $pins = Pin::get();
        return view('editpin',compact('editpins','pins'));

    }
    public function editmarker( $id){
        $status = request('marker');
        $icon = Pin::where('name', $status)->select('color')->first();
        $icon = $icon->color.'.png';
        $marker = Marker::find($id);
        $marker->status = request('marker');
        $marker->fullname = request('fullname');
        $marker->email = request('email');
        $marker->phonenumber = request('phone');
        $marker->notes = request('notes');
        $marker->icon = $icon;
        $marker->save();

        return redirect('home');
    }
    public function deletemarker($id){
        $marker = Marker::find($id);
        $marker->delete();
        return redirect('home');
    }
}
