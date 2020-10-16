<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChannelRequest;
use App\Http\Resources\ChannelResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ApiChannelsController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $workspace = $request->user()->current_workspace;

        //TODO paginate
        $channels = $request->user()->channels()->where('workspace_id', $workspace->id)->get();

        return ChannelResource::collection($channels);
    }

    /**
     * @param StoreChannelRequest $request
     * @return ChannelResource
     */
    public function store(StoreChannelRequest $request)
    {
        $channel = $request->workspace()->channels()->create($request->validated());

        $channel->users()->syncWithoutDetaching($request->user());

        return ChannelResource::make($channel);
    }
}
