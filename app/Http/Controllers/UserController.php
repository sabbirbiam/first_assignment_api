<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStoryRequest;
use App\Models\Posts;
use App\Models\Stories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return view('stories.index');
        $stories = Stories::with(['user', 'comment'])
        ->where('blocked', 1)
        ->orderBy('id', 'DESC')
        ->get();
        return view('user.stories', ['stories' => $stories]);
        // return response()->json($stories);
    }

    public function userstories(Request $request)
    {
        //
        // return view('stories.index');
        $stories = Stories::with(['user', 'comment'])
        ->where('user_id', $request->session()->get('register')->id)
        ->orderBy('id', 'DESC')
        ->get();
        return view('user.userstories', ['stories' => $stories]);
        // return response()->json($stories);
    }

    public function create()
    {
        // dd("sabbir");
        return view('user.create');
    }

    public function store(CreateStoryRequest $request)
    {
        if (!($request->session()->has('register')) && $request->session()->get('register')->id) {
            return "stop no session";
        }
        //  $data = Session::get('register');
        $data['title'] = $request->title ?? "";
        $data['story'] = $request->story ?? "";
        $data['tags'] = $request->tags ?? "";
        $data['section'] = $request->section ?? "";
        $data['storyimage'] = $request->storyimage ?? "";
        $data['storycaption'] = $request->storycaption ?? "";
        $data['blocked'] = 1;
        $data['user_id'] = $request->session()->get('register')->id ?? null;

        $success = Stories::create($data);
        return redirect('/user/stories');
    }

    public function edit($id)
    {
        // return $id;
        $stroy = DB::table('stories')
            ->where('id', $id)
            ->first();
        return view('stories.edit')
            ->with('story', $stroy);
    }

    public function updatestory(Request $request, $id)
    {
        // return $request;
        // return $id;


        if (!($request->session()->has('register')) && $request->session()->get('register')->id) {
            return "stop no session";
        }

        $stroy = DB::table('stories')
        ->where('id', $id)
        ->first();

        //  $data = Session::get('register');
        $data['title'] = $request->title ?? $stroy->title;
        $data['story'] = $request->story ?? $stroy->story;
        $data['tags'] = $request->tags ?? $stroy->tags;
        $data['section'] = $request->section ?? $stroy->section;
        $data['storyimage'] = $request->storyimage ?? $stroy->storyimage;;
        $data['storycaption'] = $request->storycaption ?? $stroy->section;;
        $data['user_id'] = $request->session()->get('register')->id ?? null;

        DB::table('stories')
        ->where('id', $id)
        ->update($data);

        return redirect('/user/stories');
    }

    public function storiesDelete($id) 
    {
        // return $id;

        $posts =  Posts::where('story_id', $id)->get();
        foreach ($posts as $child) {
            $child->delete();
        }
        // return $posts;
        $delete = Stories::find($id)->delete();

        return redirect('/user/stories');
        
    }

    public function editUser($id)
    {
        // return $id;
        $user = DB::table('registration')
            ->where('id', $id)
            ->first();
        //  dd($user);
        return view('user.edit')
            ->with('user', $user);
    }

    public function updateuser(Request $request, $id)
    {
        // return $request;
        // return $id;


        if (!($request->session()->has('register')) && $request->session()->get('register')->id) {
            return "stop no session";
        }

        $stroy = DB::table('registration')
        ->where('id', $id)
        ->first();

        // dd($stroy);

        //  $data = Session::get('register');
        $data['name'] = $request->name ?? $stroy->name;
        $data['email'] = $request->email ?? $stroy->eamil;
        $data['dob'] = $request->dob ?? $stroy->dob;
        $data['phone'] = $request->phone ?? $stroy->phone; 
        $data['gender'] = $request->gender ?? $stroy->gender; 

        DB::table('registration')
        ->where('id', $id)
        ->update($data);

        return redirect('/user');
    }

    public function userhome(Request $request)
    {
        $user = DB::table('registration')
            ->where('id', $request->session()->get('register')->id)
            ->first();
        return view('user.user')
            ->with('de', $user);
    }

}
