@extends('layouts.shop')
@section('title', '注册')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
      <script src="/static/index/js/jquery.min.js"></script>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('/index')}}" method="get" class="reg-login">
      <h3>已经有账号了？点此<a class="orange" href="login.html">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="name" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList2"><input type="text" name="code" placeholder="输入短信验证码" /> 
       <button type="button">获取验证码</button></div>
       <div class="lrList"><input type="password" name="password" placeholder="设置新密码（6-18位数字或字母）" /></div>
       <div class="lrList"><input type="password" name="repassword" placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即注册" />
      </div>
     </form><!--reg-login/-->
     <script>
          $('button').click(function(){
               var name = $('input[name="name"]').val();  
               // 正则验证
               var reg = /^1[3|5|6|7|8|9]\d{9}$/
               if(reg.test(name)){
                    // 手机号发送验证码
                    $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    } });
                    $.post('/sendSms',{mobile:name},function(result){
                        alert(result.msg);
                    },'json');
                    return;
               }

               // 邮箱验证
                    var memailreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
                    if (memailreg.test(name)) {
                         // 发送邮箱
                         $.get('/sendEmail',{email:name},function(result){
                        alert(result.msg);
                         },'json');
                         return;
                    }
                    alert('请输入正确的手机号或者邮箱');
     

          })
     
         
     </script>

     @endsection

        