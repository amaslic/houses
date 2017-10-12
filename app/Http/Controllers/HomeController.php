<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Marker;
use App\Pin;
use App\Sale;
use Carbon\Carbon;
use Log;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
           if(Auth::user()->isAdmin()){
                $todaysales = Sale::where('created_at', '>=', Carbon::now()->subDay())->get();
                $todaysalescount = $todaysales->count();
                $todaysalessum=$todaysales->sum('price');
               $lastweeksales = Sale::where('created_at', '>=', Carbon::now()->subDay(7))->get();
               $lastweeksalescount= $lastweeksales->count();
                $lastweeksalessum=$lastweeksales->sum('price');

               $lastmonthsales = Sale::where('created_at', '>=', Carbon::now()->subMonth())->get();
               $lastmonthsalescount = $lastmonthsales->count();
               $lastmonthsalessum = $lastmonthsales->sum('price');
               
               $lastyearsales = Sale::where('created_at', '>=', Carbon::now()->subYear())->get();
               $lastyearsalescount = $lastyearsales->count();
               $lastyearsalessum = $lastyearsales->sum('price');
               $totalsales = Sale::get();
               $totalsalescount=$totalsales->count();
               $totalsalessum = $totalsales->sum('price');
            
            //    return view('dashboard',compact('todaysales','lastweeksales','lastmonthsales','lastyearsales','totalsales'));
        // $todaysalesuser = Sale::select('user_name')->distinct()->get();
        //  $todaysalesuser2 = Sale::select('user_id')->count();

       
       
           
         return view('dashboard',compact('todaysalescount','lastweeksalescount','lastweeksalessum','lastmonthsalescount'
         ,'lastmonthsalessum','lastyearsalescount','lastyearsalessum','todaysalessum','totalsalescount',
        'totalsalessum'));
        }
               else{
                     $locations = Marker::where('user_id', Auth::id())->get();
                    $pins = Pin::get();
                   
                    return view('home', compact('locations','pins'));
               
               }
           
        }
        else{
            return back();
        }
           
    }
    public function logout(){
       Auth::logout();
       return view('auth.login');
       
    }

    public function userlist(){
    if(Auth::user()->isAdmin()){
        $users = User::get();
        return view ('userlist', compact('users'));
    }else {
        return back();
    }
    }

    public function pins(){
    if(Auth::user()->isAdmin()){
        return view ('pins');
    }else {
        return back();
    }
    }

    /*public function addteritory(){
    if(Auth::user()->isAdmin()){
        return view ('addteritory');
    }else {
        return back();
    }
    }*/

    public function viewmap(){
    if(Auth::user()->isAdmin()){
        return view ('viewmap');
    }else {
        return back();
    }
    }

    public function viewusermap(){
    if(Auth::user()->isAdmin()){
        return view ('viewusermap');
    }else {
        return back();
    }
    }
}
