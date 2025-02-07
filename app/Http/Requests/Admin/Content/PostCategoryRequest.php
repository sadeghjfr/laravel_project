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
                'name' => 'required|max:128|min:2',
                'description' => 'nullable',
                'slug' => 'nullable',
                'image' => 'nullable',
                'tags' => 'nullable',
                'parent_id' => 'nullable',
                'status' => 'required|numeric|in:0,1',
            ];


    }
}
