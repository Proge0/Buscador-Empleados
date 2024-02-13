@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Inicio - Municipalidad de Arica')
@section('content')

<!-- Mostrar mensaje de exito al crear un usuario con Toastr. -->
@if(Session::has('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            toastr.success("{{ Session::get('success') }}", "Éxito", {
                timeOut: 5000,
                fadeOut: 1000,
            });
            setTimeout(function() {
                toastr.clear();
                {{ Session::forget('success') }}
            }, 5000);
        });
    </script>
@endif
<!-- Resto del contenido de tu vista home -->

<div class="container">
    <div class="d-flex flex-column ">
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
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
                            @foreach($anexos as $anexo)
                                <tr>
                                    <td>{{ $anexo->numeros_publicos }}</td>
                                    <td>{{ $anexo->anexo }}</td>
                                    <td>{{ $anexo->nombre_anexo }}</td>
                                    <td>{{ $anexo->departamento }}</td>
                                    <td>                
                                      <button class="btn btn-primary btn-sm editar-btn" data-id="{{ $anexo->id }}">Editar</button>
                                      <button class="btn btn-danger btn-sm eliminar-btn" data-id="{{ $anexo->id }}">Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

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




@endsection