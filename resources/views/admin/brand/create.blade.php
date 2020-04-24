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
        <li><a href="{{url('/hotlink')}}">友情链接管理</a></li>
      </ul>
    </div>
  </div>
</nav>
 
<center>
    <h2>品牌管理</h2><a href="{{'/brand'}}" class="btn btn-default">列表展示</a>
    <!-- @if ($errors->any())
      <div class="alert alert-danger">
      <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
      </ul>
      </div>
    @endif -->
    <form class="form-horizontal" role="form" enctype="multipart/form-data" action="{{url('/brand/store')}}" method="post">
    @csrf   
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">品牌名称</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="firstname" name="brand_name" placeholder="请输入品牌名称">
                <b style="color:red">{{$errors->first('brand_name')}}</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">品牌网址</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="lastname" name="brand_url"  placeholder="请输入品牌网址">
                <b style="color:red">{{$errors->first('brand_url')}}</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">品牌LOGO</label>
            <div class="col-sm-6">
                <input type="file" class="form-control" id="lastname" name="brand_logo"  placeholder="请输入品牌LOGO">
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">品牌描述</label>
            <div class="col-sm-6">
                <textarea type="text" class="form-control" id="lastname" name="brand_desc"  placeholder="请输入品牌描述"></textarea>
            </div>
        </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-default" value="点我提交品牌">
            </div>
        </div>
    </form>
</center>


</body>
</html>


 