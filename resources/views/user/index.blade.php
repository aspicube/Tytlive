@extends('user.layout')

@section('config')
    <div class="card">
        <div class="card-header">
            <h4>个人信息</h4>
        </div>
        <div class="card-block">
            <div class="container-fluid top-bar row user-center-left">
                <div class="col-xs-12 col-md-3">
                    <img src="//cdn.v2ex.com/gravatar/{{ md5(Auth::user()->email) }}?s=130" width="100%"
                         class="image-border">
                </div>
                <div class="col-xs-12 col-md-9">
                    <h4 class="user-info-right">{{ Auth::user()->name }}
                        <span class="user-info-setting">
                            <a href="{{ url('/') }}"><i class="fa fa-pencil"></i> 修改昵称</a>
                        </span>
                    </h4>
                    <h6 class="user-info-right">{{ Auth::user()->email }}
                        <span class="user-info-setting">
                            <a href="{{ url('/') }}"><i class="fa fa-pencil"></i> 更换绑定邮箱</a>
                        </span>
                    </h6>
                    <h6 class="user-info-right">
                        @if($liveinfo)
                            <h6>您的直播间地址：
                                <span class="user-info-setting">
                                <a href="{{ url('/u/'.Auth::user()->id) }}" target="_blank">
                                <i class="fa fa-link"></i> {{ url('/u/'.Auth::user()->id) }}
                                </a>
                                </span>
                            </h6>
                        @else
                            <span style="color:#0074d9">您还没有开通直播间</span>
                            @if(!$userinfo['openid'])
                                <span style="color:#0074d9">,请先绑定微信</span>
                            @endif
                        @endif
                    </h6>
                </div>
            </div>
        </div>
    </div>
    <div class = 'card'>
        <div class="card-header">
            <h4>微信绑定</h4>
        </div>

        <div class="card-block">
            @if(!$userinfo['wx_openid'])
            您尚未绑定微信
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary-outline btn-sm" data-toggle="modal" data-target="#myModal">
                绑定微信
            </button>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">绑定微信</h4>
                        </div>
                        <form action="{{url('user/bindwx/submit')}}" method="post">
                            <input type="hidden" value="{{csrf_token()}}">


                        <div class="container-fluid top-bar row user-center-left">
                            <div class="col-xs-12 col-md-4">
                                <img src="{{url('img/qrcode/bindwechat')}}" width="100%"
                                     >
                            </div>
                            <div class="col-xs-12 col-md-8">
                                <div style="padding-left:5px;padding-right:20px;padding-top: 20px">
                                <h4 class="user-info-right" >请用微信手机端扫描左侧二维码，并将获得的验证码填在下面。
                                </h4>
                                    <hr>
                                <div class="input-group">
                                    <span class="input-group-addon">验证码：</span>
                                <input class="form-control" type="text" name="session_id">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary-outline">提交</button>
                                    </span>
                                </div>
                                </div>
                            </div>

                        </div>
                            {{--<div class="modal-footer">--}}
                                {{--<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>--}}
                                {{--<button type="submit" class="btn btn-primary">提交</button>--}}
                            {{--</div>--}}
                        </form>
                    </div>
                </div>
            </div>
                @else
            您已经绑定微信
                @endif
        </div>
    </div>
@endsection