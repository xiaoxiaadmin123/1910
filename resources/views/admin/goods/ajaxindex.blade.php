
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
                <td>{{$v->brand_name}}</td>
                <td>{{$v->cate_name}}</td>
                <td>
                <a href="{{url('/goods/edit/'.$v->goods_id)}}" class="btn btn-primary">编辑</a>  ||  
                <a href="{{url('/goods/destroy/'.$v->goods_id)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
                <td colspan="13">{{ $goods->links() }}</td>
