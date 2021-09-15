<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketCreate extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:191'],
            'email' => ['required', 'string', 'email'],
            'type_id' => ['required'],
            'priority_id' => ['required'],
            'subject' => ['required', 'string', 'min:3', 'max:191'],
            'message' => ['required', 'string', 'min:3'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле Имя является обязательным',
            'email.required' => 'Поле Email является обязательным',
            'subject.required' => 'Поле Тема является обязательным',
            'message.required' => 'Поле Сообщение является обязательным',

            'type_id.integer' => 'Не выбрана категория заявки!',
        ];
    }
}
