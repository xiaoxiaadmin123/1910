<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>laravel框架分类商城</title>
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
        <li><a href="{{url('/brand')}}">商品品牌</a></li>
        <li class="active"><a href="{{url('/cate')}}">商品分类</a></li>
        <li><a href="{{url('/goods')}}">商品管理</a></li>
        <li><a href="{{url('/admin')}}">管理员管理</a></li>
        <li><a href="{{url('/hotlink')}}">友情链接管理</a></li>
      </ul>
    </div>
  </div>
</nav>
 
<center>
    <h2>商品分类</h2><a href="{{'/cate'}}" class="btn btn-default">列表展示</a>
    <form class="form-horizontal" role="form" enctype="multipart/form-data" action="{{url('/cate/update/'.$cate->cate_id)}}" method="post">
    @csrf   
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">分类名称</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="firstname" name="cate_name" value="{{$cate->cate_name}}" placeholder="请输入分类名称">
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">父级分类</label>
            <div class="col-sm-6">
                               <select name="parent_id" id=""  class="form-control" >
                                   <option value="0">--请选择父级分类--</option>
                                    @foreach($cates as $v)
                                   <option value="{{$v->cate_id}}">{{str_repeat('|-',$v->level)}}{{$v->cate_name}}</option>
                                    @endforeach
                               </select>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">是否显示</label>
            <div class="col-sm-6">
                <input type="radio"  name="is_show" value="1" checked>是
                <input type="radio" name="is_show" value="2">否
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">是否导航显示</label>
            <div class="col-sm-6">
                <input type="radio"  name="is_show_nav" value="1" checked>是
                <input type="radio" name="is_show_nav" value="2">否
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-default" value="点我提交分类">
            </div>
        </div>
    </form>
</center>


</body>
</html>


 