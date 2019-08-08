<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Mgacom\Users\Resources\AuthUser as AuthUserResource;
use Mgacom\Users\Resources\User as UserResource;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{

    protected $jwt;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if ( ! $token = auth()->attempt($credentials))
            return response()->json(['error' => 'Não autorizado'], 401);

        return (new AuthUserResource($request->user()))->additional([
            'meta' => [
                'token' => $token,
            ],
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        return (new UserResource($request->user()));
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Deslogado com sucesso!']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
