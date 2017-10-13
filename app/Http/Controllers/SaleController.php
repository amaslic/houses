<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marker;
use App\Sale;
use Auth;
class SaleController extends Controller
{

    public function makesale($id){

        $editpins = Marker::find($id);
        return view('makesale', compact('editpins'));
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

        return redirect('home'); 

    }
}
