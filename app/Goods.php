<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    // 指定表名
    protected $table = "goods";
    // 指定主键
    protected $primaryKey = "goods_id";
    // 关闭时间戳
    public $timestamps =  false;
     // 黑名单 所有都允许添加
    protected $guarded = [];

    // 获取商品列表数据
    public static function getGoods($where,$pageSize){
        $goods = left::select('goods.*','category.cate_name','brand.brand_name')
        ->leftjoin('category','goods.cate_id','=','category.cate_id')
        ->leftjoin('brand','goods.brand_id','=','brand.brand_id')
        ->where($where)
        ->paginate($pagesize);
        return $goods;
    }

    // 获取首页幻灯片数据
    public static function getIndexSlide(){
        return Goods::select('goods_id','goods_img','goods_price','goods_name','cate_id')->where('is_slide',1)->take(5)->get();
    }



}
