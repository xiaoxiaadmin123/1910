

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>laravel框架分类商城</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <li class="active"><a href="{{url('/goods')}}">商品管理</a></li>
        <li><a href="{{url('/admin')}}">管理员管理</a></li>
        <li><a href="{{url('/hotlink')}}">友情链接管理</a></li>
      </ul>
    </div>
  </div>
</nav>
 
<center>
<h2>商品</h2>
    <form action="">
      <input type="text" value=""  name="goods_name" placeholder="请输入商品名称关键字">
       <select name="cate_id" id="">
        <option value="">请选择分类</option>
        @foreach($brand as $v)
             <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
        @endforeach     
        <option value=""></option>
       </select>
       <select name="brand_id" id="">
        <option value="">请选择品牌</option>
        @foreach($cate as $v)
          <option value="{{$v->cate_id}}">{{str_repeat('|--',$v->level)}}{{$v->cate_name}}</option>
        @endforeach    
       </select>
      <button>搜索</button>
    </form><br>
    <a href="{{'/goods/create'}}" class="btn btn-success">添加</a>
    <table class="table table-condensed">
    
    
        <thead>
            <tr>
                <th>商品ID</th>
                <th>商品名称</th>
                <th>商品价格</th>
                <th>商品介绍</th>
                <th>商品库存</th>
                <th>商品积分</th>
                <th>商品图片</th>
                <th>商品相册</th>
                <th>是否新品</th>
                <th>是否热卖</th>
                <th>是否精品</th>
                <th>是否上架</th>
                <th>是否首页幻灯片</th>
                <th>品牌分类</th>
                <th>分类列表</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($goods as $v) 
            <tr>
                <td>{{$v->goods_id}}</td>
                <td>{{$v->goods_name}}</td>
                <td>{{$v->goods_price}}</td>
                <td>{{$v->goods_desc}}</td>
                <td>{{$v->goods_num}}</td>
                <td>{{$v->goods_score}}</td>
                <td>
                @if($v->goods_img)
                <img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width="80" hight="100">
                @endif
                </td>
                <td>
                  @if(isset($v->goods_imgs))
                  @php $imgs = explode('|',$v->goods_imgs); @endphp
                  @foreach($imgs as $img)
                  <img src="{{env('UPLOADS_URL')}}{{$img}}" width="100" height="100">
                  @endforeach
                  @endif
                </td>
                <td>@if($v->is_new==1)是@endif @if($v->is_new==2)否@endif</td>
                <td>@if($v->is_hot==1)是@endif @if($v->is_hot==2)否@endif</td>
                <td>@if($v->is_best==1)是@endif @if($v->is_best==2)否@endif</td>
                <td>@if($v->is_up==1)是@endif @if($v->is_up==2)否@endif</td>
                <td>@if($v->is_slide==1)是@endif @if($v->is_slide==2)否@endif</td>
                <td>{{$v->brand_name}}</td>
                <td>{{$v->cate_name}}</td>
                <td>
                <a href="{{url('/goods/edit/'.$v->goods_id)}}" class="btn btn-primary">编辑</a>  ||  
                <a href="{{url('/goods/destroy/'.$v->goods_id)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
        <td colspan="13">{{ $goods->links()}}</td>
        </tbody>
    </table>
</center>
    <script>
      // $(".page-item a").click(function(){
      $(document).on('click','.page-item a',function(){
        var url = $(this).attr('href');
        // 第一种
        // $.get(url,function(result){
        //  $('tbody').html(result);
        // })
        // 第二种
        
        $.ajaxSetup({ //表单令牌
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
          });

         $.post(url,function(result){
         $('tbody').html(result);
        })
        return false;
      })
    
    </script>

</body>
</html>