<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Cate;
use Illuminate\Support\Facades\Cache; //缓存门面
use Illuminate\Support\Facades\Redis; //Redis数据库门面
class IndexController extends Controller
{
    public function index(){
        // ----》使用cache门面
        //缓存  ，先检查memcache内是否有数据 有直接返回 
        // $slide = Cache::get('slide');
        // ---》使用redis门面
        // 数据库redis
        $slide =  Redis::get('slide');
        // dd($slide);
        //====使用全局辅助函数
        $slide = cache('slide');
        dump($slide);
        if(!$slide){
            // echo "DB==";
            // / ----》使用cache门面
             $slide = Goods::getIndexSlide(); //缓存
            //  dd($slide);
            //  Cache::put('slide',$slide,60);
            // ---》使用redis门面
            // $slide = serialize($slide); //redis
            // Redis::setex('slide',60,$slide);
            // /====使用全局辅助函数
            cache(['slide'=>$slide],60);
        }
        // 首页幻灯片
        // $slide = Goods::getIndexSlide();
        // $cate = Cate::select('cate_name','cate_id');
        // dd($cate);
        // $slide = unserialize($slide);
        return view('index.index',['slide'=>$slide]);
    }
}
