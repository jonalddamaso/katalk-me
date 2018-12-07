@extends('layouts.app')
<title>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }} </title>

<style type="text/css">
.profile-img {
	max-width: 150px;
	max-height: 150px;
	float: left;
	border: 5px solid hsla(61, 0%, 67%, 0.51);
	border-radius: 50%;
	box-shadow: 0 2px 2px rgba(0, 0, 0, 0);
	margin-right: 25px;
}

.profileimg {
	max-width: 80px;
	max-height: 80px;
	
	border: 5px solid hsla(61, 0%, 67%, 0.51);
	box-shadow: 0 2px 2px rgba(0, 0, 0, 0);
	

}

.profile-name {
	color: white;
	text-shadow: 0 2px 2px rgba(0,0,0,1);
}

.profile-name {
	color: white;
	text-shadow: 0 2px 2px rgba(0,0,0,1);
}

.row {
	border: 1px solid transparent;
}
#right-bar {
	z-index: 0px;
}

.friends-img {
	max-width: 100px;
	max-height: 100px;
	border: 2px solid #fff;
}

#header-img {
	background-image: url(https://www.kakadutourism.com/wp-content/uploads/2015/05/Yellow-Water-Billabong-early-morning-Photo-by-Paul-Arnold1.jpg);
	background-repeat: no-repeat;
	max-height: 100%;
	max-width: 100%;
}



#post-by-header {
	background-color: hsla(166, 56%, 42%, 0.83);
}
#feeds-header {
	background-color: hsla(166, 56%, 42%, 0.83);
	text-shadow: 0 2px 2px rgba(0,0,0,1);
	color: white;
}

#feeds-body {
	background-color: hsla(166, 56%, 68%, 0.43);
}

#post-container {
	box-shadow: -6px 4px 10px -3px rgba(0,0,0,0.86);
}
#propic-icon {
	color: lightgrey;
	text-shadow: 0 2px 2px rgba(0,0,0,1);
}

#propic-btn {
	background-color: hsla(120, 17%, 68%, 0.26);
	color: white;
}

#create-post{
	max-width: 100%;
}

</style>

@section('header')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading" id="header-img">
					<div class="panel-body">
						<img class="profile-img" src="/uploads/avatars/{{ Auth::user()->avatar }}">
						<h2 class="profile-name"><strong>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</strong></h2>
						
						<form enctype="multipart/form-data" action="/profile-image" method="POST">
							<label id="propic-icon">Upload Profile Image</label>
							<input type="file" name="avatar" id="propic-upload">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="submit" class="pull-right btn btn-sm btn-default" id="propic-btn">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>

@endsection

@section('content')
<div class="container-fluid">
		
	<div class="row">
			<div class="col-md-4 col-md-offset-1">
	@if( Auth::id() == 0 )
		<a href="/register"></a>
	@else
				<div class="row">
					<div class="col-md-12">
						<div class="row" style="display: inline-grid;">
								<!-- Your Profile info -->
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">
										<i class="fas fa-user-circle"></i> Profile Information
									</div>
									<div class="panel-body" style="text-align: justify;">
										<h5><i class="far fa-user"></i>  {{ Auth::user()->username }}</h5>
										<h5><i class="far fa-envelope"></i>  {{ Auth::user()->email }} </h5>
										<h5><i class="fas fa-mobile-alt"></i>  {{ Auth::user()->phone }} </h5>
										<h5><i class="fas fa-globe-asia"></i> </i>  {{ Auth::user()->address }} </h5>
										<h5><i class="fas fa-info-circle"></i>  {{ Auth::user()->bio }} </h5>
										<a class="btn btn-success btn-sm" href="/profile/{id}/editProfile" role="button" class="add_friend">Edit Profile</a>
									</div>
								</div>
							</div>

								<!-- Your Friends -->
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading" id="feeds-header">
										<h4>Friends</h4>
									</div>
									<div class="panel-body">
										<div class="col-sm-12 col-md-12">
											
											@foreach(Auth::user()->friends() as $uList)

											<div class="row" style="border-bottom:2px solid #ccc; margin-bottom:15px">
												<div class="col-md-3 pull-left">
													<img class="profileimg" src="/uploads/avatars/{{ $uList->avatar }}">
												</div>

												<div class="com-md-7 pull-left">
													<h3 style="margin:0px"><a href="/profile/{{ $uList->username }}">{{ ucwords($uList->firstname) }} {{ ucwords($uList->lastname) }}</a></h3>
													<p><b>Username:</b> {{ $uList->username }}</p>
													<p><b>E-mail:</b> {{ $uList->email }}</p>
												</div>				
											</div>
											@endforeach
										</div>
									</div>
								</div>
							</div>
								<!-- Your Photos -->
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">
										<p><i class="far fa-image"></i> Photos <a href="#" class="pull-right">Add Photos</a> </p>
									</div>
									<div class="panel-body">
										<img class="friends-img" src="https://fundart.com.br/wp-content/uploads/2017/11/fotografia.jpg">
										<img class="friends-img" src="https://iso.500px.com/wp-content/uploads/2016/11/stock-photo-159533631-1500x1000.jpg">
										<img class="friends-img" src="http://taguephoto.com/wp-content/uploads/2016/01/Ruffwear_Man_and_Dog_Sunset.jpg">
										<img class="friends-img" src="https://i.amz.mshcdn.com/GX-vPboKWmibaUDUFo_bOxJ9hlg=/1200x627/2013%2F04%2F10%2Fb3%2Fmandogsbest.66c11.jpg">
										<img class="friends-img" src="https://fundart.com.br/wp-content/uploads/2017/11/fotografia.jpg">
										<img class="friends-img" src="https://iso.500px.com/wp-content/uploads/2016/11/stock-photo-159533631-1500x1000.jpg">
										<img class="friends-img" src="http://taguephoto.com/wp-content/uploads/2016/01/Ruffwear_Man_and_Dog_Sunset.jpg">
										<img class="friends-img" src="https://i.amz.mshcdn.com/GX-vPboKWmibaUDUFo_bOxJ9hlg=/1200x627/2013%2F04%2F10%2Fb3%2Fmandogsbest.66c11.jpg">
										<img class="friends-img" src="https://fundart.com.br/wp-content/uploads/2017/11/fotografia.jpg">
										<img class="friends-img" src="https://iso.500px.com/wp-content/uploads/2016/11/stock-photo-159533631-1500x1000.jpg">
										<img class="friends-img" src="http://taguephoto.com/wp-content/uploads/2016/01/Ruffwear_Man_and_Dog_Sunset.jpg">
										<img class="friends-img" src="https://i.amz.mshcdn.com/GX-vPboKWmibaUDUFo_bOxJ9hlg=/1200x627/2013%2F04%2F10%2Fb3%2Fmandogsbest.66c11.jpg">

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- FEEDs -->

			<div class="col-md-6">
				<div class="row">
					
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading" id="feeds-header">
								Create Posts
							</div>
							<div class="panel-body">
								<form action="/posts" method="POST">
									{{ csrf_field() }}
									<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

									<div class="form-group">
										<label for="content">Content</label>
										<textarea name="content" class="form-control" id="create-post"  placeholder="What is on your mind, {{ Auth::user()->firstname }}? "></textarea>
									</div>
								
									<input type="submit" id="create-btn" class="btn btn-success pull-right">
								</form>

								
							</div>
						</div>

						<div class="panel panel-default">

							<div class="panel-heading" id="feeds-header">
								<h3>Your Posts</h3>
							</div>

							<div class="panel-body" id="feeds-body">


								<!-- user -->
								@forelse(Auth::user()->posts as $post)

									@if($post->user_id == Auth::id())
										<!-- pattern -->
										<div class="panel panel-default"  id="post-container">
											<div class="panel-heading post" data-postid="{{ $post->id }}" id="post-by-header">
												<span>
													Post by: <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width: 32px; height: 32px; left: 10px; border-radius: 50%"> {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
												
														<!-- LIKES -->
													<div class="interaction pull-right">
														<a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post!' : 'Like' : 'Like' }} </i></a> |
														<a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You Dont like this post' : 'Dislike' : 'Dislike' }} </i></a>
														
													</div>
														<p style="margin-left: 100px; margin-top: -10px;"><small>{{ $post->created_at->diffForHumans() }}</small></p> 

													


												</span>
											</div>
											<div class="panel-body" id="post-body">
												<div id="post_{{$post->id}}">
													<b><h4>{{ $post->content }}</h4></b>
												</div>
												<textarea name="content" id="content-text" class="form-control" style="display: none">{{ $post->content }}</textarea>

												<br>
												<!-- EDIT -->
												
												<form action="/posts/{{ $post->id }}" method="POST" style="display: inline-flex;" class=" pull-right">
													{{ csrf_field() }}
													{{ method_field('PATCH') }}

													<small class="pull-left">
														<a href="/posts/{{ $post->id}}/edit" class="btn btn-info btn-sm"> <i class="far fa-edit"></i></a>
														
													</small>
												</form>



												<!-- end of edit -->

												<!-- DELETE -->
												<form action="/posts/{{ $post->id }} " method="POST" style="display: inline-flex;" class=" pull-right">
													{{ csrf_field() }}
													{{ method_field('DELETE') }}


													<button class="btn btn-danger btn-sm">
														<i class="far fa-trash-alt"></i>
													</button>

												</form>
													<!-- end of delete -->
											</div>

											<hr>

											<!-- start of comment -->
											@foreach ($post->comments as $comment)
												<div class="panel panel-default" style="margin: 0; border-radius: 25px;">
													<div class="panel-body">
														{{ $comment->comment }}
														<p class="pull-right"><small>Commented by: <img src="/uploads/avatars/{{ $comment->user->avatar }}" style="width: 32px; height: 32px; left: 10px; border-radius: 50%"> {{ $comment->user->username}} </small></p>
														<br>
														<br>
														<a href="#" class="pull-left" style="margin-top: -10px; display: flex;"><small>Like</small></a>

														<a href="#" class="pull-left" style="margin-top: -10px; margin-left: 25px;"><small>Reply</small></a>

														<p class="pull-right" style="margin-top: -10px; margin-left: 100px; z-index: 2px"><small>{{ $comment->created_at->diffForHumans() }}</small></p> 
													
													</div>
												</div>
											@endforeach
											<div class="panel panel-default" style="margin: 0; border-radius: 0;">
												<div class="panel-body" id="post-body">
													<form action="{{ url('/comment') }}" method="POST" style="display: flex">
														{{ csrf_field() }}
														{{ method_field("POST") }}
														<input type="hidden" name="post_id" value="{{ $post->id }}">
														<input type="text" name="comment" placeholder="Enter your comment" class="form-control" style="border-radius: 0;">
														<input type="submit" value="Comment" class="btn btn-primary" style="border-radius: 0;">
													</form>
												</div>
											</div>
										</div>


									@endif

								@empty
									<div class="row">
										<div class="col-md-6 col-md-offset-3 text-center">
											No Posts
										</div>
									</div>
								@endforelse
									
								
								</div>	


							

						</div>
					</div>
				</div>
			</div>

	</div>
@endif
</div>
@endsection


<script src="{{ asset('/js/like.js') }}"></script>

<script type="text/javascript">
	var token = '{{ Session::token() }} ';
	var urlLike = '{{ route('like') }} ';
</script>



