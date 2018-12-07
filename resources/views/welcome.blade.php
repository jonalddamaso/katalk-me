<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>JFCM</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- ICON -->
        <link rel="icon" type="image/gif/png" href="../uploads/katalk-logov2.png">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
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
            }

            .links > a:hover {
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
            }



            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    <img src="../uploads/katalk-logov2.png">
                </div>

                <div class="links">
                  @if (Route::has('login'))
                <div class="top-center links">
                    @auth
                        <a href="{{ url('/profile/{username}/home') }}">KATALK</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                       <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif
                </div>
            </div>
        </div>
    </body>
</html>
