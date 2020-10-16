<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenticationRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Resources\ActiveUserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Validation\UnauthorizedException;

class ApiAuthController extends Controller
{

    /**
     * @param AuthenticationRequest $request
     * @return ActiveUserResource
     */
    public function authenticate(AuthenticationRequest $request)
    {
        $user = $request->user();

        $token = $user->createToken('authorization');

        return ActiveUserResource::make($user, $token->plainTextToken);
    }

    /**
     * @param AuthRegisterRequest $request
     */
    public function register(AuthRegisterRequest $request)
    {
        $user = User::create($request->validated());

        return ActiveUserResource::make($user);
    }
}
