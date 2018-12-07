<title>Home</title>
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

#create-post-header {
    background-color: hsla(166, 56%, 42%, 0.83);
}

#post-by-header {
    background-color: hsla(166, 56%, 42%, 0.83);
}
#feeds-header {
    background-color: hsla(166, 56%, 42%, 0.83);
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
#create-post-textarea {
    max-width: 100%;
}


</style>

@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! <b>{{ Auth::user()->firstname}}</b>
                </div>
            </div>
        </div>
        <div class="col-md-7">
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
                                        <textarea name="content" class="form-control" id="create-post-textarea"  placeholder="What is on your mind, {{ Auth::user()->firstname }}? "></textarea>
                                    </div>
                                
                                    <input type="submit" class="btn btn-success pull-right">
                                </form>
                                
                            </div>
                        </div>
            <div class="panel panel-default">
                <div class="panel-heading" id="feeds-header">
                    All Post and Comments
                </div>
                <div class="panel-body">
                    <!-- user -->
                    @forelse($posts as $post)

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
                                            <button class="btn btn-sm" id="btn-edit" type="button" onclick="edit({{ $post->id }})"><i class="far fa-edit"></i></button>
                                            <button type="submit" id="save-edit" class="btn btn-success btn-sm pull-right" style="display: none"><i class="far fa-save"></i></button>
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


                        @else

                            <!-- friends -->
                            <div class="panel panel-default" id="post-container">
                                <div class="panel-heading" id="post-by-header">
                                    <span>
                                        Post by <img src="/uploads/avatars/{{ $post->user->avatar }}" style="width: 32px; height: 32px; left: 10px; border-radius: 50%"> {{ $post->user->firstname }} {{ $post->user->lastname }}

                                    </span>
                                        

                                        <!-- LIKES -->
                                    <span class="pull-right">
                                        <i class="far fa-heart"></i>
                                    </span>

                                    <p style="margin-left: 100px; margin-top: -10px;"><small>{{ $post->created_at->diffForHumans() }}</small></p> 

                                </div>
                                <div class="panel-body" id="post-content">
                                    <b><h4>{{ $post->content }}</h4></b>
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

                                @if (Auth::check())
                                    <div class="panel panel-default" style="margin: 0; border-radius: 0;">
                                        <div class="panel-body">
                                            <form action="{{ url('/comment') }}" method="POST" style="display: flex">
                                                {{ csrf_field() }}
                                                {{ method_field("POST") }}
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <input type="text" name="comment" placeholder="Enter your comment" class="form-control" style="border-radius: 0;">
                                                <input type="submit" value="Comment" class="btn btn-primary" style="border-radius: 0;">
                                            </form>
                                            <!-- end of comment -->
                                        </div>
                                    </div>
                                @endif
                                <br>
                                
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
@endsection
