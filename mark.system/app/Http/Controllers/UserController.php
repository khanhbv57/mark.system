<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Controllers\Controller;
use Hash;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('role:admin');
	}
	
    public function index()
    {	
    	$users = User::paginate(5);
    	return view('admins.users.home', ['users' => $users]);
    }

    public function create(){
    	return view('admins.users.create');
    }

    public function store(CreateUserRequest $request){
    	$user = new User;

    	$user->name = $request->input('name');
    	$user->email = $request->input('email');
    	$user->password = Hash::make($request->input('password'));
    	$user->save();
    	$user->attachRole(2);

    	return redirect('admin/user');
    }

    public function edit($id){
    	$user = User::find($id);
    	return view('admins.users.edit', ['user' => $user]);
    }

    public function update(CreateUserRequest $request, $id){
    	$user = User::find($id);

    	$user->name = $request->input('name');
    	$user->email = $request->input('email');
    	$user->password = Hash::make($request->input('password'));
    	$user->save();

    	return redirect('admin/user');
    }

    public function destroy($id){
    	User::destroy($id);

    	return redirect('/admin/user');
    }
}
