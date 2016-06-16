<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Fileentry;
use DB;

class Subject extends Model
{
    //
    public function getSemester($id){
    	return Semester::find($id);
    }

    public function hasMark(){
    	$var = DB::table('fileentries')->where('subject_id', '=', $this->id)->get();
    	$count = 0;
    	foreach($var as $v){
    		$count++;
    	}
    	if($count > 0){
    		return true;
    	}
    	else return false;
    }

    public function getMark(){
    	if($this->hasMark()){
    		return Fileentry::where('subject_id', $this->id)->first();
    	}
    	
    }
}
