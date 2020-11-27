<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::pimp()->find($id);
        if (!$user) {
            return response()->json([
                'status' => 200,
                'message' => "Pengguna tidak ditemukan"
            ], 404);    
        }

        return response()->json([
            'status' => 200,
            'data' => $user
        ], 200);
    }
}
