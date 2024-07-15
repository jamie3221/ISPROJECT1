<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerLoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }
    public function messages()
{
    return [
        'email.required' => 'Email is required!',
        'email.email' => 'Please provide a valid email address.',
        'password.required' => 'Password is required!',
    ];
}

}
