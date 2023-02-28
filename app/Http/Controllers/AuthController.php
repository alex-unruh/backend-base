<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Athenticatoion management class
 */
class AuthController extends Controller
{

    /**
     * Authenticates user with basic auth
     *
     * @param Request $request
     * @return Response
     */
    public function login(Request $request): Response
    {
        $response = $this->makeResponse($request);
        return response($response);
    }

    /**
     * Delete the actual user token
     *
     * @param Request $request
     * @return Response
     */
    public function logout(Request $request): Response
    {
        $request->user()->currentAccessToken()->delete();
        return response(["message" => __('msg.logout')]);
    }

    /**
     * Delete all user tokens
     *
     * @param Request $request
     * @return Response
     */
    public function fullLogout(Request $request): Response
    {
        $request->user()->tokens()->delete();
        return response(["message" => __('msg.logout')]);
    }

    /**
     * Refresh the actual token
     *
     * @param Request $request
     * @return Response
     */
    public function refreshToken(Request $request): Response
    {
        $response = $this->makeResponse($request);
        return response($response);
    }

    /**
     * Make the same response to login and refreshToken methods
     *
     * @param Request $request
     * @return array
     */
    private function makeResponse(Request $request): array
    {
        $token = $request->user()->createToken('app');
        $response = [
            'message' => __('msg.login'),
            'token' => $token->plainTextToken,
            'expires_in_minutes' => config('sanctum.expiration'),
            'user' => $request->user()
        ];

        return $response;
    }
}
