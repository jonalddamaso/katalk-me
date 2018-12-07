@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<span>
					Post by {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}

					<small>
						<a href="/posts/{{ $post->id}}/edit"> <i class="far fa-edit"></i></a>
					</small>
				</span>
				<span class="pull-right">
					{{ $post->created_at->diffForHumans() }}
				</span>
			</div>
			<div class="panel-body">
					{{ $post->content }}
			</div>
		</div>
	</div>
</div>
@endsection

