<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class PostCategoryRequest extends FormRequest
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
            'name' => 'required|max:120|min:2',
            'description' => 'nullable|max:500|min:2',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif,webp|max:1024|dimensions:ratio=1/1,min_width=256,min_height=256',
            'status' => 'required|numeric|in:0,1',
            'tags' => 'nullable|min:1',
            'parent_id' => 'nullable|exists:post_categories,id',
        ];

    }

    public function messages()
    {
        return [
            'image.dimensions' => 'ابعاد تصویر باید حداقل ۲۵۶ * ۲۵۶ پیکسل باشد و نسبت طول به عرض آن ۱:۱ باشد.'
        ];
    }
}
