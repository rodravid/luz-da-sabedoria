<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Luz da Sabedoria</title>
    
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset_web('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Custom Fonts -->
    <link href="{{ asset_web('/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset_web('/fonts/fonts.css') }}" rel="stylesheet" type="text/css">
    
    <!-- Theme CSS -->
    <link href="{{ asset_web('/css/agency.min.css') }}" rel="stylesheet">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ asset_web('/vendor/html5shiv/html5shiv.js') }}"></script>
    <script src="{{ asset_web('/vendor/respond/respond.min.js') }}"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <i class="fa fa-bars"></i>
            </button>
            
            <a class="navbar-brand page-scroll" href="{{ route('home') }}">
                <img style="width: 200px;margin-top: -40px;" src="{{ asset('images/logos/logo_versao-03.png') }}">
            </a>
        </div>
        
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            @section('nav-items')
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="{{ route('home') }}">Home</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="{{ route('donate') }}">Doe com segurança!</a>
                    </li>
                </ul>
            @show
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

@yield('content')

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <span class="copyright">Copyright &copy; Luz da Sabedoria - Associação Beneficente 2017</span>
            </div>
            <div class="col-md-4">
                <ul class="list-inline social-buttons">
                    <li><a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="list-inline quicklinks">
                    <li><a href="#">Privacy Policy</a>
                    </li>
                    <li><a href="#">Terms of Use</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<script src="{{ asset_web('/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset_web('/js/minified.js') }}"></script>
<script src="{{ asset_web('/js/agency.min.js') }}"></script>
<script src="{{ asset('/js/app.js') }}"></script>

</body>

</html>