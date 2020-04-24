

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
    <table class="table table-condensed">
    <h2>品牌管理</h2> 

    <form action="">
       品牌名称 ：<input type="text" value="{{$brand_name}}" name="brand_name" placeholder="请输入品牌名称关键字">
       品牌网址 ：<input type="text" value="{{$brand_url}}" name="brand_url" placeholder="请输入品牌网址关键字">
      <button>搜索</button>
   </form><br>
        <a href="{{'/brand/create'}}" class="btn btn-success">添加</a>
     
        <caption>精简表格布局</caption>
        <thead>
            <tr>
                <th>品牌ID</th>
                <th>品牌名称</th>
                <th>品牌网址</th>
                <th>品牌LOGO</th>
                <th>品牌描述</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($brand as $v) 
            <tr>
                <td>{{$v->brand_id}}</td>
                <td>{{$v->brand_name}}</td>
                <td>{{$v->brand_url}}</td>
                <td><img src="{{env('UPLOADS_URL')}}{{$v->brand_logo}}" width="80" hight="100"></td>
                <td>{{$v->brand_desc}}</td>
                <td>
                <a href="{{url('/brand/edit/'.$v->brand_id)}}" class="btn btn-primary">编辑</a>  ||  
                <a href="{{url('/brand/destroy/'.$v->brand_id)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
            <tr>
              <td colspan="6">{{ $brand->appends(['brand_name' => $brand_name,'brand_url' => $brand_url])->links() }}</td>
            </tr>
        </tbody>
    </table>
</center>


</body>
</html>