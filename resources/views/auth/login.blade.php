<!DOCTYPE html>
<html lang="en">
<head>
    <title>NetStart - Provedor de Internet</title>

    <!-- BEGIN META -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Provedor,Internet, igarassu, fibra, otica, fibra otica">
    <meta name="description" content="Netstart, o Primeiro provedor de internet de Igarassu">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>

    <!-- BEGIN STYLESHEETS -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
    <link href="{{ asset('/assets/css/theme-default/bootstrap.css')}}" rel="stylesheet">
    <link href="{{ asset('/assets/css/theme-default/materialadmin.css')}}" rel="stylesheet">
    <link href="{{ asset('/assets/css/theme-default/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('/assets/css/theme-default/material-design-iconic-font.min.css')}}" rel="stylesheet">
    <![endif]-->
</head>
<body class="menubar-hoverable header-fixed ">
<!-- BEGIN LOGIN SECTION -->
<section class="section-account">
    <div class="img-backdrop" style="background-image: url('/img/igarassu.png')"></div>
    <div class="spacer"></div>
    <div class="card contain-sm style-transparent">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <br/>

                    @if(Session::has('success_message'))
                        <div class="alert alert-success">
                            <span class="glyphicon glyphicon-ok"></span>
                            {!! session('success_message') !!}

                            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                    @endif
                    @if(Session::has('error_message'))
                        <div class="alert alert-success">
                            <span class="glyphicon glyphicon-ok"></span>
                            {!! session('error_message') !!}

                            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                    @endif

                    @if(Session::has('errors'))
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                    <span class="text-lg text-bold text-primary">NETSTART - SERMK </span>
                    <br/><br/>
                    <form class="form floating-label" action="{{ route('login') }}" accept-charset="utf-8" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email">
                            <label for="username">Username</label>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password">
                            <label for="password">Password</label>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-xs-12 text-right">
                                <button class="btn btn-primary btn-raised btn-block" type="submit">Login</button>
                            </div><!--end .col -->
                        </div><!--end .row -->
                    </form>
                </div><!--end .col -->
            </div><!--end .card -->
        </div>
    </div>
</section>
<!-- END LOGIN SECTION -->

<script src="{{ asset('/assets/js/libs/jquery/jquery-1.11.2.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/assets/js/core/source/AppForm.js')}}" type="text/javascript"></script>



<!-- END JAVASCRIPT -->
@yield('javascript')
</body>
</html>
