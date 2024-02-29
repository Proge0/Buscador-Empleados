@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Usuarios - Municipalidad de Arica')
@section('content')


<div class="container">
    <div class="d-flex flex-column ">
      <div class="text-center">
        <h1>Buscador de Usuarios</h1>
        <div class="d-md-block">
          <div class="input-icon">
            <input type="text" id="buscadorUsuarios" class="form-control" placeholder="Buscar Usuario, Correo, Rol..." />
            <span class="input-icon-addon">
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
                    <table class="table table-striped table-bordered" id="tablaUsuarios">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->rol }}</td>
                                    <td>                
                                      <button class="btn btn-primary btn-sm editar-btn @if(auth()->user()->rol === 'ADM' && $user->rol === 'ADM') d-none @endif" data-id="{{ $user->id }}" data-name="{{ $user->username }}">Editar</button>
                                      <button class="btn btn-danger btn-sm eliminar-btn @if(auth()->user()->rol === 'ADM' && $user->rol === 'ADM') d-none @endif" data-id="{{ $user->id }}"  data-name="{{ $user->username }}">Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Usuario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                    <div class="modal-body">                                       
                                            <h4>Realmente desea eliminar:</h4> <h2 class="user_names"> </h2>
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
    var tabla = $("#tablaUsuarios").DataTable({
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

    $("#buscadorUsuarios").on("keyup", function() {
      var valor = $(this).val();
      tabla.search(valor).draw();
    });

  function showSuccessAlert(message) {
            Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: message,
            showConfirmButton: true,
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6',
            allowOutsideClick: false,
            allowEscapeKey: false,
            }).then((result) => {
            if (result.isConfirmed) {
                // Recargar la página al hacer clic en cualquier lugar del modal
                Swal.getPopup().addEventListener('click', () => {
                location.reload();
                });
            }
            });
    }

  var userId;

  $(document).on('click', '.eliminar-btn', function(){
      var user_name = $(this).attr('data-name');
      userId = $(this).attr('data-id');
      $('.user_names').html('');
      $('.user_names').html(user_name);
      $('#deleteModal').modal('show'); // Show the modal
  });

  $(document).on('click','.deleteButton', function(){
      user_id = userId
      var url = "http://buscador.test/auth/delete/user/" + user_id
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
                      showSuccessAlert('Se ha eliminado el anexo exitosamente');
                  }
              });

  });
});



</script>




@endsection