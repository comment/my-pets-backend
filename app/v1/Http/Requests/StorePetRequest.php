<?php

namespace App\v1\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StorePetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'identifier' => 'required|string|max:255',
            'nickname' => 'required|string|max:255',
            'about' => 'string|max:255',
            'user_id' => 'required',
            'type_id' => 'required',
            'sub_type_id' => 'required',
        ];
    }
}
