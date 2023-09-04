<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserInfoRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'firstName' => 'required|max:10',
            'lastName' => 'required|max:10',
            'email' => ['required', 'unique:users,email'],
            'password' => 'required|confirmed|min:3',
            'gender' => 'required',
            'image' => 'image',
        ];
    }

    public function messages(){
        //sample of a custom error message (you can also change error message on lang/xx/validation.php)
        return [
            'email.unique' => 'The :attribute :input is already taken',
        ];
    }
}
