<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\Stories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index()
    {
        return 500;
        $users = DB::table('register')->get();
        return view('home.index', ['users' => $users]);
    }


    public function create()
    {
    	return view('admin.create');
    }

     public function store(CreateUserRequest $request)
    {
        // return $request;

    	$params = [
    		'name' => $request->name,
    		'phone' => $request->phone,
    		'email' => $request->email,
    		'dob' => $request->dob,
    		'gender' => 1,
    		'username' => $request->username,
    		'password' => $request->password,
            'type' => $request->type ?? "user",
            'status' => 1
    	];

    	DB::table('registration')
    		->insert($params);
    	return redirect('/');
    }

    public function seestories()
    {
        $stories = Stories::with(['user'])
        ->where('blocked', 1)
        ->orderBy('id', 'DESC')
        ->get();
        // $stories = Stories::with(['user']);
    // return $stories;
    return view('home.stories', ['stories' => $stories]);
    // return response()->json($stories);
    }
    
}
