<?php

namespace App\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'title' =>'required|unique:shop_category',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '菜单名不能为空',
            'title.unique' => '菜单名已经存在',
        ];
    }
}
