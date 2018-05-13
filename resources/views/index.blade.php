@extends('app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-info">
				<div class="panel-heading" style='font-size:22px;color:#f7f7f7;text-align:center;background-color:#343434;padding:20px;'>我的推文</div>
				<div class="panel-body">
					@each('articlelist',$articles,'article');
				</div>
				<div class='panel-footer' style='text-align:center'>
					{!! $page !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection