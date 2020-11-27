<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

     /**
     * @OA\Post(
     *     path="/auth/login",
     *     tags={"Authentication"},
     *     summary="Login to user account",
     *     description="Login to user account",
     *     operationId="login",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Login success",
     *          @OA\JsonContent(ref="#/components/schemas/Auth")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
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
    public function login(Request $request) 
    {
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'messages' => $validator->errors()
            ], 400);
        }

        if (!$token = Auth::attempt($validator->validated())) {
            return response()->json([
                'status' => 401,
                'message' => 'Email belum terdaftar'
            ], 401);
        }

        return $this->createNewToken($token);
    }

    /**
     * @OA\Post(
     *     path="/auth/register",
     *     tags={"Authentication"},
     *     summary="Register new account",
     *     description="Register new account",
     *     operationId="register",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Register success",
     *          @OA\JsonContent(ref="#/components/schemas/Auth")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
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
    public function register(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'age' => 'required|numeric',
            'city' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'messages' => $validator->errors()
            ], 400);
        }

        DB::beginTransaction();
        
        try {
            User::create(array_merge($validator->validated(), ['password' => bcrypt($request->password)]));
            $token = Auth::attempt($validator->validated());

            DB::commit();
            return $this->createNewToken($token);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error'
            ], 500);
        }
    }


    /**
     * @OA\Post(
     *     path="/auth/logout",
     *     tags={"Authentication"},
     *     summary="Logout auth session",
     *     description="Logout auth session",
     *     operationId="logout",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *          response=200,
     *          description="User successfully signed out"
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
    public function logout() 
    {
        Auth::logout();
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil log out'
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/auth/refresh",
     *     tags={"Authentication"},
     *     summary="Refresh JWT token",
     *     description="Refresh JWT token",
     *     operationId="refresh",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *          response=200,
     *          description="Refresh token success",
     *          @OA\JsonContent(ref="#/components/schemas/Auth")
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
    public function refresh() 
    {
        return $this->createNewToken(Auth::refresh());
    }

    /**
     * @OA\Get(
     *     path="/auth/me",
     *     tags={"Authentication"},
     *     summary="Get authenticated's user data",
     *     description="Get authenticated's user data",
     *     operationId="me",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *          response=200,
     *          description="User data",
     *          @OA\JsonContent(ref="#/components/schemas/User")
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
    public function me() 
    {
        return response()->json([
            'status' => 200,
            'data' => auth()->user()
        ], 200);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token) 
    {
        return response()->json([
            'status' => 200,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'data' => auth()->user()
        ]);
    }
}
