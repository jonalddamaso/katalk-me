<style type="text/css">
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



</style>

@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				{{ Auth::user()->firstname}}
				{{ Auth::user()->lastname}}
				
			</div>
			<div class="panel-body">
				<div class="col-sm-12 col-md-12">
					@if (session()->has('msg'))
						<p class="alert alert-success">
							{{ session()->get('msg') }}
						</p>
					@endif

					@foreach($FriendRequests as $uList)

					<div class="row" style="border-bottom:2px solid #ccc; margin-bottom:15px">
						<div class="col-md-2 pull-left">
							<img class="profileimg" src="/uploads/avatars/{{ $uList->avatar }}">
						</div>

						<div class="com-md-7 pull-left">
							<h3 style="margin:0px"><a href="">{{ ucwords($uList->firstname) }} {{ ucwords($uList->lastname) }}</a></h3>
							<p><b>Username:</b> {{ $uList->username }}</p>
							<p><b>E-mail:</b> {{ $uList->email }}</p>
						</div>
						
						<div class="col-md-3 pull-right">
							<p>
								<a href="{{ url('/accept')}}/{{$uList->firstname}}/{{ $uList->id}}" class="btn btn-info btn-sm">Confirm</a>

								<a href="{{ url('/requestRemove')}}/{{ $uList->id}}" class="btn btn-default btn-sm">Delete</a>

							</p>
						</div>							
							
						
					
					</div>
					@endforeach
				</div>
			</div>
			
		</div>
	</div>
</div>
@endsection