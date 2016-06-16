<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use App\Fileentry;
use App\Year;
use App\User;
use App\Semester;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Carbon\Carbon; 

class YearController extends Controller
{
    //
    public function index(){
    	$years = Year::all();
    	$i = 1;
    	return view('admins.years.home')->with([
    		'years' => $years,
    		'i' => $i,
    	]);
    }

    public function store(Request $request){
    	$years = Year::where('year_title', '=', $request->input('year'))->get();
        $i = 0; 
        foreach($years as $y){
            $i++;
        }
        if($i == 0){
            $year = new Year;

            $year->year_title = $request->input('year');
            
            $year->save();
            
            \Session::flash('flash_message_success', 'Thêm năm học thành công!');
        }   

        else{
            \Session::flash('flash_message_fail', 'Thêm năm học thất bại!');
        }
        
    	if(Auth::user()->hasRole('admin')){
            return redirect('admin/year');  
        }
        else{
            return redirect('teacher/year');
        }
    }

    public function destroy($id){
    	Year::destroy($id);

    	if(Auth::user()->hasRole('admin')){
            return redirect('admin/year');  
        }
        else{
            return redirect('teacher/year');
        }
    }

    
}
