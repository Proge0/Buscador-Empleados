@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Inicio - Municipalidad de Arica')
@section('content')

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
                    <a class="btn btn-success mb-2 me-4 float-end" href="javascript:void(0)" id="createAnexo">Añadir</a>
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
                        <tbody class="table-tbody" id="tablaEmpleadosBody">

                        </tbody>
                    </table>
                </div>
                
                    <div class="modal fade" id="ajaxModel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modalHeading"></h4>
                                </div>
                                <div class="modal-body">
                                    <form id="empleadosForm" name="empleadosForm" class="form-horizontal">
                                        @csrf
                                        <input type="hidden" name="anexo_id" id="anexo_id">
                                        <div class="form-group">
                                            Número público: <br>
                                            <input type="number" class="form-control" id="numero_publico" name="numero_publico" placeholder="Ingrese el número publico" value="" required>
                                        </div>
                                        <div class="form-group">
                                            Número de Anexo: <br>
                                            <input type="number" class="form-control" id="numero_anexo" name="numero_anexo" placeholder="Ingrese el número de anexo" value="" required>
                                        </div>
                                        <div class="form-group">
                                            Nombre de Anexo: <br>
                                            <input type="text" class="form-control" id="nombre_anexo" name="nombre_anexo" placeholder="Ingrese el nombre de anexo" value="" required>
                                        </div>
                                        <div class="form-group">
                                            Departamento: <br>
                                            <input type="text" class="form-control" id="departamento" name="departamento" placeholder="Ingrese el departamento" value="" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3" id="saveBtn" value="Create">Crear</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabels" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabels">Editar información Anexo </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                {{-- create a form here.. --}}
                                    <form method="POST" id="editAnexoForm">
                                        @csrf
                                        <input type="hidden" id="anexo_ids" name="anexo_ids">
                                        <div class="form-group">
                                            <label for="anexo_numeros">Número público: </label>
                                            <input type="number" name="anexo_numeros" class="form-control" id="anexo_numeros">
                                        </div>
                                        <div class="form-group">
                                            <label for="anexo_anexo">Número de Anexo: </label>
                                            <input type="number" name="anexo_anexo" class="form-control" id="anexo_anexo">
                                        </div>
                                        <div class="form-group">
                                            <label for="anexo_name">Nombre de Anexo: </label>
                                            <input type="text" name="anexo_name" class="form-control" id="anexo_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="anexo_departamento">Departamento: </label>
                                            <input type="text" name="anexo_departamento" class="form-control" id="anexo_departamento">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary editButton">Guardar Cambios</button>
                                        </div>
                                    </form>
                                </div>

                            {{-- this is to make sure the save changes button is within form --}}
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Anexo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                    <div class="modal-body">                                       
                                            <h4>Realmente desea eliminar:</h4> <h2 class="anexo_names"> </h2>
                                    </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-danger deleteButton">Eliminar</button>
                                </div>
                            </div>
                        </div>
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



@endsection