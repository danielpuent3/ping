<?php

namespace App\Http\Requests;

use App\Models\Workspace;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreChannelRequest extends FormRequest
{
    /**
     * @var mixed
     */
    protected $workspace;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function validated()
    {
        $data = parent::validated();
        $data['creator_id'] = $this->user()->id;

        return $data;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('channels', 'name')->where(function ($query) {
                    return $query->where('workspace_id', $this->workspace->id);
                })
            ],
            'description' => 'string',
        ];
    }

    /**
     *
     */
    public function prepareForValidation()
    {
        $this->workspace = $this->user()->current_workspace;
    }

    /**
     * @return Workspace
     */
    public function workspace()
    {
        return $this->workspace;
    }
}
