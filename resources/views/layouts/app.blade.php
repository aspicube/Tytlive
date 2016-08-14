<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>{{ isset($title) ? ($title . " - ") : null }}TytLive</title>
    <link rel="shortcut icon" href="{{ url('/favicon.ico') }}">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/tether/1.3.2/css/tether.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel='stylesheet' href="//fonts.iwch.me/css?family=Open+Sans:600">
    <link rel="stylesheet" href="{{ url('/css/style.css') }}">
    @yield('css')
</head>
<script src="//cdn.bootcss.com/jquery/2.2.0/jquery.js"></script>
<script>
    $(document).ready(function(){
        $(document).scroll(function(){
            var x = document.body.scrollTop;

            if(x > $('#topbar').height()*2)
            $('#anotherbar').slideDown();
            else $('#anotherbar').slideUp();
        }
        );
    });

</script>
@yield('top-js')
<body>
<div class="container-fluid top-bar">
    <nav class="navbar navbar-fixed-top" id="anotherbar" style="background-color: rgba(68, 67, 69, 0.3);display:none">
        <a class="a-black" href="{{url('/')}}" style="padding-left: 20px"><i class="fa fa-home"></i>天眼通</a>

    </nav>
    <nav class="navbar live-nav-top" id="topbar">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fa fa-home"></i> 天眼通直播
        </a>
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-genderless"></i> 全部直播</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-genderless"></i> 分类</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-genderless"></i> 视频</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-genderless"></i> 关于</a>
            </li>
        </ul>
        <ul class="nav navbar-nav pull-right">
            @if (Auth::guest())
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/register') }}"><i class="fa fa-user-plus"></i> 注册</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/login') }}"><i class="fa fa-sign-in"></i> 登录</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/user') }}"><i class="fa fa-user"></i> {{ Auth::user()->name }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> 登出</a>
                </li>
            @endif
        </ul>
    </nav>
    @yield('banner')
</div>
<div class="main-content">
    @yield('content')
    <div class="container-fluid">
        <footer class="content-footer">
            © 2016 <a href="http://www.baidu.com" target="_blank">Tytlive</a> All right reserved
        </footer>
    </div>
</div>
<script src="//cdn.bootcss.com/tether/1.3.2/js/tether.min.js"></script>
<script src="{{ url('/js/vendor/bootstrap.min.js') }}"></script>
@yield('js')
</body>
</html>
