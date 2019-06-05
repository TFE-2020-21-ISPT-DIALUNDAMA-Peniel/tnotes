<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Bil Wifi" content="{{ config('app.name') }} by KinDev">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href={{ asset('favicon.ico') }}>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ !empty ($title) ? $title .' | '. config('app.name') : config('app.name') }}  </title>
	<!-- BOOTSTRAP STYLES-->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet"> --}}
    @yield('stylesheet1')
     <!-- FONTAWESOME STYLES-->
        <!-- Custom CSS -->
    <link href="{{ asset('bootstrap/icons/font-awesome/css/fontawesome-all.css') }}" rel="stylesheet">
     <!-- MORRIS CHART STYLES-->
    
        <!-- CUSTOM STYLES-->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    @yield('stylesheet')

    @stack('stylesheets')

     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->

    <!-- Date et heure -->
    <script type="text/javascript" src="{{ asset('js/date-heure.js') }}"></script>

</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">

         {{--        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button> --}}


         {{--        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button> --}}
                <a class="navbar-brand mx-auto d-block" href="{{ route('home') }}">TCotes | ISPT </a> 
            </div>
            <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
            <h2 class="badge badge-info">Section</h2>   
            <span id="date_heure"></span> &nbsp; 
            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-danger square-btn-adjust">Déconnexion</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            </div>
        </nav>   
           <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side sidebar-nav" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav " id="main-menu">
    				<li class="text-center mx-auto d-block sidebar-item">
                        <img style="max-width: 60%" src="{{ asset('/img/logoIspt.gif') }}" class="user-image img-responsive img-fluid"/>
    				</li>
                    <li>
                        <a class="sidebar-link has-arrow waves-effect waves-dark"  href="{{ route('home') }}"><i class="fas fa-tachometer-alt fa-2x"></i> Tableau de bord</a>
                    </li>
                    {{-- <li>
                        <a class="sidebar-link has-arrow waves-effect waves-dark"  href="#"><i class=" fas fa-th-list fa-2x"></i>Gestion des étudiants</a>
                    </li>
                    <li>
                        <a class="sidebar-link has-arrow waves-effect waves-dark"  href="#"><i class=" fas fa-th-list fa-2x"></i>Gestion des professeurs</a>
                    </li>
                    <li>
                        <a class="sidebar-link has-arrow waves-effect waves-dark"  href="{{ route('section.index') }}"><i class=" fas fa-th-list fa-2x"></i>Gestion des cours</a>
                    </li> --}}
                    {{-- <li>
                        <a class="sidebar-link has-arrow waves-effect waves-dark"  href="#"><i class=" fas fa-th-list fa-2x"></i>Gestion des cours</a>
                    </li> --}}
                    <li>
                        <a class="sidebar-link has-arrow waves-effect waves-dark"  href="#"><i class=" fas fa-user fa-2x"></i> Mon profil</a>
                    </li>
                   
				{{-- 	<!-- Multi link -->
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-2x"></i> Enrôlements<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Enrôler étudiant</a>
                            </li>
                            <li>
                                <a href="#">Liste des enrôlés</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>

                                </ul>
                               
                            </li>
                        </ul>
                    </li>  --}} 
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
          
                     {{-- <a href=""><i class="fas fa-arrow-circle-left fa-2x"></i></a>    --}}

            <div id="page-inner" style="background-color: : #F3F3F3">
               {{--  <div class="row">
                    <div class="col-md-12">
                     <h2 class="btn btn-success">{{ \App\Http\Controllers\Helper::getUserRole() }}</h2>   
                        <h5>home Jhon Deo , Love to see you back. </h5>
                    </div>
                </div> --}}
                 {{-- <hr /> --}}
                @yield('content')
                 <!-- /. ROW  -->
            </div>
               
            @include('layouts.partials._footer')
        </div>
             <!-- /. PAGE INNER  -->

    </div>
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->

    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src={{ asset('backend/assets/libs/jquery/dist/jquery.min.js') }}></script>

      <!-- BOOTSTRAP SCRIPTS -->
    <script src={{ asset('backend/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}></script>
    <script src={{ asset('bootstrap/js/bootstrap.bundle.min.js') }}></script>


    <!-- METISMENU SCRIPTS -->
    <script src="{{ asset("js/jquery.metisMenu.js") }}"></script>

    @stack('scripts')


         <!-- CUSTOM SCRIPTS -->
    <script src="{{ asset("js/custom.js") }}"></script>
    <script src="{{ asset("js/raphael-2.1.0.min.js") }}"></script>
    <script src="{{ asset("js/morris.js") }}"></script>
    <script type="text/javascript">window.onload = date_heure('date_heure');</script>


    <script type="text/javascript">
        $(function () {
                      $('[data-toggle="popover"]').popover()
                    })
    </script>
    
       {{-- PACKAGES --}}
    <!--Flashy -->
    @include('flashy::message')
</body>
</html>
