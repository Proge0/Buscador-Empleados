@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Usuarios - Municipalidad de Arica')
@section('content')

<div class="container">
    <div class="d-flex flex-column ">
      <div class="text-center">
        <h1>Usuarios Registrados</h1>
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
                                      <button class="btn btn-primary btn-sm editar-btn-user @if(auth()->user()->rol === 'ADM' && $user->rol === 'ADM') d-none @endif" data-bs-toggle="modal" data-bs-target="#editModalUser" data-id="{{ $user->id }}"  data-name="{{ $user->username }}" data-email="{{ $user->email }}" data-password="{{ $user->password }}" data-rol="{{ $user->rol }}">Editar</button>
                                      <button class="btn btn-danger btn-sm eliminar-btn-user @if(auth()->user()->rol === 'ADM' && $user->rol === 'ADM') d-none @endif" data-id="{{ $user->id }}"  data-name="{{ $user->username }}" data-email="{{ $user->email }}" data-password="{{ $user->password }}" data-rol="{{ $user->rol }}">Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

                    <div class="modal fade" id="editModalUser" tabindex="-1" aria-labelledby="exampleModalLabels" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabels">Editar Usuario </h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="editUserForm">
                                        @csrf
                                        <input type="hidden" id="user_id" name="user_id">
                                        <div class="form-group">
                                            <label for="user_name">Nombre de Usuario: </label>
                                            <input type="text" name="user_name" class="form-control" id="user_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_correo">Correo: </label>
                                            <input type="email" name="user_correo" class="form-control" id="user_correo">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_contraseña">Contraseña: </label>
                                            <input type="password" name="user_contraseña" class="form-control" id="user_contraseña">
                                        </div>
                                        <div class="form-group">
                                            <div for="user_rol">Rol:</div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="user_rol" id="user_rol_usr" value="USR" {{ $user->rol == 'USR' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="user_rol_usr">USR</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="user_rol" id="user_rol_adm" value="ADM" {{ $user->rol == 'ADM' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="user_rol_adm">ADM</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary editButton">Guardar Cambios</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="deleteModalUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
@livewire('register-form')

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
      responsive: true,
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
                Swal.getPopup().addEventListener('click', () => {
                location.reload();
                });
            }
            });
    }

    $(document).on("click", ".editar-btn-user", function () {
        var users_id = $(this).attr("data-id");
        var users_name = $(this).attr("data-name");
        var users_email = $(this).attr("data-email");
        var users_password = $(this).attr("data-password");
        var users_rol = $(this).attr("data-rol");

        $("#user_name").val(users_name);
        $("#user_correo").val(users_email);
        $("#user_rol").val(users_rol);
        $("#user_id").val(users_id);
    });

    function printValidationErrorMsg(data) {
        if (data.hasOwnProperty("errors")) {
            $.each(data.errors, function (field_name, errors) {
                errors.forEach(function (error) {
                    $(document)
                        .find("#" + field_name + "_error")
                        .text(error);
                });
            });
        } else {
            printErrorMsg(data.msg);
        }
    }

    function printErrorMsg(msg) {
        $("#alert-danger").html("");
        $("#alert-danger").css("display", "block");
        $("#alert-danger").append("" + msg + "");
        $("#alert-success").html("");
        $("#alert-success").css("display", "none");
    }

    $("#editUserForm").on("submit", function (e) {
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            url: "http://buscador.test/auth/edit/user",
            data: formData,
            method: "POST",
            dataType: "json",
            beforeSend: function () {
                $(".editButton").prop("disabled", true);
            },
            complete: function () {
                $(".editButton").prop("disabled", false);
            },
            success: function (data) {
                if (data.success == true) {
                    $("#editModalUser").modal("hide");
                    showSuccessAlert("Se ha editado el usuario exitosamente");
                } else if (data.success == false) {
                    printErrorMsg(data, "123");
                    console.log(data, "123");
                } else {
                    printValidationErrorMsg(data);
                    console.log(data);
                }
            },
        });
    });


  var userId;

  $(document).on('click', '.eliminar-btn-user', function(){
      var user_name = $(this).attr('data-name');
      userId = $(this).attr('data-id');
      $('.user_names').html('');
      $('.user_names').html(user_name);
      $('#deleteModalUser').modal('show'); // Show the modal
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