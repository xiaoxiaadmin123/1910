<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Cate;
class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示页面
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 接收搜索值
        $cate_name = request()->cate_name;
        // dd($cate_name);
        $where = [];
        if($cate_name){
            $where[] = ['cate_name',"like","%$cate_name%"];
        }

         //    ---ORM操作
        // $cate =  Cate::orderby('cate_id')->where($where)->all();
        // $cate = Cate::all();
        $cate = Cate::orderby('cate_id')->where($where)->get();
        // dd($cate);
        $cate = $this->careteTree($cate);
        // dd($cate);
        return view('admin.category.index',['cate'=>$cate,'cate_name'=>$cate_name]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate = Cate::all();
    
        // 调用无限极分类
        $cate = $this->careteTree($cate);
        // dd($cate);
        return view('admin.category.create',['cate'=>$cate]);
    }

    public function careteTree($data,$parent_id=0,$level = 1){
        if(!$data){
            return;
        }
        static $newarray = [];
        foreach($data as $v){
            if($v->parent_id==$parent_id){
                $v->level = $level;
                $newarray[] = $v;
                
                $this->careteTree($data,$v->cate_id,$level + 1);
            }
        }

        return  $newarray;

    }

    /**
     * Store a newly created resource in storage.
     *执行添加方法
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 排除接收***
        $post = request()->except(['_token','/cate/store']);
        // dd($post);
        $res = Cate::create($post);
        if($res){
            return redirect('/cate');
        }
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
     *修改视图
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cate = Cate::find($id);
        $cates = Cate::all();
        $cates = $this->careteTree($cates);
        // dd($cate);
        return view('admin.category.edit',['cate'=>$cate,'cates'=>$cates]);
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
        $post = request()->except(['_token','/cate/update/'.$id]);
        // dd($post);
        $res = Cate::where('cate_id',$id)->update($post); 
        if($res!==false){
            return redirect('/cate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         // +++ORM删除 ++
         $res = Cate::destroy($id);
        
         if($res){
             return redirect('/cate');
         }
    }
}
