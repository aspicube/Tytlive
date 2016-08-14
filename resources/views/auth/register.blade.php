@extends('layouts.app')

@section('content')
{{--<div class="container">--}}
    {{--<div class="page-header">--}}
        {{--<h2 class="text-lg-center">--}}
            {{--注册天眼通账号--}}
        {{--</h2>--}}
    {{--</div>--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading"></div>--}}
                {{--<div class="panel-body">--}}
                    {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">--}}
                        {{--{{ csrf_field() }}--}}

                        {{--<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">--}}
                            {{--<label for="name" class="col-md-4 control-label">Name</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">--}}

                                {{--@if ($errors->has('name'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('name') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                            {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">--}}

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
                            {{--<label for="password" class="col-md-4 control-label">Password</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control" name="password">--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">--}}
                            {{--<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation">--}}

                                {{--@if ($errors->has('password_confirmation'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password_confirmation') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--<i class="fa fa-btn fa-user"></i> Register--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
<div class="container-fluid">
    <div class="container login-register-content">
        <div class="sub-header">
            <h3>注册</h3>
        </div>
        <div class="card no-margin-bottom">
            <form method="POST" action="{{ url('/register') }}">
                {!! csrf_field() !!}
                <div class="card-block">
                    <fieldset class="form-group">
                        <label for="InputUserName">用户名</label>
                        <input type="text" class="form-control" id="InputUserName" placeholder="Enter Username" name="name" value="{{ old('name') }}" required>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="InputEmail">邮箱地址</label>
                        <input type="email" class="form-control" id="InputEmail" placeholder="Enter email" name="email" value="{{ old('email') }}" required>
                        <small class="text-muted">We'll never share your email with anyone else.</small>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="InputPassword">密码</label>
                        <input type="password" class="form-control" id="InputPassword" placeholder="Enter Password" name="password" required>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="ConfirmPassword">确认密码</label>
                        <input type="password" class="form-control" id="ConfirmPassword"
                               placeholder="Confirm Password" name="password_confirmation" required>
                    </fieldset>
                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <span style="color: red">{{ $error }}</span>
                        @endforeach
                    @endif
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary-outline">注册</button>
                    <a class="btn-link" href="{{ url('/login') }}" style="margin-left: 1em;">已有账号？点此登录</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
