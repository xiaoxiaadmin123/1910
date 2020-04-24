<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    // cookie
    public function setcookie(){
      
        // 响应  设置cookie  第一种
        return response("设置 cookie")->cookie('name','小七',1);
   
        // 响应  设置cookie  第二种
        // Cookie::queue(Cookie::make('age', '100', 1));

        // 响应  设置cookie  第三种
        // Cookie::queue('num', '190', 1);

    }

     // cookie
     public function getcookie(){

        // 获取cookie第一种
        echo request()->cookie('name');
        
        // 获取cookie第二种
        echo  Cookie::get('name');

    }



    public  function index(){
    	return view("index",['name'=>"小七"]);
    }
    public function doadd(){
    	$post = request()->all();
    	dd($post);
    }

    //必选参数 
    public function goods($id,$name){
        echo $id;
        echo $name;
    }
    public function qi($id){
        echo "单个：".$id;
    }
   
    // 可选参数
    public function show($id=0){
        echo "可选：".$id;
    }

    // 混合参数  
    public function hidden($id,$name=null){
        echo $id;
        dd($name) ;
    }
}
