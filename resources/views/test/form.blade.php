@extends('app')
@section('content')
<form action="http://127.0.0.2/editor?action=uploadimage" method="post" enctype='multipart/form-data'>
	<input name='_method' value="GET" type='hidden' />
	<input name='_token' value="{{ csrf_token() }}" type='hidden' />
	<input id='upload' type='file' name="upfile"  title='图像一'><br/>
	<input  type='submit' value='上传文件'>
</form>

<br />
<br />
<br />
<form action="http://127.0.0.2/editor" method="get">
	<input name='_token' value="{{ csrf_token() }}" type='hidden' />
	<input name="start" value="0" type="hidden">
	<input name="size" value="20" type="hidden">
	<input  type='submit' value='列出图像'>
	<input  type='hidden' name="action" value='listimage'>
</form>
@endsection