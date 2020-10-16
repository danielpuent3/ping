<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkspaceResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);

        $data['creator'] = CreatorResource::make($this->whenLoaded('creator'));
        $data['users'] = CreatorResource::collection($this->whenLoaded('users'));

        return $data;
    }
}
