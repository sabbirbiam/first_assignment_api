<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    //
    public function index()
    {
    	return view('login.index');
    }

    public function verify(Request $request)
    {
        // return $request;
        $u = DB::table('registration') 
            ->where('username', $request->username)
            ->where('password', $request->password)
            ->where('type', '=', 'user')
            ->first();
            

    	if(!$u)
    	{
            $request->session()->flash('message', 'Invalid username or password');
    		return redirect('/login');
    	}
    	else
    	{
               
         $request->session()->put('register', $u);
        //  return view('user.home')
        //  ->with('de', $u);
    		return redirect('/user');
    	}
    }
}
