<?php

namespace App;

use App\Subject;
use Illuminate\Database\Eloquent\Model;

class Fileentry extends Model
{
    //
    protected $table = 'fileentries';

    protected $fillable = [
        'filename', 'mime', 'original_filename', 'subject_id', 'created_at', 'updated_at',
    ];

    public function getSubject($id){
    	return Subject::find($id);
    }

    public function getSemester($id){
    	return Semester::find($id);	
    }

    public function getYear($id){
    	return Year::find($id);	
    }
}
