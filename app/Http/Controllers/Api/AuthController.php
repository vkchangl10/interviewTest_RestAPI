<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    /**
     * Register User
     * @param Request $request
     * @return mixed
    */
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => [
                    'required',
                    'string',
                    'min:3'
                ],
                'email' => [
                    'required',
                    'email:dns',
                    Rule::unique('users', 'email')
                ],
                'password' => [
                    'required',
                    'min:6',
                    'max:10',
                    'alpha_num'
                ],
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            return response()->json([
                'status' => true,
                'message' => "Registration success"
            ]);

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

    }


    /**
     * Login User
     * @param Request $request
     * @return mixed
    */
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid email or password.'
            ], 401);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful.',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
            'token' => $token
        ], 200);
    }
}
