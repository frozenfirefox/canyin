<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">沃天会</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="{{ in_array(Request::getPathinfo(), ['/index' , '' , '/'])?'active' : ''}}"><a href="{{url('')}}">首页</a></li>
                <li class="{{in_array(Request::getPathinfo(), ['/internet'])?'active' : ''}}"><a href="{{url('internet')}}">互联网+分享</a></li>
                <li class="{{in_array(Request::getPathinfo(), ['/datatalk'])?'active' : ''}}"><a href="{{url('datatalk')}}">数据慧说话</a></li>
                <li class="{{in_array(Request::getPathinfo(), ['/ecology'])?'active' : ''}}"><a href="{{url('ecology')}}">沃天生态链</a></li>
                <li class="{{in_array(Request::getPathinfo(), ['/about'])?'active' : ''}}"><a href="{{url('about')}}">关于我们</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(!Auth::guard('admin')->check() && !Auth::guard('users')->check())
                    <li><a href="/user">前台登录</a></li>
                    <li><a href="/admin">后台登录</a></li>
                @else
                    <li><a href="{{ Request::segment(1) }}/logout">Logout</a></li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
