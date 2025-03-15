<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            ? 'required|image|mimes:png,jpg,jpeg,gif,webp|max:1024|dimensions:width=1200,height=760'
            : 'image|mimes:png,jpg,jpeg,gif,webp|max:1024|dimensions:width=1200,height=760';


            return [
                'title' => 'required|max:120|min:2',
                'summary' => 'required|max:1024|min:5',
                'category_id' => 'required|exists:post_categories,id',
                'image' => $image,
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required',
                'body' => 'required|min:5',
                'published_at' => 'required|numeric',

            ];

    }

    public function messages()
    {
        return [
            'image.dimensions' => 'ابعاد تصویر باید ۷۶۰ * ۱۲۰۰ پیکسل باشد.'
        ];
    }
}
