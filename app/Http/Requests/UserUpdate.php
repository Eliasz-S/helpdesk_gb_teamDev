<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:64'], 
            'email' => ['required', 'email'],
            'first_name' => ['sometimes'],
            'last_name' => ['sometimes'],
            'user_role_id' => ['required', 'integer', 'min:1']
        ];
    }
}
