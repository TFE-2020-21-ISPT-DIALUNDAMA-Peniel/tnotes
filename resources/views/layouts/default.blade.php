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

    @yield('stylesheet1')
        <!-- Custom CSS -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/icons/font-awesome/css/fontawesome-all.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('stylesheet')
    <!-- Coustom styleSheet--->
    @stack('stylesheets')


</head>
  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="
      #">TCotes | ISPT</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-danger square-btn-adjust">Déconnexion</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="text-center mx-auto d-block sidebar-item">
                    <img style="max-width: 60%" src="{{ asset('/img/tcote.png') }}" class="user-image rounded-circle img-responsive img-fluid"/>
                </li>
                <br>
             
    @if(auth()->user()->users_roles == 'section')
              <li class="nav-item">
                <a class="nav-link btn btn-outline-primary btn-lg btn-block active" href="{{ route('section.session_import') }}">
                  <span data-feather="home"></span>
                  Tableau de bord <span class="sr-only">(current)</span>
                </a>
              </li>
              <br>
              <li class="nav-item">
                <a class="nav-link btn btn-outline-primary btn-lg btn-block active" href="{{ route('section.get_etudiants') }}">
                  <span data-feather="home"></span>
                  Etudiants <span class="sr-only">(current)</span>
                </a>
              </li>
              <br>
              <li class="nav-item">
                <a class="nav-link btn btn-outline-primary btn-lg btn-block active" href="{{ route('section.get_cours') }}">
                  <span data-feather="home"></span>
                  Cours <span class="sr-only">(current)</span>
                </a>
              </li>
              <br>
              <li class="nav-item">
                <a class="nav-link btn btn-outline-primary btn-lg btn-block active" href="{{ route('section.get_prof') }}">
                  <span data-feather="home"></span>
                  Professeurs <span class="sr-only">(current)</span>
                </a>
              </li>

    @elseif (auth()->user()->users_roles == 'jury') 
    <li class="nav-item">
                <a class="nav-link btn btn-outline-primary btn-lg btn-block active" href="{{ route('jury.index') }}">
                  <span data-feather="home"></span>
                  Tableau de bord <span class="sr-only">(current)</span>
                </a>
              </li>
                
    @endif
             
              
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3">Tableau de bord</h1>
            {{-- <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
              </button>
            </div> --}}
          </div>

          {{-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> --}}

          @yield('content')
          @include('layouts.partials._footer')

        </main>
      </div>
    </div>
     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src={{ asset('backend/assets/libs/jquery/dist/jquery.min.js') }}></script>

      <!-- BOOTSTRAP SCRIPTS -->
    <script src={{ asset('backend/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}></script>
    <script src={{ asset('bootstrap/js/bootstrap.bundle.min.js') }}></script>
    {{-- <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../assets/js/vendor/jquery-slim.min.js" ></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
 --}}
    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <!-- Graphs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script>
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
          datasets: [{
            data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            borderWidth: 4,
            pointBackgroundColor: '#007bff'
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false
              }
            }]
          },
          legend: {
            display: false,
          }
        }
      });
    </script>
    @stack('scripts')
    @include('flashy::message')

  </body>

<!-- Mirrored from getbootstrap.com/docs/4.1/examples/dashboard/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 07 Nov 2018 23:41:52 GMT -->
</html>
