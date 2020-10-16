<?php

namespace App\Http\Requests;

use App\Models\Workspace;
use Illuminate\Foundation\Http\FormRequest;

class WorkspaceRequest extends FormRequest
{
    /**
     * @var Workspace|null
     */
    protected $workspace;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (bool) $this->workspace;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * Prepare data before authorize and validation
     */
    public function prepareForValidation()
    {
        $this->workspace = $this->user()->workspaces()->find($this->route('id'));
    }

    public function workspace()
    {
        return $this->workspace;
    }
}
