<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
        $image = $this->isMethod('post')
            ? 'required|image|mimes:png,jpg,jpeg,gif|max:2048'
            : 'image|mimes:png,jpg,jpeg,gif|max:2048';

        return [
            'persian_name' => 'required|max:120|min:1',
            'original_name' => 'required|max:120|min:1',
            'logo' => $image,
            'status' => 'required|numeric|in:0,1',
        ];
    }
}
