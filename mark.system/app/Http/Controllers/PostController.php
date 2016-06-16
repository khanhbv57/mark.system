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

class PostController extends Controller
{
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$entries = Fileentry::paginate(5);
		$years = Year::all();
		
		return view('admins.posts.home')->with([
			'entries' => $entries,
			'years' => $years,
		]);
	}

	public function get($filename){
	
		$entry = Fileentry::where('filename', '=', $filename)->firstOrFail();
		$file = Storage::disk('local')->get($entry->filename);
 
		return (new Response($file, 200))
              ->header('Content-Type', $entry->mime);
	}

	public function delete($filename){
		if(Auth::user()->hasRole('admin')){
			$entry = Fileentry::where('filename', '=', $filename)->firstOrFail();
			$entry->delete();
			Storage::delete($filename);
			return redirect('admin/post');	
		}
		else{
			$entry = Fileentry::where('filename', '=', $filename)->firstOrFail();
			$entry->delete();
			Storage::delete($filename);
			return redirect('teacher/post');	
		}
	}

	public function add() {

		$subject_id = \Input::get('subject');
		$filename = \Input::get('name');
		$file = \Input::file('filefield');
		$extension = $file->getClientOriginalExtension();
		if(!Subject::find($subject_id)->hasMark()){
			Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
			$entry = new Fileentry();
			$entry->mime = $file->getClientMimeType();
			if(!empty($filename)){
				$entry->original_filename = $filename;
			} 
			else{
				$entry->original_filename = $file->getClientOriginalName();
			}
			$entry->filename = $file->getFilename().'.'.$extension;
			$entry->subject_id = $subject_id;
			$entry->save();	
			\Session::flash('flash_message_success','Thêm file thành công!');
			if(Auth::user()->hasRole('admin')){
				return redirect('admin/post');	
			}
			else{
				return redirect('teacher/post');
			}
		}
		else{
			\Session::flash('flash_message_fail','Thêm file không thành công! Môn học này đã có điểm!');
			if(Auth::user()->hasRole('admin')){
				return redirect('admin/post');	
			}
			else{
				return redirect('teacher/post');
			}
		}
		
	}

	public function edit($id){
		$entry = Fileentry::find($id);
		return view('admins.posts.edit', ['entry' => $entry]);
	}

	public function update($id){
		$fname = \Input::get('name');
		$fileentry = Fileentry::find($id);
		if(\Input::hasFile('filefield')){
			$file = \Input::file('filefield');
			$extension = $file->getClientOriginalExtension();
			Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
			$fileentry->filename = $file->getFilename().'.'.$extension;
			$fileentry->mime = $file->getClientMimeType();
			$fileentry->original_filename = $fname;
		}
		$fileentry->save();
		if(Auth::user()->hasRole('admin')){
			return redirect('admin/post');	
		}
		else{
			return redirect('teacher/post');
		}
	}

	public function subMenu(){
		$year_id = Input::get('year_id');

		$semesters = Semester::where('year_id', '=', $year_id)->get();
		
		return response()->json($semesters);
	}

	public function subMenu2(){
		$semester_id = Input::get('semester_id');

		$subjects = Subject::where('semester_id', '=', $semester_id)->get();
		
		return response()->json($subjects);
	}
}
