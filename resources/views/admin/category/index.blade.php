

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
<h2>商品分类</h2>
    <form action="">
       分类名称 ：<input type="text" value="{{$cate_name}}"  name="cate_name" placeholder="请输入分类名称关键字">
      <button>搜索</button>
    </form><br>
    <a href="{{'/cate/create'}}" class="btn btn-success">添加</a>
    <table class="table table-condensed">
    
    
        <thead>
            <tr>
                <th>分类ID</th>
                <th>分类名称</th>
                <th>父级分类</th>
                <th>分类描述</th>
                <th>是否展示在导航栏</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($cate as $v) 
            <tr>
                <td>{{$v->cate_id}}</td>
                <td>{{str_repeat('|--',$v->level)}}{{$v->cate_name}}</td>
                <td>{{$v->parent_id}}</td>
                <td>@if($v->is_show==1)是@endif @if($v->is_is_shownew==2)否@endif</td>
                <td>@if($v->is_show_nav==1)是@endif @if($v->is_show_nav==2)否@endif</td>
                <td>
                <a href="{{url('/cate/edit/'.$v->cate_id)}}" class="btn btn-primary">编辑</a>  ||  
                <a href="{{url('/cate/destroy/'.$v->cate_id)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
            
        </tbody>
    </table>
</center>


</body>
</html>