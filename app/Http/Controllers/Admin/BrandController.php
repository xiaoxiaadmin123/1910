<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Brand;
use App\Http\Requests\StoreBrandPost;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示页面
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 接收搜索条件
        $brand_name = request()->brand_name;
        $brand_url = request()->brand_url;
        $where = [];
        if($brand_name){
            $where[] = ['brand_name','like',"%$brand_name%"];
        }
        if($brand_url){
            $where[] = ['brand_url','like',"%$brand_url%"];
        }
        // $brand = DB::table('brand')->get();
        //   ---ORM操作
        // $brand =  Brand::all();
        $pageSize = config('app.pageSize');
        $brand =  Brand::orderby('brand_id','desc')->where($where)->paginate($pageSize);
        return view('admin.brand.index',['brand'=>$brand,'brand_name'=>$brand_name,'brand_url'=>$brand_url]);
    
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加方法
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)

    // 第二种表单验证
    public function store(StoreBrandPost $requesr)
    {
        // // 第一种验证
        // $request->validate([
        //     'brand_name' => 'required|unique:brand|max:20',
        //     'brand_url' => 'required',
        // ],[
        //     'brand_name.required' => '品牌名称必填!',
        //     'brand_name.unique' => '品牌名称已存在!',
        //     'brand_name.max' => '品牌名称最大长度为20位!',
        //     'brand_url.required' => '品牌网址必填',
        // ]);

        // 获取所有值
        // $post = $request->all();
        // $post = request()->all();
        // $post = request()->input();
        // 接收post的值
        // $post = request()->post();
        // 排除接收***
        $post = request()->except(['_token','/brand/store']);
        // dd($post);
        // dump($request->hasFile('brand_logo'));die;
        // 只接收***
        // $post = request()->only('_token','brand_logo');
        // dd($post);
            // 接单个值
            // $brand_name = request()->brand_name;
        // 文件上传
        if (request()->hasFile('brand_logo')){
            $post['brand_logo'] = $this->upload('brand_logo');
        };

        // $res = DB::table('brand')->insert($post);

        //+++++ ORM操作+++++
        // 添加 方法---1--- 。 save()
        // $brand = new Brand;
        // $brand->brand_name = $post['brand_name'];
        // $brand->brand_url = $post['brand_url'];
        //   if(isset($post['brand_logo'])){
        //     $brand->brand_logo = $post['brand_logo'];
        // } 
        // $brand->brand_desc = $post['brand_desc'];
        // $res = $brand->save();
        // 添加  方法---2   
        $res = Brand::create($post);
        // 添加  方法---3
        //  $res = Brand::insert($post);
        if($res){
            return redirect('/brand');
        }
        
    }

    public function upload($filename){

        if (request()->file($filename)->isValid()){
            // 接收文件
            $file = request()->$filename;
            // 实现上传
            $path = $file->store('uploads');
            return $path;
        }
        exit("上传文件出错！");
    }

    /**
     * Display the specified resource.
     *预览详情页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *编辑展示页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 根据id获取当前记录信息
        // $brand = DB::table('brand')->where('brand_id', $id)->first();
        // +++ORM操作+++
        $brand = Brand::find($id);
        return view('admin.brand.edit',['brand'=>$brand]);
    }

    /**
     * Update the specified resource in storage.
     *执行更新编辑
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 图片
        $post  = $request->except('_token','/brand/update/'.$id);
        if ($request->hasFile('brand_logo')){
            $post['brand_logo'] = $this->upload('brand_logo');
        };
        // 根据id进行更新
        // $res = DB::table('brand')->where('brand_id', $id)->update($post);
        // +++ORM操作++
        // 编辑 方法---1--- 。 save()
        // $brand = Brand::find($id);
        // $brand->brand_name = $post['brand_name'];
        // $brand->brand_url = $post['brand_url'];
        // if(isset($post['brand_logo'])){
        //     $brand->brand_logo = $post['brand_logo'];
        // } 
        // $brand->brand_desc = $post['brand_desc'];
        // $res = $brand->save();
        //方法 ---2--
        $res = Brand::where('brand_id',$id)->update($post); 

        if($res!==false){
            return redirect('/brand');
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除方法
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除图片
        $brand_logo = DB::table('brand')->where('brand_id', $id)->value('brand_logo');
        if($brand_logo){
            unlink(storage_path('app/'.$brand_logo));
        }
    
        // $res = DB::table('brand')->where('brand_id', $id)->delete();
        // +++ORM删除 ++
        $res = Brand::destroy($id);
        
        if($res){
            return redirect('/brand');
        }
    }
}
