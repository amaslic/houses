<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Auth;

use App\User;
use Illuminate\Support\Facades\DB;
use App\Marker;

use App\Pin;

use App\Sale;
use App\Hour;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use App\Path;

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
                      $userid = null;

                }else {

                   

                    $salestodayperuser = Sale::where('created_at', '>=', Carbon::now()->subDay())->where('user_id',$peruser->id)->count();

                    $saleslastweekperuser = Sale::where('created_at', '>=', Carbon::now()->subDay(7))->where('user_id',$peruser->id)->count();

                    $saleslastmonthperuser = Sale::where('created_at', '>=', Carbon::now()->subMonth())->where('user_id',$peruser->id)->count();

                    $saleslastyearperuser = Sale::where('created_at', '>=', Carbon::now()->subYear())->where('user_id',$peruser->id)->count();

                    $totalsalesperuser = Sale::where('user_id',$peruser->id)->count();

                    $perusername=$peruser->name;
                    $userid = $peruser->id;

               }

                    $peruserhour = request('peruserhour');
                    $peruserhours = User::find($peruserhour);
                    if(empty($peruserhours)){
                        $markersperhours = 'Please Select user';
                        $countmarkersperuser = '';
                        $peruserhour2='';
                    }else{
                        $date = request('date');
                        $starttimereq = request('firsttime');
                        $starttime= date("G:i", strtotime($starttimereq));
                        $endtimereq = request('secondtime');
                        $endtime= date("G:i", strtotime($endtimereq));
                      
                        $starttime2 = $date.' '. $starttime.':00';
                        $endtime2 = $date.' '. $endtime.':00';
                         $peruserhour2=$peruserhours->name;
                          $peruserhour3=$peruserhours->id;
                       // dd($starttime2.'||'.$endtime2);
                        $markersperhours = Marker::where('user_id',$peruserhour3)->where('updated_at', '>=', $starttime2)->where('updated_at', '<=', $endtime2)->get();
                        $countmarkersperuser = count($markersperhours);
                       
                    }


                    $perusertime = request('perusertime');
                    $perusertimes = User::find($perusertime);
                    $date = request('date');

                    if(empty($perusertimes)){

                        $workhours='Please Select user';
                        $hours='';
                        $minutes='';

                    }else{
                        
                        $gettime = Hour::where('date',$date)->where('user_id',$perusertime)->first();
                        
                        if($gettime != null){
                        
                        $hours = $gettime->total_time /60;
                        $hours = number_format($hours,0);
                        $minutes = $gettime->total_time % 60;
                        }else
                        {
                            $hours='0';
                            $minutes='0';
                        }
                    

                        
                     }

                  // $gettime = DB::table('hours')->where('total_time','4')->first();
                    //$gettime = Hour::where('dat')->where('user_id',Auth::id())->first();
                    //dd($gettime);
                     
                   
                  


                   
              



         return view('dashboard',compact('todaysalescount','lastweeksalescount','lastweeksalessum','lastmonthsalescount'

            ,'lastmonthsalessum','lastyearsalescount','lastyearsalessum','todaysalessum','totalsalescount',

            'totalsalessum','users','perusername','salestodayperuser','saleslastweekperuser','saleslastmonthperuser',

            'saleslastyearperuser','totalsalesperuser','userid','markersperhours','countmarkersperuser','peruserhour2', 'gettime', 'hours','minutes'));

        }

               else{

                    $locations = Marker::where('user_id', Auth::id())->get();
                 $goto = Territory::first();
                    $pins = Pin::get();
                    
                    $now = Carbon::now()->toDateString();
                    $status = Hour::where('date',$now)->where('user_id',Auth::id())->first();
                    $territory = Territory::where('user_id', Auth::id())->get();
                    // $territory=$territory->where('active',1);
                   
                    if($status===null){
                        
                        $status=0;
                    }else {
                        if($status->active===1){
                            $status=1;
                            
                        }else
                        $status=0;
                    }
                    

                    return view('home', compact('locations','pins','territory','goto', 'status'));

               

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
        $now = Carbon::now()->toDateString();
                    $pins = Pin::get();

                    $territory = Territory::where('user_id', Auth::id())->get();

                    $status = Hour::where('date',$now)->where('user_id',Auth::id())->first();
                    if($status===null){
                        
                        $status=0;
                    }else {
                        if($status->active===1){
                            $status=1;
                            
                        }else
                        $status=0;
                    }

                    return view('home1', compact('locations','pins','territory','goto','status'));
    }

    public function addPath(){
        //var_dump(Input::get('coords'));
        
                        $path = Path::create([
                            'u_id' => Auth::id(),
                            'u_name' => Auth::user()->email,
                            'coords' => Input::get('coords'),
                            'km' => 0,
                            'date' => Input::get('date'),
                            
                        ]);
        return back();
    }

    public function getPaths(){
        if(Auth::user()->isAdmin()){
            $users = User::find(Input::get('usernamepath'));

            $day = Input::get('day');
            $month = Input::get('month');
            $year =  Input::get('year');
           // $fullDate = $day + '/' + $month + '/' + $year;
            $path = Path::where('u_id', Input::get('usernamepath'))->where('date', $day+'/'+$month+'/'+$year)->get();
           // $locations = Marker::where('user_id', $id)->get();

            return view ('path', compact('users', 'path'));
        }else {
            return back();
        }
    }

   
    public function getPath($id){
        if(Auth::user()->isAdmin()){
            $users = User::find($id);
            $path = Path::where('u_id', $id)->get();
           // $locations = Marker::where('user_id', $id)->get();

            return view ('path', compact('users', 'path'));
        }else {
            return back();
        }
    }
}

