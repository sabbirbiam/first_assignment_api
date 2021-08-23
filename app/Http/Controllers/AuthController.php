<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Auth;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        // return $request;
        $credentials = $request->only('email', 'password');
        // return $credentials;
        // $token = "";
        $jwtToken =JWTAuth::attempt($credentials);
        // return $jwtToken;
        // try {
        //     if (!$token = JWTAuth::attempt($credentials)) {
        //         return response()->json(['error' => 'invalid_credentials'], 400);
        //     }
        // } catch (JWTException $e) {
        //     return response()->json(['error' => 'could_not_create_token'], 500);
        // }

        JWTAuth::setToken($jwtToken);
        // var_dump($token);

        // $jwtToken = Auth::user();

        if (!$jwtToken) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }

        return $this->respondWithToken($jwtToken);


        // return response()->json(compact('token'));
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 50000 * 60,
            'user' => Auth::user()
        ]);
    }

    public function register(Request $request)
    {
        // return 300;
        // return $request;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'type' => $request->get('type') ?? "user",
            'username' => $request->get('username'),
            'phone' => $request->get('phone') ?? null,
            'dob' => $request->get('dob') ?? null,
            'status' => 1,
            'deleted_at' => 1,
            // 'password' => $request->get('password'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);
        // $token = auth()->login($user);

        return response()->json(compact('user', 'token'), 200);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());
        }

        return response()->json(compact('user'));
    }
}
