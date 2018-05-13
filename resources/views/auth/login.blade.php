@extends('app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ url('css/signin.css') }}">
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">登录面板</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert">
		                        <span aria-disabled="true">&times;</span>
		                    </button>
							<strong>Sorry!</strong> 您提交的信息有误.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<form class="form-signin" role="form" method="POST" action="{{ url('/auth/login') }}">
						<h2 class="form-signin-heading">请登录</h2>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
					    <label for="email" class="sr-only">邮箱：</label>
						<input type="email" name="email" class="form-control" placeholder="Email address" value="{{ old('email') }}" required autofocus>
						<label for="password" class="sr-only">密码：</label>
						<input type="password" name="password" class="form-control" placeholder="Password" required>
						<div class="checkbox">
						    <label>
						    	<input type="checkbox" name="remember">下次自动登录
						    </label>
						    <a class="btn btn-link" href="{{ url('/password/email') }}">忘记密码?</a>
					    </div>
					    <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
