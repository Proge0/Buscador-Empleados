@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Agregar Empleados - Municipalidad de Arica')
@section('content')

<div class="container-xl">
  <div class="">
    <div class="w-100 d-flex">
      <div class="d-flex flex-column" style="margin: auto;">
        <div class="text-center">
          <h1>Agregar Empleados</h1>
          <div class="d-md-block">
            <form action="{{ route('auth.import') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="file" name="file" accept=".csv" class="form-control">
              <button type="submit" class="btn btn-primary d-none d-sm-inline-block mt-5" id="submit-btn">Import CSV</button>
            </form>
          </div>
        </div>
            <div class="mt-5">
                <div class="">
                    <div class="card">
                        <div class="card-stamp">
                            <div class="card-stamp-icon bg-white text-danger">
                                <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" /></svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">Para subir el archivo correctamente, debe cumplir con los siguientes requisitos:</h3>
                            <p>✓ El formato del archivo debe ser CSV (delimitado por comas).</p>
                            <p>✓ El orden de las columnas debe ser: Número Público - Número Anexo - Nombre Anexo - Departamento.</p>
                            <p>✓ No debe haber columnas adicionales ni faltantes.</p>
                        </div>
                    </div>
                </div>
            </div>
      </div>

    </div>
  </div>
</div>

  <script>
    document.getElementById('submit-btn').addEventListener('click', function(event) {
      var fileInput = document.querySelector('input[type=file]');

      if (fileInput.files.length === 0) {
        event.preventDefault();
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Por favor, seleccione un archivo',
        });
      }
    });
  </script>


@endsection