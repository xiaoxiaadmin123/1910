<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>laravel框架商城</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">微商城</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
        <li class="active"><a href="{{url('/brand')}}">商品品牌</a></li>
        <li><a href="{{url('/cate')}}">商品分类</a></li>
        <li><a href="{{url('/goods')}}">商品管理</a></li>
        <li><a href="{{url('/admin')}}">管理员管理</a></li>
      </ul>
    </div>
  </div>
</nav>
 
<center>
    <h2>管理员管理</h2><a href="{{'/admin'}}" class="btn btn-default">列表展示</a>
    <!-- @if ($errors->any())
      <div class="alert alert-danger">
      <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
      </ul>
      </div>
    @endif -->
    <b style="color:red">{{session('msg')}}</b>
    <form class="form-horizontal" role="form"  action="{{url('/loginDo')}}" method="post">
    @csrf   
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="firstname" name="admin_name" placeholder="请输入管理员名称">
                <b style="color:red">{{$errors->first('brand_name')}}</b>
          
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">手机号</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="lastname" name="admin_tel"  placeholder="请输入手机号">
                <b style="color:red">{{$errors->first('brand_url')}}</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="lastname" name="admin_email"  placeholder="请输入邮箱">
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" id="lastname" name="admin_pwd"  placeholder="请输入密码">
            </div>
        </div>
        <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="lsrember">七天免登陆
        </label>
      </div>
    </div>
  </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-default" value="点我登录">
            </div>
        </div>
    </form>
</center>


</body>
</html>


 