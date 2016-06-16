<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Fileentry;
use App\Year;
use App\User;
use App\Semester;
use App\Subject;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
 
class SemesterController extends Controller
{
    public function index(){
    	$i = 1;
    	$semesters = Semester::all();
    	$years = Year::all();

    	return view('admins.semesters.home')->with([
    		'i' => $i,
    		'semesters' => $semesters,
    		'years' => $years
    	]);
    }

    public function store(Request $request){
    	$sem = new Semester;

    	$sem->semester_title = $request->input('semester');
    	$sem->year_id = $request->get('year');

    	$sem->save();
        if(Auth::user()->hasRole('admin')){
            return redirect('admin/semester');  
        }
        else{
            return redirect('teacher/semester');
        }
    	
    }

    public function destroy($id){
    	Semester::destroy($id);

    	if(Auth::user()->hasRole('admin')){
            return redirect('admin/semester');  
        }
        else{
            return redirect('teacher/semester');
        }
    }
}


