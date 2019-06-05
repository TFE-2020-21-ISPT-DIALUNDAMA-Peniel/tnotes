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
    <style type="text/css">
      body {
          padding-top: 5rem;
        }
      .starter-template {
          /*padding: 3rem 1.5rem;*/
        }
    </style>
        <!-- CUSTOM STYLES-->
    {{-- <link href="{{ asset('css/custom.css') }}" rel="stylesheet" /> --}}
    @yield('stylesheet')

    @stack('stylesheets')

     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->

</head>


  <body>

    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('professeur.index') }}">Acceuil<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Mon profil</a>
            </li>
          </ul>
          <div class="form-inline mt-2 mt-md-0">
             <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-danger square-btn-adjust">Déconnexion</a>
            <form id="logout-form" action="{{ route('professeur.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </div>
        </div>
      </nav>
    </header>

    <!-- Begin page content -->
    <main role="main" class="container">
      <div class="starter-template">
        @yield('content')
      </div>
    </main>
    


    <footer class="footer">
      @include('layouts.partials._footer')
    
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src={{ asset('backend/assets/libs/jquery/dist/jquery.min.js') }}></script>

      <!-- BOOTSTRAP SCRIPTS -->
    <script src={{ asset('backend/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}></script>
    <script src={{ asset('bootstrap/js/bootstrap.bundle.min.js') }}></script>


    <!-- METISMENU SCRIPTS -->

    @stack('scripts')



    <script type="text/javascript">
        $(function () {
                      $('[data-toggle="popover"]').popover()
                    })
    </script>
    
       {{-- PACKAGES --}}
    <!--Flashy -->
    @include('flashy::message')
</body>

<!-- Mirrored from getbootstrap.com/docs/4.1/examples/sticky-footer-navbar/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 07 Nov 2018 23:41:57 GMT -->
</html>
