<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    //
    public function getYear($id){
    	return Year::find($id);
    }
}
