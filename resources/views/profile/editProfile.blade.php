@extends('layouts.app')
<style type="text/css">
	.about-me{
		max-width: 100%;
	}
</style>
@section('content')
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3><b>{{ Auth::user()->firstname}} {{ Auth::user()->lastname}}</b></h3>
			</div>
			<div class="panel-body">
					<h4>Edit Profile</h4>
				<div class="col-md-12">

					<form action="/profile/{username}/editProfile" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					{{ method_field("PATCH")}}

						
						<div class="form-group">
							First Name: <input name="firstname" type="text" class="form-control" value="{{ Auth::user()->firstname }}"> 
							Last Name: <input name="lastname" type="text" class="form-control" value="{{ Auth::user()->lastname }}">
							Username: <input name="username" type="text" class="form-control" value="{{ Auth::user()->username }}" disabled> 
							Email: <input name="email" type="text" class="form-control" value="{{ Auth::user()->email}}" disabled> 
							Address: <input name="address" type="address" class="form-control" value="{{ Auth::user()->address }}">
							Mobile: <input name="phone" type="pnone" class="form-control" value="{{ Auth::user()->phone }}">
							About me: <textarea name="bio" type="text" class="form-control about-me">{{ Auth::user()->bio }}</textarea> 

						</div>
						
						<input type="submit" class="btn btn-success pull-right">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection