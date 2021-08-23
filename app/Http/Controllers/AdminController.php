<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function index()
    {

        return view('admin.index');
    }

    public function verify(Request $request)
    {

        // return $request;
        $u = DB::table('registration')
            ->where('username', $request->username)
            ->where('password', $request->password)
            ->where('type', '=', 'admin')
            ->first();
        // dd($u);
        if (!$u) {
            $request->session()->flash('message', 'Invalid Admin or password');
            return redirect('/admin');
        } else {

            $request->session()->put('admin', $u);
            return redirect('/admin/home');
            // return redirect('/registration');

        }
    }

    public function adminhome(Request $request)
    {

        if (!$request->session()->has('admin')) {
            return "stop no session";
        }

        $value =  $request->session()->get('admin');

        // dd($value);
        return view('admin.home')
            ->with('de', $value);
    }

    public function userinfo()
    {
        // return 600;
        $userlist = DB::table('users')
            ->get();

        if ($userlist) {
            $response = [
                'code' => 200,
                'status' => 'success',
                'message' => 'Data available'
            ];

            return response()->json([
                'data' => $userlist,
                'response' => $response
            ], 200);
        } else {
            $response = [
                'code' => 400,
                'status' => 'success',
                'message' => 'Data Not Found'
            ];

            return response()->json([
                'data' => $userlist,
                'response' => $response
            ], 200);
        }
    }

    public function userStatus($id)
    {

        $stroy = DB::table('users')
            ->where('id', $id)
            ->first();


        if ($stroy->status == 0) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }

        DB::table('users')
            ->where('id', $id)
            ->update($data);

        if (!$stroy) {
            $response = [
                'code' => 400,
                'status' => 'failed',
                'message' => 'Update unsuccessful'
            ];

            return response()->json([
                'response' => $response
            ], 400);
        }

        $response = [
            'code' => 200,
            'status' => 'success',
            'message' => 'Update successfully'
        ];

        return response()->json([
            'response' => $response
        ], 200);
    }

    public function create()
    {
        return view('home.create');
    }

    public function store(CreateUserRequest $request)
    {
        // return $request;
        $params = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
            'type' => $request->type ?? "admin",
            'status' => 1

        ];

        DB::table('registration')
            ->insert($params);
        return redirect('/admin/home');
    }
}
