<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/users/1",
     *     tags={"User"},
     *     summary="Get user detail",
     *     description="Get user detail",
     *     operationId="user/id",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *          response=200,
     *          description="User data",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Data not found",
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Method not allowed (Unauthenticated)",
     *     ),
     *     @OA\Response(
     *        response=500,
     *        description="Internal server error"
     *     )
     * )
     */
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
