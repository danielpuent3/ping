<?php

namespace App\Http\Requests;

use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthRegisterRequest extends FormRequest
{

    use PasswordValidationRules;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('users', 'email'),
                'email:filter'
            ],
            'password' => $this->passwordRules(),
        ];
    }

    /**
     * @return array
     */
    public function validated(): array
    {
        return array_merge(parent::validated(), [
            'password' => Hash::make($this->input('password')),
        ]);
    }
}
