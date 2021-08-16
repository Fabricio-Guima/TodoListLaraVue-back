<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthResetPasswordRequest extends FormRequest
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


        //password aqui é a nova senha
        return [
            'email'    => 'required|email',
            'password' => 'required|string|max:30|min:6|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/',
            'token'    => 'required|string',
            
        ];
    }
}
