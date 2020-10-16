<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Resources\ActiveUserResource;
use App\Models\User;

class ApiAuthController extends Controller
{

    /**
     * @param AuthRegisterRequest $request
     */
    public function register(AuthRegisterRequest $request)
    {
        $user = User::create($request->validated());

        return ActiveUserResource::make($user);
    }
}
