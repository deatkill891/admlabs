<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link href="{{ asset('assets/images/matraz.png') }}" rel="icon">
  <link href="{{ asset('assets/images/matraz.png') }}" rel="apple-touch-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
  <link href="{{ asset('assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/charts/chartist-bundle/chartist.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/charts/morris-bundle/morris.css') }}">
  <link rel="stylesheet"
    href="{{ asset('assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/charts/c3charts/c3.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icon-css/flag-icon.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/buttons.bootstrap4.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/select.bootstrap4.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/fixedHeader.bootstrap4.css') }}">

  <script src="https://kit.fontawesome.com/9d1bcc908a.js" crossorigin="anonymous"></script>
  <title>ADM Calidad Central</title>
</head>

<body>
  <div class="dashboard-main-wrapper">
    <div class="dashboard-header">
      @include('layouts.partials.navbar')
    </div>
    <div class="nav-left-sidebar sidebar-dark">
      <div class="menu-list">
        @include('layouts.partials.sidebar')
      </div>
    </div>

    <div class="dashboard-wrapper">
      <div class="container-fluid dashboard-content">
        <main>
          {{-- ESTE ES EL CAMBIO CLAVE --}}
          @yield('content')
        </main>
      </div>

      <div class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
              Copyright ©{{ date('Y') }} DEACERO Acería Celaya. | Designed by TI Operaciones Acería Celaya.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
  <script src="{{ asset('assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
  <script src="{{ asset('assets/libs/js/main-js.js') }}"></script>
  <script src="{{ asset('assets/vendor/charts/chartist-bundle/chartist.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/charts/sparkline/jquery.sparkline.js') }}"></script>
  <script src="{{ asset('assets/vendor/charts/morris-bundle/raphael.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/charts/morris-bundle/morris.js') }}"></script>
  <script src="{{ asset('assets/vendor/charts/c3charts/c3.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/charts/c3charts/d3-5.4.0.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/charts/c3charts/C3chartjs.js') }}"></script>
  <script src="{{ asset('include/form-muestra.js') }}"></script>

  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="{{ asset('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
  <script src="{{ asset('assets/vendor/datatables/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables/js/data-table.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
  <script src="