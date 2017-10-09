<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marker;

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
        'status' => request('marker')
      

    ]);
        return back();
        

    }
}
