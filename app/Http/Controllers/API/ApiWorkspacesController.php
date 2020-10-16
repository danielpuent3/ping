<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkspaceRequest;
use App\Http\Resources\WorkspaceResource;
use Illuminate\Http\Request;

class ApiWorkspacesController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $workspaces = $request->user()->workspaces;

        return WorkspaceResource::collection($workspaces);
    }

    /**
     * @param StoreWorkspaceRequest $request
     * @return WorkspaceResource
     */
    public function store(StoreWorkspaceRequest $request)
    {
        $workspace = $request->user()->owned_workspaces()->create($request->validated());

        $workspace->users()->syncWithoutDetaching($request->user());

        return WorkspaceResource::make($workspace->fresh('creator'));
    }
}
