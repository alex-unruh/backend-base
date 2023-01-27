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
     * Undocumented function
     *
     * @param Request $request
     * @param boolean $is_admin
     * @return Response
     */
    public function login(Request $request): Response
    {
        if ($request->user()->status === 'Inactive') {
            return response(['message' => 'Unauthorized'], 403);
        }
        $token = $request->user()->createToken('app');
        $response = [
            'message' => __('Successfull authenticated'),
            'token' => $token->plainTextToken,
            'expires_in_minutes' => config('sanctum.expiration')
        ];

        return response($response);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response(["message" => "Logout realizado com sucesso"]);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function fullLogout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response(["message" => "Logout realizado com sucesso"]);
    }
}
