<!DOCTYPE html>
<html dir="ltr" lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
          content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Ample admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
          content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>GERACOR 2024</title>
    <link rel="canonical" href="{{asset('https://www.wrappixel.com/templates/ample-admin-lite/')}}" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('dashboard_template/plugins/images/logo-icon.png')}}">
    <!-- Custom CSS -->
    <link href="{{asset('dashboard_template/plugins/bower_components/chartist/dist/chartist.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('dashboard_template/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css')}}">
    <!-- Custom CSS -->
    <link href="{{asset('dashboard_template/css/style.min.css')}}" rel="stylesheet">
    <script src={{asset("https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js")}} charset="utf-8"></script>
    <script src={{asset("https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js")}} charset=utf-8></script>
    <livewire:styles />
</head>

<body>

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
         data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

        @include('partials.topbar')
        @include('partials.sidebar')
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                @yield('main-content')

            </div>
            <!-- End Container fluid  -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center"> 2024 - Trabalho Programação Web / Engenharia Software disponível em <a
                    href="https://github.com/Jarjarbinks-exe/PW_Projeto">github.com</a>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- End Page wrapper  -->


    </div>
    <!-- End Wrapper -->
    <script src={{asset("dashboard_template/plugins/bower_components/jquery/dist/jquery.min.js")}}></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src={{asset("dashboard_template/bootstrap/dist/js/bootstrap.bundle.min.js")}}></script>
    <script src={{asset("dashboard_template/js/app-style-switcher.js")}}></script>
    <script src={{asset("dashboard_template/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js")}}></script>
    <!--Wave Effects -->
    <script src={{asset("dashboard_template/js/waves.js")}}></script>
    <!--Menu sidebar -->
    <script src={{asset("dashboard_template/js/sidebarmenu.js")}}></script>
    <!--Custom JavaScript -->
    <script src={{asset("dashboard_template/js/custom.js")}}></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src={{asset("dashboard_template/plugins/bower_components/chartist/dist/chartist.min.js")}}></script>
    <script src={{asset("dashboard_template/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js")}}></script>
    <script src={{asset("dashboard_template/js/pages/dashboards/dashboard1.js")}}></script>

    <livewire:scripts />
    @yield('javascript')

</body>

</html>
