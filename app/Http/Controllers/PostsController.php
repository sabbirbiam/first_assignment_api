<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCommentRequest $request)
    {
        //
        // return $request;

        if (!($request->session()->has('register')) && $request->session()->get('register')->id) {
            return "stop no session";
        }

        $data['comments'] = $request->comments ?? "";
        $data['user_id'] = $request->user_id ?? null;
        $data['story_id'] = $request->story_id ?? null;
        $data['user_id'] = $request->session()->get('register')->id ?? null;


        $success = Posts::create($data);
        return redirect('/user/stories');


        if ($success) {
            return response()->json(array(
                'id' => $success->id,
                'status' => 1,
                'message' => 'Comment Save Succefully'
            ));
        } else {
            return response()->json(array(
                'id' => 0, 'status' => 0,
                'message' => 'Comment Failed to save'
            ));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $posts = Posts::find($id);

        if (!$posts) {
            $response = [
                'code' => 400,
                'status' => 'failed',
                'message' => 'Update unsuccessful'
            ];

            return response()->json([
                'response' => $response
            ], 400);
        }

        $posts->comment = $request->name ?? $posts->comment;
        $posts->user_id = $request->user_id ?? $posts->user_id;
        $posts->story_id = $request->story_id ?? $posts->story_id; 
        $posts->save();

        $response = [
            'code' => 200,
            'status' => 'success',
            'message' => 'Update Successful'
        ];

        return response()->json([
            'data' => $posts,
            'response' => $response
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return 555;
        //
        $posts = Posts::find($id)->delete();

        return redirect('/stories');

        // if (!$posts) {
        //     $response = [
        //         'code' => 400,
        //         'status' => 'failed',
        //         'message' => 'Delete unsuccessful'
        //     ];

        //     return response()->json([
        //         'response' => $response
        //     ], 400);
        // }

        // $response = [
        //     'code' => 200,
        //     'status' => 'success',
        //     'message' => 'Deleted successfully'
        // ];

        // return response()->json([
        //     'response' => $response
        // ], 200);
    }

    public function postDeleteByUser($id)
    {
        // return 555;
        //
        $posts = Posts::find($id)->delete();

        return redirect('/user/stories');
    }
}
