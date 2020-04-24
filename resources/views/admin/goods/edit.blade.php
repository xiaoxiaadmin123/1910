<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>laravel框架商品商城</title>
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
        <li class="active"><a href="{{url('/goods')}}">商品管理</a></li>
        <li><a href="{{url('/admin')}}">管理员管理</a></li>
        <li><a href="{{url('/hotlink')}}">友情链接管理</a></li>
      </ul>
    </div>
  </div>
</nav>
 
<center>
    <h2>商品分类</h2><a href="{{'/goods'}}" class="btn btn-default">列表展示</a>
    <form class="form-horizontal" role="form" enctype="multipart/form-data" action="{{url('/goods/update/'.$goods->goods_id)}}" method="post" >
    @csrf   
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">商品名称</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="firstname" value="{{$goods->goods_name}}" name="goods_name" placeholder="请输入商品名称">
                <b style="color:red">{{$errors->first('goods_name')}}</b>
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">商品价格</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="firstname" value="{{$goods->goods_price}}" name="goods_price" placeholder="请输入商品价格">
                <b style="color:red">{{$errors->first('brand_name')}}</b>
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">商品介绍</label>
            <div class="col-sm-6">
                <textarea type="text" class="form-control" id="firstname" name="goods_desc" value="{{$goods->goods_desc}}" placeholder="请输入商品介绍"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">商品库存</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="firstname" name="goods_num" value="{{$goods->goods_num}}" placeholder="请输入商品库存">
                <b style="color:red">{{$errors->first('brand_name')}}</b>
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">商品积分</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="firstname" name="goods_score" value="{{$goods->goods_score}}" placeholder="请输入商品积分">
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">商品图片</label>
            <div class="col-sm-6">
                <input type="file" class="form-control" id="firstname" name="goods_img" placeholder="请选择商品图片">
            </div>
        </div>
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">商品相册</label>
            <div class="col-sm-6">
                <input type="file" class="form-control" multiple="multiple" id="firstname" name="goods_imgs[]" placeholder="请选择商品相册">
            </div>
        </div>
        
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">是否新品</label>
            <div class="col-sm-6">
                <input type="radio"  name="is_new" value="1"  {{$goods->is_new=="1" ? "checked" : ""}}>是
                <input type="radio" name="is_new" value="2"  {{$goods->is_new=="2" ? "checked" : ""}}>否
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">是否热卖</label>
            <div class="col-sm-6">
                <input type="radio"  name="is_hot" value="1"  {{$goods->is_hot=="1" ? "checked" : ""}}>是
                <input type="radio" name="is_hot" value="2"  {{$goods->is_hot=="2" ? "checked" : ""}}>否
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">是否精品</label>
            <div class="col-sm-6">
                <input type="radio"  name="is_best" value="1"  {{$goods->is_best=="1" ? "checked" : ""}}>是
                <input type="radio" name="is_best" value="2"   {{$goods->is_best=="2" ? "checked" : ""}}>否
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">是否上架</label>
            <div class="col-sm-6">
                <input type="radio"  name="is_up" value="1"  {{$goods->is_up=="1" ? "checked" : ""}}>是
                <input type="radio" name="is_up" value="2"   {{$goods->is_up=="2" ? "checked" : ""}}>否
            </div>
        </div>
    
    <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">品牌分类</label>
            <div class="col-sm-6">
                    <select name="brand_id" id=""  class="form-control" >
                       <option value="0">--请选择品牌分类--</option>
                        @foreach($brand as $v)
                       <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                       @endforeach     
                    </select>
                    <b style="color:red">{{$errors->first('brand_name')}}</b>
            </div>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">分类列表</label>
            <div class="col-sm-6">
                    <select name="cate_id" id=""  class="form-control" >
                        <option value="0">--请选择列表分类--</option>
                        @foreach($cate as $v)
                        <option value="{{$v->cate_id}}">{{str_repeat('|-',$v->level)}}{{$v->cate_name}}</option>
                        @endforeach       
                    </select>
                    <b style="color:red">{{$errors->first('brand_name')}}</b>
            </div>
            <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-default" value="点我提交商品">
            </div>
        </div>
        </div>
        </form>
</center>


</body>
</html>


 