<?php

namespace App\Admin\Requests;

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
        return [
            'title'      => 'required',
            'cate_id'    => 'required',
            'descr'      => 'required|max:100',
            'num'        => 'numeric',
            'price'      => 'required|numeric',
            'sale_price' => 'numeric',
            'content'    => 'required',

        ];
    }

    public function messages()
    {
        return [
            'title.required'     => '商品名不能为空',
            'cate_id.required'   => '商品分类不能为空',
            'descr.required'     => '描述不能为空',
            'descr.max:100'      => '描述不能大于100字',
            'num.numeric'        => '库存必须是数值',
            'price.required'     => '价格不能为空',
            'price.numeric'      => '价格必须是数值',
            'sale_price.numeric' => '促销价格必须是数值',
            'content.required'   => '商品详情不能为空',
        ];
    }
}
