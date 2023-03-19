<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'source' => ['sometimes'],
            'subject' => ['required', 'string', 'min:3', 'max:199'],
            'status_id' => ['required', 'integer', 'min:1'],
            'type_id' => ['required', 'integer', 'min:1'],
            'customer_id' => ['required', 'integer', 'min:1'],
            'priority_id' => ['sometimes'],
            'staff_id' => ['sometimes'],
            'team_id' => ['sometimes'],
            'created_at' => ['required'],
            'updated_at' => ['sometimes'],
        ];
    }
}
