

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
        <li><a href="{{url('/brand')}}">商品品牌</a></li>
        <li><a href="{{url('/cate')}}">商品分类</a></li>
        <li><a href="{{url('/goods')}}">商品管理</a></li>
        <li><a href="{{url('/admin')}}">管理员管理</a></li>
        <li class="active"><a href="{{url('/hotlink')}}">友情链接管理</a></li>
      </ul>
    </div>
  </div>
</nav>
 
<center>
    <table class="table table-condensed">
    <h2>友情链接管理</h2> 
        <a href="{{'/hotlink/create'}}" class="btn btn-success">添加</a>
        <thead>
            <tr>
                <th>友情链接ID</th>
                <th>网站名称</th>
                <th>网站网址</th>
                <th>链接类型</th>
                <th>图片LOGO</th>
                <th>网站联系人</th>
                <th>网站介绍</th>
                <th>是否显示</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($link as $v) 
            <tr>
                <td>{{$v->link_id}}</td>
                <td>{{$v->link_name}}</td>
                <td>{{$v->link_url}}</td>
                <td>@if($v->is_up==1)LOGO链接@endif @if($v->is_up==2)文字链接@endif</td>
                <td>
                @if($v->link_logo)
                    <img src="{{env('UPLOADS_URL')}}{{$v->link_logo}}" width="80" hight="100">
                @endif  
                </td>
                <td>{{$v->link_man}}</td>
                <td>{{$v->link_desc}}</td>
                <td>@if($v->is_show==1)是@endif @if($v->is_show==2)否@endif</td>
                <td>
                <a href="{{url('/hotlink/edit/'.$v->link_id)}}" class="btn btn-primary">编辑</a>  ||  
                <a href="{{url('/hotlink/destroy/'.$v->link_id)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
            <tr>
              <td colspan="6"></td>
            </tr>
        </tbody>
    </table>
</center>


</body>
</html>