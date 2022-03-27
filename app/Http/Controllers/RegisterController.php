<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function register(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:users', 'max:255'],
            'password' => ['required', 'min:6']
        ]);
        $data =  [
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];
        $user = User::create($data);
        if (!$user) {
            return response([
                'message' => ['Something is wrong.']
            ], 500);
        }
        $response = [
            'user' => $user,
        ];
        return response($response, 201);
    }
}
