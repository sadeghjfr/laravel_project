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
                'password' => ['nullable', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised(), 'confirmed'],
                'profile_photo_path' => 'nullable|image|mimes:png,jpg,jpeg,gif,webp|max:1024|dimensions:ratio=1/1,min_width=256,min_height=256',
                'user_type' => 'required|numeric|in:0,1',
            ];
        }

        else {
            return [
                'first_name' => 'nullable|max:120|min:2',
                'last_name' => 'nullable|max:120|min:2',
                'profile_photo_path' => 'nullable|image|mimes:png,jpg,jpeg,gif,webp|max:1024|dimensions:ratio=1/1,min_width=256,min_height=256',
                'user_type' => 'required|numeric|in:0,1',
            ];
        }
    }

    public function messages()
    {
        return [
            'profile_photo_path.dimensions' => 'ابعاد تصویر باید حداقل ۲۵۶ * ۲۵۶ پیکسل باشد و نسبت طول به عرض آن ۱:۱ باشد.'
        ];
    }
}
