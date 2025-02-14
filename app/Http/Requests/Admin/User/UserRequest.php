<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        if ($this->isMethod('post')) {

            return [
                'first_name' => 'nullable|max:120|min:2',
                'last_name' => 'nullable|max:120|min:2',
                'mobile' => ['required', 'digits:11', 'unique:users'],
                'email' => ['nullable', 'string', 'email', 'unique:users'],
                'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised(), 'confirmed'],
                'image' => 'nullable|image|mimes:png,jpg,jpeg,gif',
                'activation' => 'required|numeric|in:0,1',
                'user_type' => 'required|numeric|in:0,1',
            ];
        }

        else {
            return [
                'first_name' => 'nullable|max:120|min:2',
                'last_name' => 'nullable|max:120|min:2',
                'image' => 'nullable|image|mimes:png,jpg,jpeg,gif',
                'user_type' => 'required|numeric|in:0,1',
            ];
        }
    }
}
