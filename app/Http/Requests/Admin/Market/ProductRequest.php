<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            ? 'required|image|mimes:png,jpg,jpeg,gif'
            : 'image|mimes:png,jpg,jpeg,gif';


        return [
            'name' => 'required|max:120|min:1',
            'introduction' => 'required|min:1',
            'image' => $image,
            'weight' => 'nullable|numeric|min:0',
            'length' => 'nullable|numeric|min:0',
            'width'  => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'status' => 'required|numeric|in:0,1',
            'marketable' => 'required|numeric|in:0,1',
            'tags' => 'required',
            'brand_id' => 'nullable|exists:brands,id',
            'category_id' => 'required|exists:product_categories,id',
            'published_at' => 'required|numeric',
        ];
    }
}
