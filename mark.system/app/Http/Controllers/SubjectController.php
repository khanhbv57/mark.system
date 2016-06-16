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

class SubjectController extends Controller
{
    public function index(){
    	$i = 1;
    	$semesters = Semester::all();
    	$subjects = Subject::all();
        $years = Year::all();
    	return view('admins.subjects.home')->with([
    		'i' => $i,
            'years' => $years,
    		'semesters' => $semesters,
    		'subjects' => $subjects
    	]);
    }

    public function store(Request $request){
    	$subject = new Subject;

    	$subject->subject_title = $request->input('subject');
        $subject->subject_code = $request->input('subject_code');
    	$subject->semester_id = $request->get('semester');

    	$subject->save();
    	if(Auth::user()->hasRole('admin')){
            return redirect('admin/subject');  
        }
        else{
            return redirect('teacher/subject');
        }
    }

    public function destroy($id){
    	Subject::destroy($id);

    	if(Auth::user()->hasRole('admin')){
            return redirect('admin/subject');  
        }
        else{
            return redirect('teacher/subject');
        }
    }

    public function subMenu(){
        $year_id = Input::get('year_id');

        $semesters = Semester::where('year_id', '=', $year_id)->get();
        
        return response()->json($semesters);
    }
}
