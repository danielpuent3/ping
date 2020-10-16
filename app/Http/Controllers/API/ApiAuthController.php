<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenticationRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Resources\ActiveUserResource;
use App\Models\User;
use App\Traits\ResolvesCurrentWorkspace;
use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    use ResolvesCurrentWorkspace;

    /**
     * @param AuthenticationRequest $request
     * @return ActiveUserResource
     */
    public function authenticate(AuthenticationRequest $request)
    {
        $user = $request->user();

        $token = $user->createToken('authorization');

        //TODO throw error if user tries to "authenticate" into workspace that doesn't exist or they don't own
        $this->resolveCurrentWorkspace($request->user(), $request->input('workspace_name'));

        return ActiveUserResource::make($user->fresh('current_workspace'), $token->plainTextToken);
    }

    /**
     * @param AuthRegisterRequest $request
     * @return ActiveUserResource
     */
    public function register(AuthRegisterRequest $request)
    {
        $user = User::create($request->validated());

        return ActiveUserResource::make($user);
    }
}
