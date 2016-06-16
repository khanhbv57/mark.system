<?php

use App\Year;
use App\Semester;
use App\Subject;
use App\Fileentry;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;




Route::group(['middleware' => 'web'], function () {
    Route::get('/', function () {
    $years = Year::all();
    $semester = \Input::get('semester');
    $results = Subject::where('semester_id', '=', $semester)->get();
    // $fileentries = array();
    // foreach ($results as $re) {
    //     $files = DB::table('fileentries')->where('subject_id', '=', $re->id)->get();
    //     foreach ($files as $file) {
    //         # code...
    //         array_push($fileentries, $file);
    //     }
    // }
    return view('welcome')->with([
        'years' => $years,
        //'fileentries' => $fileentries,
        'results' => $results
    ]);
});

Route::post('/search', function () {
    $years = Year::all();
    $semester = \Input::get('semester');
    $mamh = \Input::get('mamh');
    $tenmh = \Input::get('tenmh');
    if($mamh == null && $tenmh == null) $results = Subject::where('semester_id', '=', $semester)->get();
    elseif($mamh != null && $tenmh == null){
        $results = Subject::where('semester_id', '=', $semester)->where('subject_code', 'like', '%'.$mamh.'%')->get();
    }
    elseif($mamh == null && $tenmh != null){
        $results = Subject::where('semester_id', '=', $semester)->where('subject_title', 'like', '%'.$tenmh.'%')->get();
    }
    else{
        $results = Subject::where('semester_id', '=', $semester)->where('subject_code', 'like', '%'.$mamh.'%')->where('subject_title', 'like', '%'.$tenmh.'%')->get();
    }
    $i = 0;
    foreach ($results as $result) {
        $i++;
    }
    if($i == 0){
        \Session::flash('flash_message_empty', 'Không có dữ liệu!');
    }
    return view('welcome')->with([
        'years' => $years,
        //'fileentries' => $fileentries,
        'results' => $results,
        //'i' => $i
    ]);
});

Route::get('/ajax-submenu', function(){
    $year_id = Input::get('year_id');

    $semesters = Semester::where('year_id', '=', $year_id)->get();
    
    return response()->json($semesters);
});

Route::get('/get/{filename}', function($filename){
    $entry = Fileentry::where('filename', '=', $filename)->firstOrFail();
    $file = Storage::disk('local')->get($entry->filename);
    
    return (new Response($file, 200))
        ->header('Content-Type', $entry->mime);
});
    
    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::group(['prefix' => 'admin'], function () {
    	Route::resource('/user', 'UserController');
    	Route::resource('/year', 'YearController');
        Route::resource('/semester', 'SemesterController');
        Route::resource('/subject', 'SubjectController');
        
        Route::get('/post', 'PostController@index');

        Route::get('/post/ajax-submenu', 'PostController@subMenu');
        Route::get('/post/ajax-submenu2', 'PostController@subMenu2');

        Route::delete('/post/delete/{filename}', [
            'as' => 'deleteentry', 'uses' => 'PostController@delete']);
        Route::get('/post/get/{filename}', [
            'as' => 'getentry', 'uses' => 'PostController@get']);
        Route::post('/post/add',[ 
                'as' => 'addentry', 'uses' => 'PostController@add']);
        Route::get('/post/edit/{id}',[
            'as' => 'editentry', 'uses' => 'PostController@edit'
            ]);
        Route::put('/post/update/{id}',[
            'as' => 'updateentry', 'uses' => 'PostController@update'
            ]);
    });
    Route::group(['prefix' => 'teacher'], function () {
    	Route::resource('/year', 'YearController');
        Route::resource('/semester', 'SemesterController');
        Route::resource('/subject', 'SubjectController');
        Route::get('/subject/ajax-submenu', 'SubjectController@subMenu');
        Route::get('/post', 'PostController@index');

        Route::get('/post/ajax-submenu', 'PostController@subMenu');
        Route::get('/post/ajax-submenu2', 'PostController@subMenu2');

        Route::delete('/post/delete/{filename}', [
            'as' => 'deleteentry', 'uses' => 'PostController@delete']);
        Route::get('/post/get/{filename}', [
            'as' => 'getentry', 'uses' => 'PostController@get']);
        Route::post('/post/add',[ 
                'as' => 'addentry', 'uses' => 'PostController@add']);
        Route::get('/post/edit/{id}',[
            'as' => 'editentry', 'uses' => 'PostController@edit'
            ]);
        Route::put('/post/update/{id}',[
            'as' => 'updateentry', 'uses' => 'PostController@update'
            ]);
    });
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});

