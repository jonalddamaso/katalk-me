@extends('layouts.app')
<style type="text/css">
	#edit-post-textarea {
    max-width: 100%;
}
</style>
@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				Edit Posts
			</div>
			<div class="panel-body">
				<form action="/posts/{{ $post->id }} " method="POST">
				{{ method_field('PUT')}}

				{{ csrf_field() }}

					<input type="hidden" name="user_id" value="{{ Auth::user()->id }} ">

					<div class="form-group">
						<label for="content">Content</label>
						<textarea name="content" id="edit-post-textarea" class="form-control">{{ $post->content }} </textarea>
					</div>
					
					<input type="submit" class="btn btn-success pull-right">
				</form>
				
			</div>
		</div>
	</div>
</div>
@endsection