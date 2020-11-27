<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
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
    public function login(Request $request) {
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = Auth::attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
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
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'age' => 'required|numeric',
            'city' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        DB::beginTransaction();
        
        try {
            User::create(array_merge($validator->validated(), ['password' => bcrypt($request->password)]));
            $token = Auth::attempt($validator->validated());

            DB::commit();
            return $this->createNewToken($token);
        } catch (\Exception $e) {
            DB::rollBack();
            //return error message
            return response()->json(['message' => 'User registration failed!'], 500);
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
    public function logout() {
        Auth::logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(Auth::refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me() {
        return response()->json(auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
