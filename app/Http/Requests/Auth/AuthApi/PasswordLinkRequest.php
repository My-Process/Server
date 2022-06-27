<?php

namespace App\Http\Requests\Auth\AuthApi;

use Illuminate\Foundation\Http\FormRequest;

class PasswordLinkRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
        ];
    }
}