@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="sub-header">
            <h3>{{ $title or $user['name']}}</h3>
        </div>
        <div class="container-build row">
            <div class="col-xs-12 col-md-4 user-center-left">
                <div class="list-group">
                    <a href="{{url('user')}}" class="list-group-item
                    @if(URL::current()==url('user')) active @endif">
                        <i class="fa fa-user"></i> 个人信息
                    </a>
                    <a href="{{url('/user/live')}}" class="list-group-item
                    @if(URL::current()==url('/user/live')) active @endif">
                        <i class="fa fa-play-circle"></i> @if($liveinfo) 我的直播间
                        @else 开通直播 @endif
                    </a>
                    @if($liveinfo)
                        <a href="{{url('/user/livemanage')}}" class="list-group-item
                    @if(URL::current()==url('/user/livemanage')) active @endif">
                            <i class="fa fa-th-list"></i> 管理直播
                        </a>
                        @endif
                </div>
            </div>
            <div class="col-xs-12 col-md-8">
                @yield('config')
            </div>
        </div>
    </div>
@endsection