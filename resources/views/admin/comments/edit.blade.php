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

<div class='container'>
	<div class='row'>
		<div class='col-md-10 col-md-offset-1'>
			<div class="panel panel-info">
				<div class="panel-heading" style='text-align:center;background-color:#343434;color:#f7f7f7;padding:22px;font-size:22px;'>
					评论修改
				</div>
				<div class='panel-body'>
					@include('errors')
					<div class='col-md-12' id='form-container'>
						<!--评论表单-->
					    <form  id='comment-form' role="form row" action="{{ URL('home/comments/'.$comment->id) }}" method='post'>
					    	<input name='_method' value='PUT' type='hidden' />
					    	<input name='_token' value="{{ csrf_token() }}" type='hidden' />
					    	<div class="form-group row">
					    	    <label for="name" class="control-label">昵称：</label>
					    	    <input id="name" name="name" type="text" class="form-control" data-limit='s,1,15' placeholder="昵称1~15个字符" required="required" value="{{ $comment->name }}">
					    	</div>
					    	<div class="form-group row">
					    	    <label for="email" class="control-label">邮箱：</label>
					    	    <input id="email" name="email" type="email" class="form-control" data-limit='s,1,40' placeholder="邮箱1~40字符" required="required" value="{{ $comment->email }}">
					    	</div>
					        <div class="form-group row">
					            <label for="content" class="control-label"><span id='comment_label'>内容</soan>：</label>
					            <textarea id="content" style='max-width:100%;height:200px;' name="content" data-limit='s,1,350' class="form-control" placeholder="内容1~350个字符"  autocomplete='off' required="required">{{ $comment->content }}</textarea>
					        </div>
					        <div class="form-group row">
								<div class='btn-group col-md-12  col-xs-12'>
									<input name="submit" type="submit" class="btn btn-primary col-md-6 col-xs-6" value="提交">
					            	<input name="reset" type="reset" class="btn btn-danger col-md-6 col-xs-6" value="重置">
								</div>
					        </div>
					    </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src='/js/form_validate.js'></script>
<script type="text/javascript">
	document.getElementById('comment-form').onsubmit = function(){
		var validate = form_validate(this,'s')
		if (!validate[0]) {
			document.getElementById('mess').innerHTML = validate[1];
			$('#modal-mess').modal('show');
			return false;
		}
	};
</script>
@endsection