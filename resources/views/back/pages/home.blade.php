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

                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Anexo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                    <div class="modal-body">
                                        
                                            Realmente desea eliminar: <p class="anexo_names"> </p> ?
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

<script>

var table;

$(document).ready(function() {
    table = $("#tablaEmpleados").DataTable({
        dom: "prt",
        paging: false,
        autoWidth: false,
        scrollCollapse: true,
        scrollY: '30rem',
        fixedHeader: true,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"
        }
    });

    $(document).on('click', '#createAnexo', function() {
        console.log('click');
        $("#anexo_id").val('');
        $("#empleadosForm").trigger('reset');
        $("#modalHeading").html('Agregar Anexo');
        $('#ajaxModel').modal('show');
    });

    $("#saveBtn").click(function(e){
        e.preventDefault();
        $(this).html('Guardar');

        var formData = $("#empleadosForm").serializeArray();
        formData.push({ name: "_token", value: "{{ csrf_token() }}" });

        $.ajax({
            data:$("#empleadosForm").serialize(),
            url:'/auth/agregar_anexo',
            type:"POST",
            dataType:'json',
            success:function(data){
                $("#empleadosForm").trigger('reset');
                $('#ajaxModel').modal('hide');
                printSuccessMsg(data.msg);
                table.draw();
            },
            error:function(data){
                console.log('Error',data);
                $("#saveBtn").html('Guardar');
            }
        });
    });


    
    var filasOriginales = [];

    $(window).resize(function() {
        table.columns.adjust();
    });

    $.ajax({
        url: '/auth/home',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            actualizarTabla(data);
        }
    });

    function actualizarTabla(data) {
        var tableBody = $("#tablaEmpleados tbody");
        tableBody.empty();

        filasOriginales = data.map(function(anexo) {
            return [
                anexo.numeros_publicos,
                anexo.anexo,
                anexo.nombre_anexo,
                anexo.departamento,
                "<button class='btn me-2 btn-primary btn-sm editar-btn' data-id='" + anexo.ID + "'>Editar</button>" +
                "<button class='btn btn-danger btn-sm eliminar-btn' data-id='" + anexo.ID + "' data-name='" + anexo.nombre_anexo + "' data-bs-toggle='modal' data-bs-target='#deleteModal'>Eliminar</button>"
            ];
        });

        table.rows.add(filasOriginales).draw();

    }

    $('.eliminar-btn').on('click',function(){
        var anexo_name = $(this).data('name');
        $('.anexo_names').html('');
        $('.anexo_names').html(anexo_name);
    });

    $('.deleteButton').on('click',function(){
        var anexo_id = $(this).data('id');
        var url = "{{ route('auth.deleteAnexo','anexo_id')}}";
        url = url.replace('anexo_id',anexo_id);
        console.log(url);
            $.ajax({
                url: url,
                type: 'GET',
                contentType: false,
                processData:false,
                    beforeSend:function(){
                        $('.deleteButton').prop('disabled', true);
                    },
                    complete: function(){
                        $('.deleteButton').prop('disabled', false);
                    },
                    success: function(data){
                        console.log('Respuesta del servidor:', data);
                        if(data.success == true){
                            $('#deleteModal').modal('hide');
                            printSuccessMsg(data.msg);
                            var reloadInterval = 100000;
                        function reloadPage() {
                            location.reload(true);
                        }
                        var intervalId = setInterval(reloadPage, reloadInterval);
                        }else{
                            printErrorMsg(data.msg);
                        }
                    }
                });

    function printValidationErrorMsg(msg){
                $.each(msg, function(field_name, error){
                    $(document).find('#'+field_name+'_error').text(error);
                });
                }
                function printErrorMsg(msg){
                    $('#alert-danger').html('');
                    $('#alert-danger').css('display','block');
                    $('#alert-danger').append(''+msg+'');
                }
                function printSuccessMsg(msg){
                    $('#alert-success').html('');
                    $('#alert-success').css('display','block');
                    $('#alert-success').append(''+msg+'');
                document.getElementById('empleadosForm').reset();
                }
        });

    $("#inputField").on("keyup", function() {
        var valor = $(this).val().toLowerCase();
        table.search(valor).draw();
    });

});


</script>



@endsection