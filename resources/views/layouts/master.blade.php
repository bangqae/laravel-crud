<!doctype html>
<html lang="en">

<head>
  {{-- <title>Dashboard</title> --}}
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <!-- VENDOR CSS -->
  <!-- Disini, asset adalah helper laravel untuk mengarahkan ke folder public -->
  <link rel="stylesheet" href="{{asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/assets/vendor/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/assets/vendor/linearicons/style.css')}}">
  <!-- MAIN CSS -->
  <link rel="stylesheet" href="{{asset('admin/assets/css/main.css')}}">
  <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
  <link rel="stylesheet" href="{{asset('admin/assets/css/demo.css')}}">
  {{-- TOASTR --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  {{-- DATATABLE --}}
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
  <!-- ICONS -->
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('admin/assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{asset('admin/assets/img/favicon.png')}}">
  {{-- Include script yang hanya dipakai di view-view tertentu --}}
  <style>
    .ck-editor__editable_inline {
      min-height: 300px;
    }
  </style>
  @yield('header')
</head>

<body>
  <!-- WRAPPER -->
  <div id="wrapper">
    <!-- NAVBAR -->

    @include('layouts.includes._navbar')

    <!-- END NAVBAR -->
    <!-- LEFT SIDEBAR -->

    @include('layouts.includes._sidebar')

    <!-- END LEFT SIDEBAR -->
    <!-- MAIN -->

    @yield('content')

    <!-- END MAIN -->
    <div class="clearfix"></div>
    <footer>
      <div class="container-fluid">
        <p class="copyright">Shared by <i class="fa fa-love"></i><a
            href="https://bootstrapthemes.co">BootstrapThemes</a>
        </p>
      </div>
    </footer>
  </div>
  <!-- END WRAPPER -->
  <!-- Javascript -->
  <script src="{{asset('admin/assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('admin/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('admin/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
  <script src="{{asset('admin/assets/scripts/klorofil-common.js')}}"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js">
  </script>
  <script src="{{asset('frontend/js/ckeditor.js')}}"></script>
  <script>
    @if(Session::has('sukses'))
      toastr.success("{{ Session::get('sukses') }}", "Sukses");
    @elseif(Session::has('error'))
      toastr.error("{{ Session::get('error') }}", "Error");
    @endif
  </script>
  {{-- Include script yang hanya dipakai di view-view tertentu --}}
  @yield('footer')
</body>

</html>
