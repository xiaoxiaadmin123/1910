<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Cart;
use Illuminate\Support\Facades\Cache; //缓存门面
use Illuminate\Support\Facades\Redis; //Redis数据库门面
class GoodsController extends Controller
{
   public function index($id){
    // 访问量
    $visit = Redis::setnx('visit_'.$id,1)?1:Redis::incr('visit_'.$id);
    dump($visit);
    // 根据id查询值
    $goods = Goods::find($id);
    dump($goods);
    return view('index.goods',['goods'=>$goods,'visit'=>$visit]);

   }

   /*
    * 1--判断用户是否登录
    * 2未登录 跳转到登录页面 登录后返回此商品详情页
    *  
        登录：
        1：判断商品库存是否大于购买数量 如果小于提示库存不足
        判断上下架
        2：判断购物车表内是否有次商品添加记录 有--》购买数量相加
        如果小于 --购买数量等于最大库存  否则更新购物车列表次商品的购买数量
        无  -->添加入库
    *
    */


   public function addcar(){
       $goods_id = request()->goods_id;
       $buy_number  = request()->buy_number;
    //    echo $goods_id.'-'.$buy_number;
        // 具体实现购物车

        $user = session('member');
        if(!$user){
            ShowMsg('00001','未登录');
        }
        // 查询商品信息
        $goods = Goods::select('goods_id','goods_name','goods_img','goods_price','goods_num')->find($goods_id);
        // dd($goods);
        // 判断商品库存是否大于购买数量
        if($goods->goods_num < $buy_number){
            ShowMsg('00002','库存不足');
        }

        // 判断购物车表内是否有此商品
        $where = [
            'user_id'=>$user->member_id,
            'goods_id'=>$goods_id
        ];
        $cart = Cart::where($where)->first();
        // dd($cart);  返回值：null
        if($cart){
            // 更新购买数量
            $buy_number = $cart->buy_number+$buy_number; //购买数量相加
            
            if($goods->goods_num < $buy_number){
                $buy_number = $goods->goods_num;
            }
            // 更新
            $res = Cart::where('cart_id',$cart->cart_id)->update(['buy_number'=>$buy_number]);


        }else{
            // 添加购买数量
            $data = [
                'user_id'=>$user->member_id,
                'buy_number'=>$buy_number,
                'addtime'=>time()
            ];
            
            $data = array_merge($data,$goods->toArray());
            unset($data['goods_num']);
            $res = Cart::create($data);

        }        
        if($res!==false){
            ShowMsg('00000','成功');
        }


   }


}

