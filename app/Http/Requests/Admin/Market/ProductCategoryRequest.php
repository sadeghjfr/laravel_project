<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
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
            'image' => 'image|mimes:png,jpg,jpeg,gif,webp|max:1024|dimensions:ratio=1/1,min_width=256,min_height=256',
            'status' => 'required|numeric|in:0,1',
            'tags' => 'nullable',
            'parent_id' => 'nullable|exists:product_categories,id',
            'show_in_menu' => 'required|numeric|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'image.dimensions' => 'ابعاد تصویر باید حداقل ۲۵۶ * ۲۵۶ پیکسل باشد و نسبت طول به عرض آن ۱:۱ باشد.'
        ];
    }
}
