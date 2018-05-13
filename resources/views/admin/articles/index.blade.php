@extends('admin.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-info">
				<div class="panel-heading" style='position:relative;text-align:center;background-color:#343434;color:#f7f7f7;padding:22px;font-size:22px;'>
					<a class='btn btn-success'style='left:20px;position:absolute;top:35px;' href="{{ URL('home/articles/create') }}">新建</a>
					<h3 style='color:#f7f7f7;'>推文管理（共 <?=$articles->total() ?> 篇）<h3>
				</div>
				<div class="panel-body">
				@include('errors')
				@forelse ($articles as $article)
					<div class='row'>
					<div class="col-md-12">
					<ul class='list-group'>
					<li class='list-group-item'>
						<div class="list-group-item-heading">
							<a href="{{ URL('home/articles/'.$article->id) }}">
								<h4>{{ $article->title }}</h4>
							</a>
						</div>
						<div class="list-group-item-text">
							<h5>{{ $article->created_at }}</h5>
							<p>{{ $article->summary }}</p>
						</div>   
					    <form action="{{ URL('home/articles/'.$article->id) }}" style='display:inline;' method='post'>
							<input name='_method' value='DELETE' type="hidden">
							<input name='_token' value='{{ csrf_token() }}' type="hidden">
							<div class="btn-group btn-group-left">
								<a class="btn btn-primary" href="{{ URL('home/articles/'.$article->id.'/edit') }}">编辑</a>
								<input class='btn btn-danger' name='submit' value='删除' type="submit">
							</div>
						</form>
					</li>
					</ul>
					</div>
					</div>
					@empty
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">
			                      <span aria-disabled="true">&times;</span>
			                  </button>
						<strong>您好，</strong> 推文都被你删除了.<br><br>
					</div>
				@endforelse
				</div>
				<div class='panel-footer' style='text-align:center'><?=$page ?></div>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
@media screen and (min-width: 700px){
	.btn-group-left{position:absolute;right:20px;top:10px; }
}	
</style>
@endsection
