<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'code' => 'required|max:120|min:1',
            'amount_type' => 'required|in:0,1',
            'amount' => [(request()->amount_type == 0) ? 'max:100' : '', 'numeric', 'required'],
            'discount_ceiling' => 'required|numeric',
            'type' => 'required|numeric|in:0,1',
            'status' => 'required|numeric|in:0,1',
            'start_date' => 'required|numeric',
            'end_date' => 'required|numeric',
            'user_id' => 'required_if:type,==,1|exists:users,id',
        ];
    }

    public function attributes()
    {
        return [
            'amount' => 'میزان تخفیف',
            'type' => 'نوع کوپن',
        ];
    }

    public function messages()
    {
        return [
            'required_if' => 'هنگامی که :other خصوصی باشد، فیلد :attribute الزامی است.',
        ];
    }
}
