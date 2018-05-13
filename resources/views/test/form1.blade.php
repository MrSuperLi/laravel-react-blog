@extends('app')
@section('content')
<div class="container">
	<div class="row">
		<div class='col-md-12' id='form-container'>
		    <form  id='comment-form' role="form row" action="{{ URL('test') }}" method='get'>
		    	<input name='_method' value='GET' type='hidden' />
		    	<input name='_token' value="{{ csrf_token() }}" type='hidden' />
		        <div class="form-group row">
		            <label for="name" class="control-label">昵称：</label>
		            <input id="name" name="name" type="text" class="form-control" data-limit='s,1,15' placeholder="昵称1~15个字符" required="required" value="">
		        </div>
		        <div class="form-group row">
		            <label for="email" class="control-label">邮箱：</label>
		            <input id="email" name="email" type="email" class="form-control" data-limit='s,1,40' placeholder="邮箱1~40字符" required="required" value="">
		        </div>
		        <div class="form-group row">
		            <label for="content" class="control-label">内容：</label>
		            <textarea id="content" style='max-width:100%;height:200px;' name="content" data-limit='s,1,350' class="form-control" placeholder="内容1~350个字符"  autocomplete='off' required="required"></textarea>
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
@endsection