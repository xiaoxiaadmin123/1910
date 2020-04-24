<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGoodsPost extends FormRequest
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
            'goods_name' => 'required|unique:goods|max:2-50',
            'brand_id' => 'required',
            'cate_id' => 'required',
            'goods_num' => 'required',
            'goods_price' => 'required',
        ];
    }

    public function messages(){
        return [
           'goods_name.required' => '商品名称必填!',
            'goods_name.unique' => '商品名称已存在!',
            'goods_name.max' => '商品名称最大长度为50位!',
            'brand_id.required' => '商品品牌必填',
            'cate_id.required' => '商品分类必填',
            'goods_num.required' => '商品库存必填',
            'goods_price.required' => '商品价格必填',
        ];
    }
}
