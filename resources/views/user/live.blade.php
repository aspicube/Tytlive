@extends('user.layout')
@section('config')
    <div class="card">
        <div class="card-header">
            <h4>@if($liveinfo) 我的直播间 @else 开通直播 @endif</h4>
        </div>
        <div class="card-block">
        @if($liveinfo)

            @if($liveinfo['playing'] == false) 您已开通直播间。
            <a href="{{url('user/livec/start')}}" class="btn btn-info-outline">开始直播</a>
                @else
                您已经在直播中。
                    <a href="{{url('user/livec/stop')}}" class="btn btn-danger-outline">停止直播</a>
                @endif

        @elseif($userinfo['wx_openid'])
            <form action="{{url('/user/newlive')}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="input-group input-group-padding-bottom">
                    <span class="input-group-addon">直播间名称：</span>
                    <input type="text" id="setting_user_name" class="form-control" name="name">
                {{--<span class="input-group-btn">--}}
                    {{--<button class="btn btn-info-outline" id="setting_user_name_btn" type="button">保存</button>--}}
                {{--</span>--}}
                </div>
                <div class="input-group input-group-padding-bottom">
                    <span class="input-group-addon">直播封面图：</span>
                    <input type="text" id="setting_user_email" class="form-control" name="pic">
                <span class="input-group-btn">
                    <button class="btn btn-info-outline" id="setting_user_email_btn" type="button">上传</button>
                </span>

                </div>
                <div class="input-group input-group-padding-bottom">
                    <span class="input-group-addon">直播间分类：</span>
                    <select  id="setting_user_email" class="form-control" name="category">
                        <option value="0">
                            默认分类
                        </option>
                        <option selected value="1">
                            第一分类
                        </option>
                    </select>
                {{--<span class="input-group-btn">--}}
                    {{--<button class="btn btn-info-outline" id="setting_user_email_btn" type="button">上传</button>--}}
                {{--</span>--}}

                </div>
                <div class="input-group input-group-padding-bottom">
                    <span class="input-group-addon">直播间简介：</span>
                    <input type="text" id="setting_user_name" class="form-control" name="intro">
                    {{--<span class="input-group-btn">--}}
                    {{--<button class="btn btn-info-outline" id="setting_user_name_btn" type="button">保存</button>--}}
                    {{--</span>--}}
                </div>
                <div class="input-group input-group-padding-bottom">
                    <span class="input-group-addon">介绍页链接：</span>
                    <input type="text" id="setting_user_name" class="form-control" name="long_intro">
                    <span class="input-group-btn">
                    <button class="btn btn-info-outline" id="setting_user_name_btn" type="button">制作</button>
                    </span>
                </div>
            <button type="submit" class="btn btn-primary-outline">创建直播间</button>
            <a href="#">查看帮助</a>
            </form>
        @else 请先在个人信息页绑定微信
        @endif
        </div>
    </div>
@endsection