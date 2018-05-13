<a id='publish' href='#form-container' class='btn btn-primary' style='float:right'>发表评论</a>
<p>评论：</p>
<div class='comments-container row'>
@forelse ($comments as $comment)
<div id="comment{{ $comment->id }}" class='tabs list-group col-md-12'>
    <div style="border-left:4px solid #f9635f;line-height:26px;" class="list-group-item col-md-12">
        <div class="list-group-item-heading">
        	<?php
        		$color   = '#f9635f';
        		$img     = '/images/admin.png';
        		$name    = $adminname;
        		if(!$comment->admin){
        			$color   = '#232323';
            		$img     = '/images/user.png';
            		$name    = $comment->name;
        		}
        	?>
        	<img src="{{ $img }}" class="img-circle">
        	<span style="color:{{ $color }};">{{ $name }}</span>：
        </div>
        <p style='margin:10px auto;white-space:pre-wrap;color:#a94442;' class="list-group-item-text"><?=nl2br($comment->content)?></p>
        <div class='list-group-item-footer'>
			<span>{{$comment->created_at}}</span>&nbsp;&nbsp;
			<a class='comment-reply' href="javascript:void(0)" data-commentid="{{ $comment->id }}" data-name="{{ $name }}">回复</a>
			<form action="{{ URL('home/comments/'.$comment->id) }}" style='display:inline;' method='post'>
				<input name='_method' value='DELETE' type="hidden">
				<input name='_token' value='{{ csrf_token() }}' type="hidden">
				<div class="btn-group btn-group-left">
					<a class="btn btn-primary" data-commentid='{{ $comment->id }}' href="{{ URL('home/comments/'.$comment->id.'/edit') }}">编辑</a>
					<input class='btn btn-danger' name='submit' value='删除' type="submit">
				</div>
			</form>
		</div>
    </div>
</div>
@empty
<pre style="text-align:center;padding:30px;"><h4>暂无评论</h4></pre>
@endforelse
</div>
<style type="text/css">
	.comments-container{
		margin:20px auto;
		padding:20px;
		border-top:4px solid #337ab7;
		border-bottom:4px solid #337ab7;
	}
	.list-group-item-heading img{transition:all 0.5s ease;}
    .list-group-item-heading img:hover{transform:rotate(360deg);trasition:all 0.5s ease;}
    @media screen and (min-width: 700px){
		.btn-group-left{position:absolute;right:20px;top:10px;}
	}
</style>