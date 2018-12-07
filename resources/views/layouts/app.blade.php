<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.username', 'KATALK') }}</title>

    <!-- Styles -->
    <style type="text/css">
        .notify{
            color: grey;         
        }
        #navbar-button {
             color: white;
                padding: 0 25px;
                font-size: 10px
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                background-color: hsla(166, 56%, 42%, 0.83);
                border-radius: 50px;
                box-shadow: 0 2px 2px rgba(0, 0, 0, 0);
                border: 2px solid hsla(97, 92%, 11%, 0.78);
                margin-top: 10px;
        }
        #navbar-button:hover {
            color: black;
                padding: 0 25px;
                font-size: 1.2rem;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                background-color: hsla(97, 92%, 86%, 0.48);
                border-radius: 50px;
                box-shadow: 0 2px 2px rgba(0, 0, 0, 0);
                border: 2px solid hsla(97, 92%, 11%, 0.78);
                 margin-top: 10px;
        }

    </style>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" id="nav-masterHeader">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                     @guest
                            
                     @else
                    <a class="navbar-brand" href="{{ url('/findFriends')}}">
                    Find Friends
                    </a>
                    @endguest

                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                 
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}" id="navbar-button">Login</a></li>
                            <li><a href="{{ route('register') }}" id="navbar-button">Register</a></li>
                        @else
                             <li>
                                <a href="/profile/{username}" style="position: relative; padding-left: 50px;"><img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width: 32px; height: 32px; position: absolute; top: 10px; left: 10px; border-radius: 50%"> {{Auth::user()->firstname}}</a>
                            </li>
                            <li>
                                <a href="{{ url('/profile/{username}/home') }}">Home</a>
                            </li>
                            <li>
                                <a href="{{ url('/requests') }} "> <i class="fas fa-bell"></i> <span class="notify">{{DB::table('friendships')->where('status', 0)->where('user_requested', Auth::user()->id)->count()}}</span> </a>
                            </li>
                           
                            <li>
                                <a href="{{url('/friends')}}"><i class="fas fa-user-friends"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="/profile/{{Auth::user()->username}}"><i class="fa fa-btn fa-user"></i> My Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/requests') }} "> <i class="fas fa-bell"></i> Notifications ( {{DB::table('friendships')->where('status', 0)->where('user_requested', Auth::user()->id)->count()}} ) </a>
                                    </li>
                                    <li>
                                        <a href="{{url('/friends')}}"><i class="fas fa-user-friends"></i> Friends</a>
                                    </li>
   
                                    <hr>
                                    <li>
                                        <a href="/posts/create">Create Post</a>
                                    </li>
                                    
                                    <hr>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                           <i class="fas fa-sign-out-alt"></i> Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                  
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @yield('header')
     
        @yield('content')



       
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
