@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Mi perfil - Municipalidad de Arica')
@section('content')

<div class="container d-flex justify-content-center ">
    <div class="row">
        <div class="d-flex justify-content-center">
            <div class="col-lg-4">
                <div class="card-body text-center ">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                    <h2 class="my-3">{{ auth()->user()->username}}</h2>
                </div>
            </div>
      </div>
      <form>
        @csrf
        <div class="card">
          <div class="card-body">
            <div class="form-group">
                <div class="row mt-2">
                    <div class="col-sm-3">
                        <label class="mb-0" for="nombreUsuario"><h3>Nombre de Usuario</h3></label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control ms-auto" id="nombreUsuario" name="nombreUsuario" value="" required>
                    </div>
                </div>
            </div>
            <hr>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label class="mb-0" for="correoUsuario"><h3>Correo Electrónico</h3></label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control ms-auto" id="correoUsuario" name="correoUsuario" value="" required>
                        </div>
                    </div>
                </div>
            <hr>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label class="mb-0" for="contraseñaUsuario"><h3>Contraseña</h3></label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control ms-auto" id="contraseñaUsuario" name="contraseñaUsuario" value="" required>
                        </div>
                    </div>
                </div>
            <hr>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label class="mb-0" for="rolUsuario"><h3>Rol</h3></label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control ms-auto" id="rolUsuario" name="rolUsuario" value="" required>
                        </div>
                    </div>
                </div>
            <hr>
          </div>
                  <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary editButton col-sm-5 mb-3">Guardar Cambios</button>
                  </div>
        </div>
      </form>
    </div>
</div>
@endsection