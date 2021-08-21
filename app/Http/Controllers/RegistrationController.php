<?php

namespace App\Http\Controllers;

use App\Models\Registration as ModelsRegistration;
use App\Models\Stories;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return csrf_token(); 
        $registration = ModelsRegistration::with(['stories'])->get();

        return response()->json($registration);
        // return 4040;
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
    public function store(Request $request)
    {
        // return $request;
        // $validatedData = $request->validate([
        //     'email' => 'required',
        // ]);

        if (!isset($request->email)) {
            return response()->json(array(
                'code' => 409,
                'status' => 0,
                'message' => 'E-Mail Cannot be empty'
            ));
        }

        if ($request->email != null) {
            $reg = ModelsRegistration::where('email', $request->email)->first();
            if ($reg) {
                return response()->json(array(
                    'code' => 409,
                    'status' => 0,
                    'message' => 'This email has been taken. Please try another one.'
                ));
            }
        }

        $data['name'] = $request->name ?? "";
        $data['email'] = $request->email ?? "";
        $data['dob'] = $request->dob ?? "";
        $data['phone'] = $request->phone ?? "";
        $data['gender'] = $request->gender ?? 1;
        $data['password'] = $request->password ?? "";
        $data['created_by'] = $request->created_by ?? 1;
        $data['updated_by'] = $request->updated_by ?? 1;
        $data['deleted_by'] = $request->deleted_by ?? 1;

        $success = ModelsRegistration::create($data);

        if ($success) {
            return response()->json(array(
                'id' => $success->id,
                'status' => 1,
                'message' => 'Registration Save Succefully'
            ));
        } else {
            return response()->json(array(
                'id' => 0, 'status' => 0,
                'message' => 'Registration Failed to save'
            ));
        }
        //
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
        $resgistration = ModelsRegistration::find($id);

        if ($resgistration) {
            $response = [
                'code' => 200,
                'status' => 'success',
                'message' => 'Data available'
            ];

            return response()->json([
                'data' => $resgistration,
                'response' => $response
            ], 200);
        } else {
            $response = [
                'code' => 400,
                'status' => 'success',
                'message' => 'Data Not Found'
            ];

            return response()->json([
                'data' => $resgistration,
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
    public function update(Request $request, $id)
    {
        //
        $registration = ModelsRegistration::find($id);

        if (!$registration) {
            $response = [
                'code' => 400,
                'status' => 'failed',
                'message' => 'Update unsuccessful'
            ];

            return response()->json([
                'response' => $response
            ], 400);
        }

        // if (!isset($request->email)) {
        //     return response()->json(array(
        //         'code' => 409,
        //         'status' => 0,
        //         'message' => 'E-Mail Cannot be empty'
        //     ));
        // }

        // if ($request->email != null) {
        //     $reg = ModelsRegistration::where('email', $request->email)->first();
        //     if ($reg) {
        //         return response()->json(array(
        //             'code' => 409,
        //             'status' => 0,
        //             'message' => 'This email has been taken. Please try another one.'
        //         ));
        //     }
        // }

        $registration->name = $request->name ?? $registration->name;
        $registration->email = $request->email ?? $registration->email;
        $registration->phone = $request->phone ?? $registration->phone;
        $registration->gender = $request->gender ?? $registration->gender;
        $registration->dob = $request->dob ?? $registration->dob;
        $registration->updated_by = 1;
        $registration->save();

        $response = [
            'code' => 200,
            'status' => 'success',
            'message' => 'Update Successful'
        ];

        return response()->json([
            'data' => $registration,
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
        $posts =  Stories::where('user_id', $id)->get();
        foreach ($posts as $child) {
            $child->delete();
        }
        // return $posts;
        $registration = ModelsRegistration::find($id)->delete();


        if (!$registration) {
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
}
