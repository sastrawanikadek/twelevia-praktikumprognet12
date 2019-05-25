<!DOCTYPE html>
    <!--
    This is a starter template page. Use this page to start your new project from
    scratch. This page gets rid of all links and provides the needed markup only.
    -->
    <html>
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Bootstrap 3.3.2 -->
        <link href="{{ asset("bower_components/bootstrap/dist/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{ asset("bower_components/admin-lte/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link href="{{ asset("/bower_components/admin-lte/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />

        <!-- Notiifcation -->
        <link rel="stylesheet" href="{{ asset("/css/notification.css") }}" />

        <!-- Custom CSS -->
        <style>
            .btn-primary {
                background-color: #1abc9c !important;
            }
            .box-primary {
                border-top-color: #1abc9c !important;
            }
            .pagination>.active>a {
                background-color: #1abc9c !important;
                border-color: #1abc9c !important;
            }
            .sidebar-menu>li.active>a {
                border-left-color: #1abc9c !important;
            }
            .skin-blue .main-header li.user-header {
                background-color: #1abc9c !important;
            }
            .skin-blue .main-header .navbar .sidebar-toggle:hover {
                background-color: #149077 !important;
            }
        </style>
        @yield('css')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
      
          @include('components.admin.header')
          @include('components.admin.sidebar')
      
          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @include('components.admin.breadcrumb')
      
            <!-- Main content -->
            <section class="content">
                @yield('content')

                @include('components.notification')
            </section>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->
          <footer class="main-footer">
            <strong>Copyright &copy; <?php echo date("Y"); ?>.</strong> All rights
            reserved.
          </footer>
        </div>
        <!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 2.1.3 -->
        <script src="{{ asset ("/bower_components/jquery/dist/jquery.min.js") }}"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="{{ asset ("/bower_components/bootstrap/dist/js/bootstrap.min.js") }}" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset ("/bower_components/admin-lte/dist/js/adminlte.min.js") }}" type="text/javascript"></script>
        <!-- Notification -->
        <script>
          $(document).ready(function(){
              $('.notification.visible').animate({
                  bottom: "24px"
              }, function() {
                  window.setTimeout(function(){
                      $('.notification.visible').animate({
                          bottom: "-75px"
                      });
                  }, 3000);
              });
          });
        </script>
        <!-- Custom Script -->
        @yield('script')
    </body>
</html>