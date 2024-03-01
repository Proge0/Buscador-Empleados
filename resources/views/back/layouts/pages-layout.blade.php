
<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('pageTitle')</title>
    <!-- CSS files -->
    <base href="/"/>
    <link href="./back/dist/css/tabler.min.css?1684106062" rel="stylesheet"/>
    <link href="./back/dist/css/tabler-flags.min.css?1684106062" rel="stylesheet"/>
    <link href="./back/dist/css/tabler-payments.min.css?1684106062" rel="stylesheet"/>
    <link href="./back/dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>
    @stack('stylesheets')
    @livewireStyles
    <link href="./back/dist/css/demo.min.css?1684106062" rel="stylesheet"/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body class="theme-dark-auto">
    <script src="./back/dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page">
        @include('back.layouts.inc.header')
      <!-- Navbar -->
      <div class="page-wrapper">
        <!-- Page header -->
        @yield('pageHeader')
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            @yield('content')
          </div>
        </div>
        @include('back.layouts.inc.footer')
      </div>
    </div>
    <!-- Libs JS -->
    <script src="./back/dist/libs/apexcharts/dist/apexcharts.min.js?1684106062" defer></script>
    <script src="./back/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1684106062" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./back/dist/libs/jsvectormap/dist/maps/world.js?1684106062" defer></script>
    <script src="./back/dist/libs/jsvectormap/dist/maps/world-merc.js?1684106062" defer></script>
    <!-- Tabler Core -->
    <script src="./back/dist/js/tabler.min.js?1684106062" defer></script>
    <script src="{{ asset('js/script.js') }}"></script>
    @stack('scripts')
    @livewireScripts
    <script src="./back/dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>