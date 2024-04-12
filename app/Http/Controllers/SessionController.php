<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SessionController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email', $email)->first();
        if ($user && Hash::check($password, $user->password)) {
            // Autentikasi berhasil
            return response()->json(['token' => $user->createToken('Token Name')->plainTextToken], 200);
        } else {
            // Autentikasi gagal
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json(['token' => 'contoh-token'], 200);
    }
}
