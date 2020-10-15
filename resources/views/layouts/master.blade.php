
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <!-- Meta tags -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Drift - A fully responsive, HTML5 based admin template">
  <meta name="keywords" content="Responsive, HTML5, admin theme, business, professional, jQuery, web design, CSS3, sass">
  <!-- /meta tags -->
  <title>@yield('title', 'NCDMB APP BUILDER')</title>

  <!-- Site favicon -->
  <link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon">
  <!-- /site favicon -->

  <!-- Font Icon Styles -->
  <link rel="stylesheet" href="/css/flag-icon.min.css">
    <link rel="stylesheet" href="/vendors/gaxon-icon/styles.css">
  <!-- /font icon Styles -->

  <!-- Perfect Scrollbar stylesheet -->
  <link rel="stylesheet" href="/css/perfect-scrollbar.css">
  <!-- /perfect scrollbar stylesheet -->

  <!-- Data table stylesheet -->
  <link href="/css/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Load Styles -->
  <link rel="stylesheet" href="/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="/assets/css/style.min.css">
  <link rel="stylesheet" href="/css/selectize.legacy.css">
  <!-- /load styles -->

</head>
<body class="dt-sidebar--fixed">

<!-- Loader -->
<div class="dt-loader-container">
  <div class="dt-loader">
    <svg class="circular" viewBox="25 25 50 50">
      <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
    </svg>
  </div>
</div>
<!-- /loader -->

<!-- Root -->
<div class="dt-root">
    <div class="dt-root__inner">

        <!-- Header -->
        @include('partials.top-navigation')
        <!-- /header -->

        <!-- Site Main -->
        <main class="dt-main">
            <!-- Sidebar -->
            @include('partials.aside')
            <!-- /sidebar -->

            <!-- Site Content Wrapper -->
            <div class="dt-content-wrapper">

                <!-- Site Content -->
                <div class="dt-content">

                    <!-- Page Header -->
                    @yield('page-header')
                    
                    <!-- /page header -->

                    <!-- Grid -->
                    <div class="row">

                        <!-- Grid Item -->
                        <div class="col-xl-12">

                            @yield('content')

                        </div>
                        <!-- /grid item -->

                    </div>
                    <!-- /grid -->

                </div>
                <!-- /site content -->

                <!-- Footer -->
                @include('partials.footer')
                <!-- /footer -->

            </div>
            <!-- /site content wrapper -->
        </main>

    </div>
</div>
<!-- /root -->

<!-- Optional JavaScript -->
<script src="/js/jquery.min.js"></script>
<script src="/js/moment.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<!-- Perfect Scrollbar jQuery -->
<script src="/js/perfect-scrollbar.min.js"></script>
<!-- /perfect scrollbar jQuery -->

<!-- masonry script -->
<script src="/js/masonry.pkgd.min.js"></script>
<script src="/js/sweetalert2.js"></script>
<script src="/assets/js/functions.js"></script>
<script src="/assets/js/customizer.js"></script>

<!-- Date-time Pickers -->
<script src="/js/moment.min.js"></script>
<script src="/js/locales.min.js"></script>
<script src="/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- /date-time pickers -->

<!-- Custom JavaScript -->
<script src="/js/jquery.dataTables.js"></script>
<script src="/js/dataTables.bootstrap4.js"></script>
<script src="/assets/js/custom/data-table.js"></script>
<script src="/assets/js/custom/datetime-pickers.js"></script>
<script src="/js/typeahead.js"></script>
<script src="/js/selectize.js"></script>
<script src="/assets/js/script.js"></script>
<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>

<!-- Charting library -->
<script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>

@yield('scripts')

</body>
</html>