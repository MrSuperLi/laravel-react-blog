<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>XIAOLI Admin</title>

	<!-- <link href="{{ asset('/css/app.css') }}" rel="stylesheet"> -->
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<!-- Fonts -->
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" style="z-index:1">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="javascript:void(0);">Laravel</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">首页</a></li>
					<li class="dropdown">
		          		<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);">
		          			推文管理<span class="caret"></span>
		          		</a>
						<ul class="dropdown-menu" role="menu">
                            <li class='dropdown-header'>管理选项</li>
                            <li class="divider"></li>
                            <li><a href="{{ url('/home/articles/create') }}">新建推文</a></li>
                            <li><a href="{{ url('/home/articles') }}">推文列表</a></li>
                        </ul>
		          	</li>
					<li class="dropdown">
		          		<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);">
		          			评论管理<span class="caret"></span>
		          		</a>
						<ul class="dropdown-menu" role="menu">
                            <li class='dropdown-header'>管理选项</li>
                            <li class="divider"></li>
                            <li><a href="{{ url('/home/comments') }}">评论列表</a></li>
                        </ul>
		          	</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">登录</a></li>
						<!-- <li><a href="{{ url('/auth/register') }}">注册</a></li> -->
					@else
						<li class="dropdown">
							<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">注销</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
	@yield('content')
	<div class='container footer'>
		<div class='footer-content'>
			<h3><a href="mailto:1140926800@qq.com">@XIAOLI</a></h3>
		</div>
	</div>
	<style type="text/css">
		body{margin-top:80px;}
		.footer{bottom:20px;text-align:center;margin-top:50px;border-top:5px dotted #898989;}
		.footer-content{margin:0 auto;}
	</style>
	<!-- Scripts -->
</body>
</html>
