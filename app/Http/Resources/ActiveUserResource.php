<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActiveUserResource extends JsonResource
{

    /**
     * @var null|string
     */
    protected $token;

    /**
     * ActiveUserResource constructor.
     *
     * @param $resource
     * @param null $token
     */
    public function __construct($resource, $token = null)
    {
        $this->token = $token;
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);

        $data['authorization_token'] = $this->token;
        $data['current_workspace'] = WorkspaceResource::make($this->whenLoaded('current_workspace'));

        return $data;
    }
}
