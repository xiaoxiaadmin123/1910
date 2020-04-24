<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>laravel框架管理员管理</title>
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
        <li  class="active"><a href="{{url('/hotlink')}}">友情链接管理</a></li>
      </ul>
    </div>
  </div>
</nav>
 
<center>
    <h2>友情链接管理</h2><a href="{{'/hotlink'}}" class="btn btn-default">列表展示</a>
    <!-- @if ($errors->any())
      <div class="alert alert-danger">
      <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
      </ul>
      </div>
    @endif -->
    <form class="form-horizontal" role="form"  action="{{url('/hotlink/store')}}" method="post"  enctype="multipart/form-data">
    @csrf   
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">网站名称</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="firstname" name="link_name" placeholder="请输入网站名称">
                <b style="color:red"></b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">网站网址</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="lastname" name="link_url"  placeholder="请输入网站网址">
                <b style="color:red"></b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">链接类型</label>
            <div class="col-sm-6">
                <input type="radio" id="lastname" name="is_up" value="1" checked>LOGO链接
                <input type="radio"  id="lastname" name="is_up" value="2">文字链接
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">图片LOGO</label>
            <div class="col-sm-6">
                <input type="file" class="form-control" id="lastname" name="link_logo"  placeholder="上传图片"> 
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">网站联系人</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="lastname" name="link_man"  placeholder="请输入网站联系人 ">
                <b style="color:red"></b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">网站介绍</label>
            <div class="col-sm-6">
                <textarea type="password" class="form-control" id="lastname" name="link_desc"  placeholder="请输入网站介绍"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">是否显示</label>
            <div class="col-sm-6">
                <input type="radio" id="lastname" name="is_show" value="1" checked>是
                <input type="radio" id="lastname" name="is_show" vlaue="2">否
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-default" value="点我添加友情链接">
            </div>
        </div>
    </form>
</center>


</body>
</html>


 