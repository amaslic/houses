<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
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
               return view('dashboard');
           }
               else{
                return view('home');
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
        return view ('userlist');
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

    public function addteritory(){
    if(Auth::user()->isAdmin()){
        return view ('addteritory');
    }else {
        return back();
    }
    }

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
