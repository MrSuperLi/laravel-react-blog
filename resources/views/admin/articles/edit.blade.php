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
		<div class="col-md-12 col-xs-12">
			<div class="panel panel-info">
				<div class="panel-heading" style='text-align:center;background-color:#343434;color:#f7f7f7;padding:22px;font-size:22px;'>推文修改</div>
					<div class="panel-body">
					@include('errors')
					<div class='row'>
						<div class='col-md-12 col-xs-12'>
							<form id='arctile-form' method='post' action="{{ URL('home/articles/'.$article->id) }}">
								<input name='_method' type='hidden' value='PUT' />
								<input name='_token' type='hidden' value="{{ csrf_token() }}" />
								<div class="form-group row">
				                    <label for="title" class="control-label col-md-1 col-xs-1">标题:</label>
				                    <div class="col-md-11 col-xs-11">
				                        <input id='title' value="{{$article->title}}" name="title" type="text" autocomplete="off" data-limit='s,1,100' class="form-control" placeholder="标题1~100字符" required="required">
				                    </div>
				                </div>
				                <div class="form-group row">
				                    <label for="summary" class="control-label col-md-1 col-xs-1">摘要:</label>
				                    <div class="col-md-11 col-xs-11">
				                        <input id='summary' value="{{$article->summary}}" autocomplete="off" name="summary" type="text" data-limit='s,1,100' class="form-control" placeholder="摘要1~100字符" required="required">
				                    </div>
				                </div>
				                <div class="form-group row">
				                    <label for="body" class="control-label col-md-1 col-xs-1">内容:</label>
				                    <div class="col-md-11 col-xs-11">
				                    	<script type="text/plain" id="editor" name="body" style="height:400px;" required="required"><?=$article->body?></script>
				                    </div>
				                </div>
				                <div class="form-group row">
				                    <div class="btn-group col-md-12 col-xs-12">
				                        <input id="submit" name="submit" type="submit" class="btn btn-primary col-md-6 col-xs-6" value="更新">
				                        <input id="reset" name="reset" type="reset" class="btn btn-danger col-md-6 col-xs-6" value="重置">
				                    </div>
				                </div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
	var ue = UE.getEditor('editor');
	ue.ready(function(){
		ue.execCommand('serverparam',{
			'X-XSRF-TOKEN':$.cookie('XSRF-TOKEN'),
			'_method':'GET'
		});
	});
</script>
<script type="text/javascript" src='/js/form_validate.js'></script>
<script type="text/javascript">
	document.getElementById('arctile-form').onsubmit = function(){
		var validate = form_validate(this,'s',false)
		if (!validate[0]) {
			document.getElementById('mess').innerHTML = validate[1];
			$('#modal-mess').modal('show');
			return false;
		}
	};
</script>
@endsection
