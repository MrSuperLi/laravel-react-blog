@extends('app')
@section('content')

<div class="container">
	<div class="row">
		<div class='col-md-12' id='form-container'>
		    <form  id='comment-form' role="form row" action="/editor" method='post'>
		    	<input name='_method' value='GET' type='hidden' />
		    	<input name='_token' value="{{ csrf_token() }}" type='hidden' />
		        <div class="form-group row">
		            <script type="text/plain" id="editor" name="content" style="height:400px;"></script>
		        </div>
		        <div class="form-group row">
					<div class='btn-group col-md-10  col-xs-10 col-md-offset-1 col-xs-offset-1'>
						<input name="submit" type="submit" class="btn btn-primary col-md-6 col-xs-6" value="提交">
		            	<input name="reset" type="reset" class="btn btn-danger col-md-6 col-xs-6" value="重置">
					</div>
		        </div>
		    </form>
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
@endsection