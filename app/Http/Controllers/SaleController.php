<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marker;
use App\Sale;
use App\Pin;
use App\Territory;
use Auth;
class SaleController extends Controller
{

    public function makesale($id){

        $editpins = Marker::find($id);
         $goto = Territory::first();
          $territory = Territory::where('user_id', Auth::id())->get();
        return view('makesale', compact('editpins','goto','territory'));
    }
    public function submitsale($id){
       $sale= Sale::create([
        'user_name' => Auth::user()->name,
        'user_id' => Auth::id(),
        'status' => request('marker'),
        'fullname' => request('fullname'),
        'email' => request('email'),
        'phonenumber' =>request('phone'),
        'notes'=>request('notes'),
        'price'=>request('price'),
      

    ]);

    $marker = Marker::find($id);
    $marker->status = 'Sold';
    $marker->save();
    $status = request('marker');
    $icon = Pin::where('name', $status)->select('color')->first();
    $icon = $icon->color.'.png';
    $marker->icon = $icon;
    $marker->save();

     return redirect('home'); 

    }
}
