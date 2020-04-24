<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use DB;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $admin =  Admin::all();
        //  dd($admin);
         return view('admin.admin.index',['admin'=>$admin]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // 排除接收***
         $post = request()->except(['_token','/admin/store']);
        
        $post['admin_time'] = time();
        //  dump($post);
        $post['admin_pwd'] =encrypt($post['admin_pwd']);
        // dd($post);
    
        $res = Admin::create($post);
        //   dd($res);
         if($res){
             return redirect('/admin');
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         // +++ORM操作+++
         $admin = Admin::find($id);
         return view('admin.admin.edit',['admin'=>$admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // echo 'xiaoxia';die;
        $post = Admin::all(); 
        // dd($post);
        // $post['admin_time'] = time();
        //  dump($post);
        // $post['admin_pwd'] =encrypt($post['admin_pwd']);
        $post  = $request->except('_token','/admin/update/'.$id);
        dd($post);
       $res = Admin::where('admin_id',$id)->update($post); 
        dd($res);
       if($res!==false){
           return redirect('/admin');
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Admin::destroy($id);
        //  dd($res);
         if($res){
             return redirect('/admin');
         }
    }
}
