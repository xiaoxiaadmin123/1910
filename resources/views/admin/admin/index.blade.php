

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
        <li class="active"><a href="{{url('/admin')}}">管理员管理</a></li>
        <li><a href="{{url('/hotlink')}}">友情链接管理</a></li>
      </ul>
    </div>
  </div>
</nav>
 
<center>
    <table class="table table-condensed">
    <h2>管理员管理</h2> 
        <a href="{{'/admin/create'}}" class="btn btn-success">添加</a>
        <thead>
            <tr>
                <th>管理员ID</th>
                <th>管理员名称</th>
                <th>管理员电话</th>
                <th>管理员邮箱</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($admin as $v) 
            <tr>
                <td>{{$v->admin_id}}</td>
                <td>{{$v->admin_name}}</td>
                <td>{{$v->admin_tel}}</td>
                <td>{{$v->admin_email}}</td>
                <td>{{date('Y-m-d H:i:s',$v->admin_time)}}</td>
                <td>
                <a href="{{url('/admin/edit/'.$v->admin_id)}}" class="btn btn-primary">编辑</a>  ||  
                <a href="{{url('/admin/destroy/'.$v->admin_id)}}" class="btn btn-danger">删除</a>
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