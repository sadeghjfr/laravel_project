<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            ? 'required|image|mimes:png,jpg,jpeg,gif,webp|max:2048'
            : 'image|mimes:png,jpg,jpeg,gif,webp|max:2048';

        return [
            'title' => 'required|max:120|min:2',
            'url' => 'required|max:500|min:2',
            'status' => 'required|numeric|in:0,1',
            'position' => 'required|numeric',
            'image' => $image,
        ];

    }

}
