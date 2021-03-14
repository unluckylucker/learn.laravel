<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
            'code'=>'required|min:3|max:255',
            'name'=>'required|min:3|max:255',
            'description'=>'required|min:3',
            'pricee'=>'required|numeric|min:1'
        ];
    }

    public function messages()
    {
        return [
            'required'=> 'Поле :attribute обязательно для заполнения',
            'min'=>'Поле :attribute должно иметь минимум :min символа',
            'code.min' => 'Поле код должно содержать минимум :min символа',
            'pricee.min' => 'Поле цена должна равняться минимум :min рублей'
        ];
    }
}
