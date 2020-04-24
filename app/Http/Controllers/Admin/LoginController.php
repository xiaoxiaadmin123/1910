<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
class LoginController extends Controller
{
    public function loginDo(Request $request){
        $admin  = $request->except('_token','/loginDo');
        $adminuser = Admin::where('admin_name',$admin['admin_name'])->first();
        // dump(encrypt('123456'));
        // dd(encrypt('123456'));
        // dd(decrypt($adminuser->admin_pwd));
        if(decrypt($adminuser->admin_pwd)!=$admin['admin_pwd']){
            return redirect('/login')->with('msg','用户名或密码不对');
        }

        session(['adminuser'=>$adminuser]);

        return redirect('/goods');

 
    }
}
