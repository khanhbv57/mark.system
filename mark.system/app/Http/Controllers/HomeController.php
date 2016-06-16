<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
    	if(Auth::user()->hasRole('admin')){
    		return redirect('admin/user');	
    	}
        else{
        	return redirect('teacher/post');
        }
    }
}
