<!DOCTYPE html>
<html lang="ja">
<head>
    {{--   favicon--}}
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Gear Lab</title>
    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/theme.css')}}" rel="stylesheet">
    <!-- Custm styles for this template -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700,100' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:300,700,900,500' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.0.7/typicons.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/pushy.css')}}">
    <link rel="stylesheet" href="{{asset('css/masonry.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('css/odometer-theme-default.css')}}">

    <script>
        window.odometerOptions = {
            selector: '.odometer',
            format: '(,ddd)', // Change how digit groups are formatted, and how many digits are shown after the decimal point
            duration: 13000, // Change how long the javascript expects the CSS animation to take
            theme: 'default'
        };
    </script>
</head>
<body>
<div id="app">
    <nav class="pushy pushy-left">
        <div class="container">


            <a class="navbar-brand" href="{{ url('/') }}">
                {{ 'GearLab.' }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <header id="home">
        <div class="container-fluid">
            <!-- change the image in style.css to the class header .container-fluid [approximately row 50] -->
            <div class="container">

                <div class="jumbotron">
                    <h1><small>キャンプを追求しよう！</small>
                        <h1>Gear Lab</h1></h1>

                    <p>
                        <a class="btn btn-success btn-lg  btn-round" href="{{url('/resume')}}" role="button">
                            Resume
                            <i class="fa fa-arrow-circle-o-right "></i> </a>
                        <a  class="btn btn-primary btn-lg  btn-round" target="_blank" href="#concept" target="_blank" class="btn btn-lg btn-primary" role="button">
                            Concept
                        </a>
                        <a class="btn btn-danger btn-lg btn-round" href="{{url('/gears')}}" role="button">Experience <i
                                class="fa fa-arrow-circle-o-right"></i> </a>

                        {{--                        <a target="_blank"  href="{{ route('register') }}"  target="_blank" class="btn btn-lg btn-success" role="button">--}}
                        {{--                           Register--}}
                        {{--                        </a>--}}
                    </p>
                </div>
            </div>
        </div>
    </header>
    <section id="about" class="number wow fadeInUp" data-wow-delay="300ms">
        <!-- change the image in style.css to the class .number .container-fluid [approximately row 102] -->

        <div class="container-fluid" id="concept">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 opaline col-md-offset-6">
                        <div class="row">
                            <div class="col-md-offset-1 col-md-10">
                                <h2>コンセプト
                                    <hr>
                                </h2>
                                <h5>自分にあったキャンプギアを見つけ出そう</h5>
                            </div>
                        </div>
                        <div class="row text-center">
                            <!-- set the numbers in assets/js/scripts.js  -->
                            <p align="center">自分にあったキャンプギアの準備で困ったことはないでしょうか？</p>
                            <p align="center">友達やキャンプ場であった他の人の道具、</p>
                            <p align="center">はたまたYoutubeで気になる道具を見つけ出した経験はあるでしょう。</p>
                            <hr>
                            <strong align="center">このサイトでは自分のキャンプギアを共有や理想のキャンプの実現を達成するキャンプギアを見つけ出しやすくすることができます!</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section id="feat">
        <div class="container">
            <div class="row features">
                <h2 align="center">機能</h2>
                <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="100ms">
                    <img src={{asset('/img/share.svg')  }} width=15% alt="">
                    <h4>お気入りのキャンプギア共有</h4>
                    <p>お気に入りのキャンプギアを共有できます</p>
                </div>
                <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="300ms">
                    <img src={{asset('/img/search.svg')  }} width=15% alt="">
                    <h4>キャンプギアの検索</h4>
                    <p>理想のキャンプギアを探せます</p>
                </div>
                <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="500ms">
                    <img src={{asset('/img/follow.svg')  }} width=15% alt="">
                    <h4>フォロー機能</h4>
                    <p>気になるギアを上げているキャンパーをフォローできます。</p>

                    <p></p>
                </div>
            </div>
        </div>
    </section>


</div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3>Gear Lab</h3>
                <p>© 2020 Eiji Takahashi. Designed and Developed by <a target="_blank"
                                                                       href="http://www.themeinthebox.com">ThemeintheBox.com</a>
                </p>
            </div>
            <div class="col-md-4">
                <p class="text-right social"><i class="typcn typcn-social-facebook-circular"></i><i
                        class="typcn typcn-social-twitter-circular"></i><i
                        class="typcn typcn-social-tumbler-circular"></i><i
                        class="typcn typcn-social-github-circular"></i><i
                        class="typcn typcn-social-dribbble-circular"></i></p>
            </div>
        </div>
    </div>
</footer>
</body>

<div></div>
<script src="{{asset('js/odometer.js')}}"></script>
</html>
