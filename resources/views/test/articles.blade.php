<div class='container'>
	<div class='row'>
		<div class="col-md-12">
			<ul class='list-group'>
				<li class='list-group-item'>
					<div class="list-group-item-heading">
						<a href="{{ URL('articles/'.$article->id) }}">
							<h4>{{ $article->title }}</h4>
						</a>
					</div>
					<div class="list-group-item-text">
						<h5>{{ $article->created_at }}</h5>
						<p>{{ $article->summary }}</p>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>