<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('font-awesome/css/fontawesome-all.css') }}" rel="stylesheet">
        <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        @yield('popup')
        <!--Style End -->
        <style>
            html {
                font-family: "Helvetica Neue", sans-serif;
                width: 100%;
                color: #666666;
                text-align: center;
            }

            .popup-overlay {
                /*Hides pop-up when there is no "active" class*/
                visibility: hidden;
                position: absolute;
                background: #ffffff;
                border: 3px solid #666666;
                width: 50%;
                height: 50%;
                left: 25%;
            }

            .popup-overlay.active {
                /*displays pop-up when "active" class is present*/
                visibility: visible;
                text-align: center;
            }

            .popup-content {
                /*Hides pop-up content when there is no "active" class */
                visibility: hidden;
            }

            .popup-content.active {
                /*Shows pop-up content when "active" class is present */
                visibility: visible;
            }

            button {
                display: inline-block;
                vertical-align: middle;
                border-radius: 30px;
                margin: .20rem;
                font-size: 1rem;
                color: #666666;
                background: #ffffff;
                border: 1px solid #666666;
            }

            button:hover {
                border: 1px solid #666666;
                background: #666666;
                color: #ffffff;
            }

        </style>
    </head>
    <body class="pace-done">
            <!-- Page Content -->
              <div id="wrapper">
                  <nav class="navbar-default navbar-static-side" role="navigation">
                      <div class="sidebar-collapse">
                          <ul class="nav metismenu" id="side-menu">
                              <li class="nav-header">
                                  <div class=" profile-element mr-3">
                                      <img alt="image" class=" rounded-circle " src="{{asset('picture/admin.jpg')}}" style="width:100px; height: 100px;margin-left:30px;"/>
                                      <span class="text-md-center"><p style="color:whitesmoke;"></p> </span>
                                  </div>
                                  <div class="logo-element">
                                      IN+
                                  </div>
                              </li>

                              <li class="active">
                                  <a href="{{route('dashboard')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
                              </li>
                              <li>
                                  <a href="{{route('viewBrand')}}"><i class="fa fa-diamond"></i> <span class="nav-label">Brand</span></a>
                              </li>

                              <li>
                                  <a href="{{route('viewProduct')}}"><i class="fa fa-pie-chart"></i> <span class="nav-label">Product</span></a>
                              </li>


                          </ul>

                      </div>
                  </nav>
                  <div id="page-wrapper" class="gray-bg">
                      <div class="row border-bottom">
                          <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                              <div class="navbar-header">
                                  <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                                  <form role="search" class="navbar-form-custom" action="search_results.html">
                                      <div class="form-group">
                                          <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                                      </div>
                                  </form>
                              </div>


                          </nav>
                      </div>
                      @yield('content')
                      <div class="footer">
                          <div>
                              <strong>Copyright</strong> Example Company © 2014-2018
                          </div>
                      </div>
                  </div>
              </div>
             <!--page content close -->
            <!-- Scripts -->

            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
            <!-- Scripts close -->
    </body>

</html>
