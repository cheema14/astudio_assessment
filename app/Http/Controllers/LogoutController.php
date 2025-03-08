<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        $user = $request->user();

        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out',
        ], 200);
    }
}
