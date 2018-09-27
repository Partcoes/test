<h1>首页展示</h1>
@foreach($data as $key => $item)
    <p>{{$item->user_name}}</p>
    <p>{{$item->user_pwd}}</p>
@endforeach
{{$data->links()}}