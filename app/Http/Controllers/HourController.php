<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\Hour;

class HourController extends Controller
{
    //
    public function startTime() {

        $now = Carbon::now()->toDateString();
        $hour = Hour::where('date',$now)->where('user_id',Auth::id())->first();
       
        if($hour){
          
            $hour->active=1;
            $hour->created_at = Carbon::now();
            $hour->save();
            return back();
        }else{
         $hour = Hour::create([
                'user_id' => Auth::id(),
                'date' => Carbon::now()->toDateTimeString(),
                'total_time' => 0,
                'stoptime' => Carbon::now(),
                'active'    => 1,
            ]);
            return back();
        }
    } 
    
    public function stopTime(){
        $now = Carbon::now()->toDateString();
        
                $hour = Hour::where('date',$now)->where('user_id',Auth::id())->first();
        
                $stoptime = Carbon::now();
        
                $starttime = $hour->created_at;
        
                $workhours = $stoptime->diffInMinutes($starttime);
                $workhours = $workhours + $hour->total_time;
                // $hours = $workhours /60;
                // $hours = number_format($hours,0);
                // $minutes = $workhours % 60;
        
                $hour->stoptime = $stoptime;
                $hour->total_time= $workhours ;
                $hour->active=0;

                $hour->save();
                return back();
            }
}


