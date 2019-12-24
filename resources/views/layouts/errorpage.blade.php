<!--
 =========================================================
 Material Dashboard PRO - v2.1.0
 =========================================================

 Product Page: https://www.creative-tim.com/product/material-dashboard-pro
 Copyright 2019 Creative Tim (https://www.creative-tim.com)

 Coded by Creative Tim

 =========================================================

 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->

<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="./img/logo/ico-book.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  
    <!-- Vue -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  
    <title>Los clubes de lectura</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
  
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
  
    <!-- CSS Files -->
    <link href="{{ asset('css/material-dashboard.min.css') }}" rel="stylesheet" />
 
</head>

<body class="off-canvas-sidebar">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
    <div class="container">
      <div class="navbar-wrapper">
        <a class="navbar-brand" href="#pablo">Error</a>
      </div>
      </div>
  </nav>
  <!-- End Navbar -->
  <div>
      @yield('content')
  </div>
  <!--   Core JS Files   -->
  <script type="application/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
  <script type="application/javascript" src="{{ asset('js/popper.min.js') }}"></script>

  <script type="application/javascript" src="{{ asset('js/bootstrap-material-design.min.js') }}" defer></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script type="application/javascript" src="{{asset ('js/plugins/material-dashboard.minf066.js')}}"></script>
</body>
<!-- Mirrored from demos.creative-tim.com/material-dashboard-pro/examples/pages/error.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 24 Nov 2019 15:20:16 GMT -->
</html>
