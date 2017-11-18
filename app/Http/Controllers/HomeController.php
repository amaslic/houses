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

use App\Territory;

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

               $users = User::get();

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



               $peruserform = request('peruser');

               $peruser = User::find($peruserform);

              

               if(empty($peruserform)){

                    $perusername='No Selected User';

                    $salestodayperuser = 'Please select user';

                    $saleslastweekperuser = '';

                   $saleslastmonthperuser = '';

                    $saleslastyearperuser = '';

                    $totalsalesperuser = '';

                }else {

                    $salestodayperuser = Sale::where('created_at', '>=', Carbon::now()->subDay())->where('user_id',$peruser->id)->count();

                    $saleslastweekperuser = Sale::where('created_at', '>=', Carbon::now()->subDay(7))->where('user_id',$peruser->id)->count();

                    $saleslastmonthperuser = Sale::where('created_at', '>=', Carbon::now()->subMonth())->where('user_id',$peruser->id)->count();

                    $saleslastyearperuser = Sale::where('created_at', '>=', Carbon::now()->subYear())->where('user_id',$peruser->id)->count();

                    $totalsalesperuser = Sale::where('user_id',$peruser->id)->count();

                    $perusername=$peruser->name;

               }

              



         return view('dashboard',compact('todaysalescount','lastweeksalescount','lastweeksalessum','lastmonthsalescount'

            ,'lastmonthsalessum','lastyearsalescount','lastyearsalessum','todaysalessum','totalsalescount',

            'totalsalessum','users','perusername','salestodayperuser','saleslastweekperuser','saleslastmonthperuser',

            'saleslastyearperuser','totalsalesperuser'));

        }

               else{

                    $locations = Marker::where('user_id', Auth::id())->get();
                 $goto = Territory::first();
                    $pins = Pin::get();

                    $territory = Territory::where('user_id', Auth::id())->get();
                    // $territory=$territory->where('active',1);
                   

                    return view('home', compact('locations','pins','territory','goto'));

               

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
    public function gotomap($id){
        $locations = Marker::where('user_id', Auth::id())->get();
        $goto = Territory::where('id', $id)->first();
       
                    $pins = Pin::get();

                    $territory = Territory::where('user_id', Auth::id())->get();

                   

                    return view('home1', compact('locations','pins','territory','goto'));
    }

   

}

