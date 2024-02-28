
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Inicio - Municipalidad de Arica')

<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
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
    <script src="https://cdn.datatables.net/fixedheader/3.4.0/js/dataTables.fixedHeader.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.4.0/css/fixedHeader.dataTables.min.css">
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
      <!-- Navbar -->
      <div class="page-wrapper">
        <!-- Page header -->
<header class="navbar navbar-expand-md d-print-none sticky-top" >
        <div class="container-xl">
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal p-1 ms-2">
            <a href="https://www.muniarica.cl">
              <img src="./back/static/logo3.png" width="125" height="60" alt="LogoMuni">
            </a>
          </h1>
          @if(!auth()->user())
            <div class="navbar-nav flex-row order-md-last">
                <button class="btn btn-outline-primary">
                  <a href="{{ route('auth.login') }}" class="nav-link d-flex lh-1 text-reset p-0 ">
                    <div class="d-block fw-bold">
                      <div>Iniciar Sesión</div>
                    </div>
                  </a>
                </button>

                {{auth()->user()}}
            </div>
          @endif
        </div>
</header>

        <!-- Page body -->
            <div class="container">
                <div class="d-flex flex-column mt-4">
                  <div class="text-center">
                    <h1>Buscador de Empleados</h1>
                    <div class="d-md-block">
                      <div class="input-icon">
                        <input type="text" id="inputField" class="form-control" placeholder="Buscar Anexo, Empleado, Oficina..." />
                        <span class="input-icon-addon">
                          <!-- SVG icon from http://tabler-icons.io/i/search -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
            </div>


            <div class="page-body">
                <div class="container-xl">
                    <div class="card">
                        <div class="card-body">
                            <div id="table-default" class="table-responsive">
                                <table class="table table-striped table-bordered" id="tablaEmpleados">
                                    <thead>
                                        <tr>
                                            <th>Número Público</th>
                                            <th>Número de Anexo</th>
                                            <th>Nombre de Anexo</th>
                                            <th>Departamento</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-tbody">
                                        @foreach($anexos as $anexo)
                                            <tr>
                                                <td>{{ $anexo->numeros_publicos }}</td>
                                                <td>{{ $anexo->anexo }}</td>
                                                <td>{{ $anexo->nombre_anexo }}</td>
                                                <td>{{ $anexo->departamento }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <footer class="footer footer-transparent d-print-none">
          <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">
              <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">
                    © 2023 
                    <a href="https://www.muniarica.cl" class="link-secondary">Municipalidad de Arica </a>
                    - Todos los derechos reservados
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
  </div>
</div>


    <!-- Libs JS -->
    <script src="./back/dist/libs/apexcharts/dist/apexcharts.min.js?1684106062" defer></script>
    <script src="./back/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1684106062" defer></script>
    <script src="./back/dist/libs/jsvectormap/dist/maps/world.js?1684106062" defer></script>
    <script src="./back/dist/libs/jsvectormap/dist/maps/world-merc.js?1684106062" defer></script>
    <!-- Tabler Core -->
    <script src="./back/dist/js/tabler.min.js?1684106062" defer></script>
    <script src="./back/dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html>


<!-- Resto del contenido de tu vista home -->



<style>
#tablaEmpleados_wrapper {
    margin-top: 0;
}

div.dataTables_wrapper div.dataTables_filter input {
    margin-left: 5px;
    display: inline-block;
    width: auto;
}

</style>

<script>
  
$(document).ready(function() {
  var tabla = $("#tablaEmpleados").DataTable({
    dom: "prt",
    paging: false,
    autoWidth: false,
    scrollCollapse: true,
    scrollY: '33rem',
    fixedHeader: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"
    }
  });
  
  $(window).resize(function() {
    tabla.columns.adjust();
  });

  $("#inputField").on("keyup", function() {
    var valor = $(this).val();
    tabla.search(valor).draw();
  });
});



</script>



