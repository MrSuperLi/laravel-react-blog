@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading" style='font-size:22px;color:#f7f7f7;text-align:center;background-color:#343434;padding:20px;'>文件上传</div>
				<div class="panel-body">
					<div class="col-md-10 col-md-offset-1">
						@include('errors')
						<form action="{{ url('home/upload') }}" method="post" enctype='multipart/form-data'>
							<input type='hidden' name='MAX_FILE_SIZE' value='3000000'>
							<input type='hidden' name='_token' value="{{ csrf_token() }}">
							<div clas='form-group row'>
								<div class="col-md-12">
									<label for='image-1'>图像：</label>
									<input class="form-control" id='image-1' type='file' accept='image/*' name="myFile[]"><br/>
									<p class="help-block">选择不大于3MB的图像文件</p>
								</div>
							</div>
							<div clas='form-group row'>
								<div class="col-md-12">
									<label for='image-2'>图像：</label>
									<input class="form-control" id='image-2' type='file' accept='image/*' name="myFile[]"><br/>
									<p class="help-block">选择不大于3MB的图像文件</p>
								</div>
							</div>
							<div class="form-group row">
								<div class="btn-group col-md-12 col-xs-12">
									<input class="btn btn-primary col-md-6 col-xs-6" type="submit" value="提交">
									<input class="btn btn-danger col-md-6 col-xs-6" type="reset" value="重置">
								</div>
							</div>
							<!-- <label for='upload'>图像二：</label>
							<input id='upload' type='file' name="myfile[]"><br/> -->
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection