<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStoryRequest;
use App\Models\Posts;
use App\Models\Registration;
use App\Models\Stories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoriesController extends Controller
{
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
            ->orderBy('id', 'DESC')
            ->get();
        // return view('stories.index', ['stories' => $stories]);
        if ($stories) {
            $response = [
                'code' => 200,
                'status' => 'success',
                'message' => 'Data available'
            ];

            return response()->json([
                'data' => $stories,
                'response' => $response
            ], 200);
        } else {
            $response = [
                'code' => 400,
                'status' => 'success',
                'message' => 'Data Not Found'
            ];

            return response()->json([
                'data' => $stories,
                'response' => $response
            ], 200);
        }

        return response()->json($stories);
    }

    public function search(Request $request)
    {
        //
        // return $request;
        $stories = Stories::with(['user', 'comment'])
            ->where('title', 'like', '%' . $request->title . '%')
            ->orWhere('story', 'like', '%' . $request->story . '%')
            ->orWhere('section', 'like', '%' . $request->section . '%')
            ->orWhere('tags', 'like', '%' . $request->tags . '%')
            ->orderBy('id', 'DESC')
            ->get();
        return view('stories.index', ['stories' => $stories]);
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
    public function store(CreateStoryRequest $request)
    {
        // return $request;
        $data['title'] = $request->title ?? "";
        $data['story'] = $request->story ?? "";
        $data['tags'] = $request->tags ?? "";
        $data['section'] = $request->section ?? "";
        $data['storyimage'] = $request->storyimage ?? "";
        $data['storycaption'] = $request->storycaption ?? "";
        $data['blocked'] = 1;
        $data['user_id'] = $request->user_id;

        $success = Stories::create($data);

        if ($success) {
            return response()->json(array(
                'id' => $success->id,
                'status' => 1,
                'message' => 'Stories Save Succefully'
            ));
        } else {
            return response()->json(array(
                'id' => 0, 'status' => 0,
                'message' => 'Stories Failed to save'
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

        $stories = Stories::find($id);

        if ($stories) {
            $response = [
                'code' => 200,
                'status' => 'success',
                'message' => 'Data available'
            ];

            return response()->json([
                'data' => $stories,
                'response' => $response
            ], 200);
        } else {
            $response = [
                'code' => 400,
                'status' => 'success',
                'message' => 'Data Not Found'
            ];

            return response()->json([
                'data' => $stories,
                'response' => $response
            ], 200);
        }
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
    public function update(Request $request)
    {

        $stories = Stories::find($request->id);

        if (!$stories) {
            $response = [
                'code' => 400,
                'status' => 'failed',
                'message' => 'Update unsuccessful'
            ];

            return response()->json([
                'response' => $response
            ], 400);
        }

        $stories->title = $request->title ?? $stories->title;
        $stories->story = $request->story ?? $stories->story;
        $stories->tags = $request->tags ?? $stories->tags;
        $stories->storycaption = $request->storycaption ?? $stories->storycaption;
        $stories->storyimage = $request->storyimage ?? $stories->storyimage;
        // $stories->user_id = $request->user_id ?? $stories->user_id;
        $stories->save();

        $response = [
            'code' => 200,
            'status' => 'success',
            'message' => 'Update Successful'
        ];

        return response()->json([
            'data' => $stories,
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
        //
        $stories = Stories::find($id)->delete();

        if (!$stories) {
            $response = [
                'code' => 400,
                'status' => 'failed',
                'message' => 'Delete unsuccessful'
            ];

            return response()->json([
                'response' => $response
            ], 400);
        }

        $response = [
            'code' => 200,
            'status' => 'success',
            'message' => 'Deleted successfully'
        ];

        return response()->json([
            'response' => $response
        ], 200);
    }

    public function markasunlisted($id)
    {
        // return $request;
        // return $id;


        $stroy = DB::table('stories')
            ->where('id', $id)
            ->first();


        if ($stroy->blocked == 0) {
            $data['blocked'] = 1;
        } else {
            $data['blocked'] = 0;
        }

        DB::table('stories')
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

    public function usersearch(Request $request)
    {
        //
        // return $request;
        $stories = Stories::with(['user', 'comment'])
            ->where('blocked', 1)
            ->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->title . '%')
                    ->orWhere('story', 'like', '%' . $request->story . '%')
                    ->orWhere('section', 'like', '%' . $request->section . '%')
                    ->orWhere('tags', 'like', '%' . $request->tags . '%');
            })->orderBy('id', 'DESC')->get();
        // return $stories;
        return view('user.stories', ['stories' => $stories]);
    }

    public function storySearch(Request $request)
    {
        //
        // return $request;
        $stories = [];
        if ($request->type == "user") {
            $stories = Stories::with(['user', 'comment'])
                ->where('blocked', 1)
                ->where(function ($q) use ($request) {
                    $q->where('title', 'like', '%' . $request->serchValue . '%')
                        ->orWhere('story', 'like', '%' . $request->serchValue . '%')
                        ->orWhere('section', 'like', '%' . $request->serchValue . '%')
                        ->orWhere('tags', 'like', '%' . $request->serchValue . '%');
                })->orderBy('id', 'DESC')->get();
        }

        if ($request->type == "admin") {
            $stories = Stories::with(['user', 'comment'])
                // ->where('blocked', 1)
                ->where(function ($q) use ($request) {
                    $q->where('title', 'like', '%' . $request->serchValue . '%')
                        ->orWhere('story', 'like', '%' . $request->serchValue . '%')
                        ->orWhere('section', 'like', '%' . $request->serchValue . '%')
                        ->orWhere('tags', 'like', '%' . $request->serchValue . '%');
                })->orderBy('id', 'DESC')->get();
        }


        if ($stories) {
            $response = [
                'code' => 200,
                'status' => 'success',
                'message' => 'Data available'
            ];

            return response()->json([
                'data' => $stories,
                'response' => $response
            ], 200);
        } else {
            $response = [
                'code' => 400,
                'status' => 'success',
                'message' => 'Data Not Found'
            ];

            return response()->json([
                'data' => $stories,
                'response' => $response
            ], 200);
        }

        return response()->json($stories);
        // $stories = Stories::with(['user', 'comment'])
        //     ->where('blocked', 1)
        //     ->where(function ($q) use ($request) {
        //         $q->where('title', 'like', '%' . $request->title . '%')
        //             ->orWhere('story', 'like', '%' . $request->story . '%')
        //             ->orWhere('section', 'like', '%' . $request->section . '%')
        //             ->orWhere('tags', 'like', '%' . $request->tags . '%');
        //     })->orderBy('id', 'DESC')->get();
        // return $stories;
        // return view('user.stories', ['stories' => $stories]);
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

        if (!$delete) {
            $response = [
                'code' => 400,
                'status' => 'failed',
                'message' => 'Delete unsuccessful'
            ];

            return response()->json([
                'response' => $response
            ], 400);
        }

        $response = [
            'code' => 200,
            'status' => 'success',
            'message' => 'Deleted successfully'
        ];

        return response()->json([
            'response' => $response
        ], 200);
    }

    public function userindex()
    {
        //
        // return view('stories.index');
        $stories = Stories::with(['user', 'comment'])
            ->where('blocked', 1)
            ->orderBy('id', 'DESC')
            ->get();

        if ($stories) {
            $response = [
                'code' => 200,
                'status' => 'success',
                'message' => 'Data available'
            ];

            return response()->json([
                'data' => $stories,
                'response' => $response
            ], 200);
        } else {
            $response = [
                'code' => 400,
                'status' => 'success',
                'message' => 'Data Not Found'
            ];

            return response()->json([
                'data' => $stories,
                'response' => $response
            ], 200);
        }

        return response()->json($stories);
    }
}
