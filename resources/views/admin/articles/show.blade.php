@extends('admin.app')
@section('content')

<!--模态框-->
<div class="modal fade" id="modal-mess" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">
                	<span>&times;</span>
                </button>
                <div class="modal-title">提示：</div>
            </div>
            <div class="modal-body">
                <p id='mess'>请规范输入评论。</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">确定</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
	<div class="row">
		<div id='container-body' class="col-md-10 col-md-offset-1">
			<!--异常部分-->
			@include('errors')
			<!--文章部分-->
			<div class="panel panel-info">
			<div class="panel-heading" style='text-align:center;background-color:#343434;color:#f7f7f7;padding:22px;font-size:22px;'>
				<a class='btn btn-success'style='left:25px;position:absolute;top:35px;' href="{{ URL('home/articles/'.$article->id.'/edit') }}">编辑</a>
				<h3>{{ $article->title }}</h3>
			</div>
				<div class="panel-body">
					<div class='row'>
						<div class="col-md-12">
							<ul class='list-group'>
							<li class='list-group-item'>
								<div class="list-group-item-heading">
									<h4 style='color:#395889'>{{ $article->title }}</h4>
								</div>
								<div class="list-group-item-text">
									<h5>{{ $article->created_at }}</h5>
									<p style='line-height:24px;'><strong>摘要：</strong>{{ $article->summary }}</p>
								</div>
								<div class="list-group-item-text">
									<div id="articleBody"><?=$article->body?></div>
								</div>
							</li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<!--评论列表-->
			<div class='col-md-12'>
				@include('admin.comments.comments',['comments'=>$article->comments])
			</div>
			<div class='col-md-12' id='form-container'>
				<!--评论表单-->
			    <form  id='comment-form' role="form row" action="{{ URL('home/comments/') }}" method='post'>
			    	<input name='_method' value='POST' type='hidden' />
			    	<input name='_token' value="{{ csrf_token() }}" type='hidden' />
			    	<input name='article_id' value="{{ $article->id }}" type='hidden' />
			        <div class="form-group row">
			            <label for="content" class="control-label"><span id='comment_label'>发表评论</soan>：</label>
			            <textarea id="content" style='max-width:100%;height:200px;' name="content" data-limit='s,1,350' class="form-control" placeholder="内容1~350个字符"  autocomplete='off' required="required"></textarea>
			        </div>
			        <div class="form-group row">
						<div class='btn-group col-md-12 col-xs-12'>
							<input name="submit" type="submit" class="btn btn-primary col-md-6 col-xs-6" value="提交">
			            	<input name="reset" type="reset" class="btn btn-danger col-md-6 col-xs-6" value="重置">
						</div>
			        </div>
			    </form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="/ueditor/ueditor.parse.min.js"></script>
<script type="text/javascript">
	uParse("#articleBody",{rootPath: '/ueditor/'});
</script>
<script type="text/javascript" src="/js/form_validate.js"></script>
<script type="text/javascript">
	document.getElementById('comment-form').onsubmit = function(){
		var validate = form_validate(this,'s')
		if (!validate[0]) {
			document.getElementById('mess').innerHTML = validate[1];
			$('#modal-mess').modal('show');
			return false;
		}
	};
	$('#publish').click(function(){
		$('#comment_id').remove();
		document.getElementById('comment_label').innerHTML = this.innerHTML;
		document.getElementById('content').value = '';
		document.getElementById('container-body').appendChild(document.getElementById('form-container'));
	});
	$('.comment-reply').click(function(){
		document.getElementById('comment_label').innerHTML = this.innerHTML;
		if (!document.getElementById('comment_id')) {
			var input = document.createElement('input');
			input.id = 'comment_id';
			input.setAttribute('type','hidden');
			input.setAttribute('name',input.id);
			input.setAttribute('value',this.dataset.commentid);
			document.getElementById('comment-form').appendChild(input);
		}else{
			document.getElementById('comment_id').value = this.dataset.commentid;
		}
		document.getElementById('content').value = '回复 '+this.dataset.name+': ';
		this.parentNode.appendChild(document.getElementById('form-container'));
	});
</script>
@endsection
