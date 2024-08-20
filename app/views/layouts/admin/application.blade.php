<!doctype html>
<html class="no-js">
  <head>
    <meta charset="UTF-8">
    <title>{{ $template['page-title'] }}</title>

    @section('head')
      <!--IE Compatibility modes-->
      <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">

      <!--Mobile first-->
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Bootstrap -->
      <link rel="stylesheet" href="/themes/userweb/vendor/bootstrap/css/bootstrap.min.css">

      <!-- Font Awesome -->
      <link rel="stylesheet" href="/themes/userweb/vendor/font-awesome/css/font-awesome.min.css">

      <!-- Metis core stylesheet -->
      <link rel="stylesheet" href="/themes/admin/assets/css/main.min.css">
      <link rel="stylesheet" href="/themes/admin/assets/lib/fullcalendar/fullcalendar.css">

      <link rel="stylesheet" href="/themes/admin/assets/lib/chosen/chosen.css">

      <!-- Metis Theme stylesheet -->

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

      <!--[if lt IE 9]>
        <script src="assets/lib/html5shiv/html5shiv.js"></script>
          <script src="assets/lib/respond/respond.min.js"></script>
          <![endif]-->
      <link rel="stylesheet" type="text/css" href="/themes/admin/assets/css/theme.css">
      
      <!-- Self Custom CSS -->
      <link rel="stylesheet" href="/assets/admin/stylesheets/style.css">

      <!--Modernizr 2.8.2-->
      <script src="/themes/admin/assets/lib/modernizr/modernizr.min.js"></script>
    @show
  </head>
  <body class="bg-dark dk">
    <div class="bg-dark dk" id="wrap">
      @section('top')
        @include('layouts.admin._top')
      @show

      @section('left')
        @include('layouts.admin._left')
      @show

      @section('content')
        @yield('content')
      @show

      @section('right')
        <!-- <div id="right" class="bg-light lter"></div> -->
      @show
    </div><!-- /#wrap -->

    @section('footer')
      <footer class="Footer bg-dark dker">
        <p>CentralPC &copy; Copyright 2014. All Rights Reserved.</p>
      </footer><!-- /#footer -->
    @show

    @section('foot')
      <!--jQuery 2.1.1 -->
      <script src="/themes/admin/assets/lib/jquery/jquery.min.js"></script>

      <!--Bootstrap -->
      <script src="/themes/admin/assets/lib/bootstrap/js/bootstrap.min.js"></script>
      <script src="/themes/admin/assets/js/jquery-ui.min.js"></script>

      <!-- Screenfull -->
      <script src="/themes/admin/assets/lib/screenfull/screenfull.js"></script>
      <script src="/themes/admin/assets/lib/moment/moment.min.js"></script>
      <script src="/themes/admin/assets/lib/fullcalendar/fullcalendar.min.js"></script>
      <script src="/themes/admin/assets/lib/jquery.tablesorter/jquery.tablesorter.min.js"></script>
      <script src="/themes/admin/assets/lib/jquery.sparkline/jquery.sparkline.min.js"></script>
      <script src="/themes/admin/assets/lib/flot/jquery.flot.js"></script>
      <script src="/themes/admin/assets/lib/flot/jquery.flot.selection.js"></script>
      <script src="/themes/admin/assets/lib/flot/jquery.flot.resize.js"></script>
      <script src="/themes/admin/assets/lib/chosen/chosen.jquery.min.js"></script>
      <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
      <script src="/themes/admin/nestedSortable/jquery.mjs.nestedSortable.js"></script>
      <script>
        tinymce.init({selector:'.tinymce'});
      </script>
      <script>
        $(function()
          {
            formGeneral();
          });
      </script>
      
      <!-- App global scripts -->
      <script src="/assets/global/javascripts/restfulizer.js"></script>

      <!-- Metis core scripts -->
      <script src="/themes/admin/assets/js/core.js"></script>

      <!-- Metis demo scripts -->
      <script src="/themes/admin/assets/js/app.min.js"></script>
    @show
    @section('custom_script')
    @show
    {{ Form::token() }}
  </body>
</html>
