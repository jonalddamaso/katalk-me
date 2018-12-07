@extends('layouts.app')
<style type="text/css">
 #login-header {
    background-color: hsla(166, 56%, 42%, 0.83);
    text-shadow: 0 2px 2px rgba(0,0,0,1);
    color: white;
     box-shadow: -3px 4px 10px -5px rgba(0,0,0,0.5);
 } 
 #login-body {
    background-color: hsla(166, 56%, 42%, 0.83);
    text-shadow: 0 2px 2px rgba(0,0,0,1);
    color: white;
 }

#login-container {
    box-shadow: -6px 4px 10px -3px rgba(0,0,0,0.86);
}

#btn-login {
    background-color: rgba(47, 167, 139, 0.83);
}
#btn-login:hover{
    background-color: hsla(166, 56%, 42%, 0.3);
    color: black;
}
</style>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default" id="login-container">
                <div class="panel-heading" id="login-header">Login</div>

                <div class="panel-body text-center">
                            <img src="../uploads/katalk-logov2.png" class="mx-auto">
                       
                           <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username" class="col-md-4 control-label">Username: </label>

                                <div class="col-md-6">
                                    <input id="username" type="username" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                    @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2 pull-left">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button type="submit" class="btn btn-primary pull-left" id="btn-login">
                                        Login
                                    </button>

                                    <a class="btn btn-link pull-right" href="{{ route('password.request') }}">
                                        Forgot Your Password?
                                    </a>
                                </div>
                            </div>
                        </form>

                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
