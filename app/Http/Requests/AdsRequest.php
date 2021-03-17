<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdsRequest extends FormRequest
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
            'country_id' => 'required',
            'category_id' => 'required',
            'title' => 'required', 
            'text' => 'required',
            'price' => 'required|numeric',
            'currency_id' => 'required',
            'images' => 'required_without:id',
        ];
    }
    public function messages()
    {
        return [
            'country_id.required' => 'يجب تحديد الدولة',
            'category_id.required' => 'يجب تحديد القسم',
            'title.required' => 'يجب تحديد العنوان',
            'price.required' => 'يجب تحديد السعر  ',
            'currency_id.required' => 'يجب تحديد العملة',
            'text.required' => 'تفاصيل الاعلان مطلوبة',
            'images.required_without' => 'يجب ادخال صورة أو أكثر للاعلان',

            
        ];
    }
}
