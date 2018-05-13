@if(session('status'))
<div class="alert alert-success">
	<button type='button' data-dismiss='alert' class='close'>&times;</button>
	<strong>Completed!</strong>执行完成！<br><br>
</div>
@elseif (count($errors) > 0)
<?php $errors =$errors->all(); ?>
<div class="alert alert-danger">
	<button type='button' data-dismiss='alert' class='close'>&times;</button>
	<strong>Sorry!</strong>执行出错！<br><br>
	<ul>
		@foreach ($errors as $error)
		<li><?=$error?></li>
		@endforeach
	</ul>
</div>
@endif