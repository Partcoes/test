@extends('admin.index.index')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border"><b style='font-size:20px;'>商品详情·</b>{{$goodInfo->good_name}}</div>
        <div class="box-body">
            <div class="con-sm-12">
                商品货号：{{$goodInfo->good_sn}}
            </div>
        </div>
    </div>
@endsection