<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class MeUpdateRequest extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'string|nullable',
            'email' => 'required|email',
            'password' => 'sometimes|string|min:6|max:20|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/'
        ];
    }
}
