@extends('layouts.app')

@section('content')
<div class="row">
	@forelse($posts as $post)
	<div class="col-md-4 col-md-offset-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<span>{{ $post->user->firstname }} </span>
				<span class="pull-right">
					{{ $post->created_at->diffForHumans()}}
				</span>
			</div>
			<div class="panel-body">
				{{ $post->shortContent }}
				<a href="/posts/{{ $post->id }}">Read more...</a>
			</div>

			<div class="panel-footer clearfix" style="background-color: white">
				@if($post->user_id == Auth::id())
				<form action="/posts/{{ $post->id }} " method="POST" class="pull-right" style="margin-left: 25px">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}

					<!-- DELETE -->
					<button class="btn btn-danger btn-sm">
						<i class="far fa-trash-alt"></i>
					</button>
				</form>
				@endif
				<form class="pull-right">
					<!-- LIKES -->
					<i class="far fa-heart"></i>
				</form>
			</div>
		</div>
	</div>

	@empty
	<div class="row">
		<div class="col-md-6 col-md-offset-3 text-center">
			No Posts
		</div>
	</div>
	

	@endforelse
</div>
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		{{ $posts->links()}}
	</div>
</div>


@endsection

