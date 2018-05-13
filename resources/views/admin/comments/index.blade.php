@extends('admin.app')
@section('content')

<div class='container'>
	<div class='row'>
		<div class='col-md-10 col-md-offset-1'>
			<div class="panel panel-info">
				<div class="panel-heading" style='text-align:center;background-color:#343434;color:#f7f7f7;padding:22px;font-size:22px;'>
					评论列表
				</div>
				<div class='table-responsive'>
					<table class='table table-striped table-hover table-bordered'>
						<thead>
							<tr><th>昵称</th><th>管理员</th><th>内容</th><th>来源</th><th colspan='2'>操作</th></tr>
						</thead>
						<tbody>
							<tr><td colspan='6'>
							@include('errors')
							</td></tr>
						@foreach($comments as $comment)
							<tr>
								<td>{{ stripslashes($comment->name) }}</td>
								<td>{{ $comment->admin }}</td>
								<td><?=mb_substr($comment->content,0,10).'…'?></td>
								<td>
									<a href="{{ URL('home/articles/'.$comment->article_id.'#comment'.$comment->id) }}">{{ \App\Article::find($comment->article_id)->title }}</a>
								</td>
								<td>
									<a class="btn btn-primary" data-commentid='{{ $comment->id }}' href="{{ URL('home/comments/'.$comment->id.'/edit') }}">编辑</a>
								</td>
								<td>
									<form action="{{ URL('home/comments/'.$comment->id) }}" style='display:inline;' method='post'>
										<input name='_method' value='DELETE' type="hidden">
										<input name='_token' value='{{ csrf_token() }}' type="hidden">
										<input class='btn btn-danger' name='submit' value='删除' type="submit">
									</form>
								</td>
							</tr>
						@endforeach
							<tr>
								<td colspan='6'><?=$page ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	
</style>
@endsection