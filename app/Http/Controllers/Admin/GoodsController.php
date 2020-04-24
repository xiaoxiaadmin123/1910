<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Brand;
use App\Cate;
use DB;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *商品展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 设置session
        // request()->session()->put('name','xiaoxia');
        // session(['age'=>19]);

        // // 获取
        // // echo request()->session()->get('name');
        // // echo session('age');

        // // 删除
        // request()->session()->forget('name');
        // session(['name'=>null]);

        // 取所有值
        // dump(request()->session()->all());

        // 删除所有
        // dump(request()->session()->flush());
      
        // 判断session有没有name
        // dump(request()->session()->has('name'));


        $goods_name = request()->goods_name;
        $where = [];
        if($goods_name){
            $where[] = ['goods_name','like',"%$goods_name%"];
        }
        $cate_id = request()->cate_id;
        if($cate_id){
            $where[] = ['goods.cate_id',$cate_id];
        }
        $brand_id = request()->brand_id;
        if($brand_id){
            $where[] = ['goods.brand_id',$brand_id];
        }
         // 查询Brand表的名称
         $brand = Brand::all();
         // dd($brand);
         // 调用无限极分类
         $cate = Cate::all();
         // dd($cate);
         // careteTree($cate);
         $cate = careteTree($cate);

        // DB::connection()->enableQueryLog();
        
        // dd($goods);
        $cate = careteTree($cate);
        // dd($cate);
        $pagesize = config('app.pageSize');
        $goods = Goods::select('goods.*','category.cate_name','brand.brand_name')
                ->leftjoin('category','goods.cate_id','=','category.cate_id')
                ->leftjoin('brand','goods.brand_id','=','brand.brand_id')
                ->where($where)
                ->paginate($pagesize);
                // dd($goods);
        // $logs = DB::getQueryLog();
        // dump($logs);
        // 无刷新分页
        // 判断是否是ajax请求
       
    //    dump(request()->ajax());
        if(request()->ajax()){
            return view('admin.goods.ajaxindex',['cate'=>$cate,'goods'=>$goods,'brand'=>$brand]);
        }
        return view('admin.goods.index',['cate'=>$cate,'goods'=>$goods,'brand'=>$brand]);
    }

    /**
     * Show the form for creating a new resource.
     *商品添加视图
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 查询Brand表的名称
        $brand = Brand::all();
        // 调用无限极分类
        $cate = Cate::all();
        // dd($cate);
        // careteTree($cate);
        // 调用无限极分类
        $cate = careteTree($cate);
        // dd($cate);
        return view('admin.goods.create',['brand'=>$brand,'cate'=>$cate]);
    }


   
    /**
     * Store a newly created resource in storage.
     *执行商品添加StoreGoodsPost
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(StoreGoodsPost $request)
    public function store(Request $request)
    {
        // 排除接收**数据
        $post = request()->except(['_token','/goods/store']);
        // dd($post);
        // 文件上传判断
        if (request()->hasFile('goods_img')){
            $post['goods_img'] = upload('goods_img');
        };
        // 商品相册
        if (isset($post['goods_imgs'])){
          $imgs = MoreUpload('goods_imgs');
          $post['goods_imgs'] = implode('|',$imgs);
            
        };
        // dd($post);
          // 添加  方法---2   
          $res = Goods::create($post);
            // dd($res);
          if($res){
              return redirect('/goods');
          }
    
    }

    

    /**
     * Display the specified resource.
     *预览详情页
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *修改视图
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 查询一条数据
        $goods = Goods::find($id);
        $brand = Brand::all();
        // dd($brand);
        $cate = Cate::all();
        // dd($cate);
        // 调用无限极分类
        $cate = careteTree($cate);
        // dd($cate);
        return view('admin.goods.edit',['brand'=>$brand,'cate'=>$cate,'goods'=>$goods]);

    }

    /**
     * Update the specified resource in storage.
     *执行修改
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $post = request()->except(['_token','/goods/update/'.$id]);
        // dd($post);
        if (request()->hasFile('goods_img')){
            $post['goods_img'] = upload('goods_img');
        };
        // 商品相册
        if (isset($post['goods_imgs'])){
          $imgs = MoreUpload('goods_imgs');
          $post['goods_imgs'] = implode('|',$imgs);
            
        };
        $res = Goods::where('goods_id',$id)->update($post); 
        if($res!==false){
            return redirect('/goods');
        }
    }

    /**
     * Remove the specified resource from storage.
     *执行删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //  //删除图片
        //  $goods_img = DB::table('goods')->where('goods_id', $id)->value('goods_img');
        // //  $goods_imgs = DB::table('goods')->where('goods_id', $id)->value('goods_imgs');
        // //  dd($goods_img);
        // //  dd($goods_imgs);
        //  if($goods_img){
        //      unlink(storage_path('app/'.$goods_img));
        //  }
        
      
        //  $res = DB::table('goods')->where('goods_id', $id)->delete();
        //  // +++ORM删除 ++
         $res = Goods::destroy($id);
        //  dd($res);
         if($res){
             return redirect('/goods');
         }
    
    }
}
