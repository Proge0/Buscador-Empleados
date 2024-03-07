@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Mi perfil - Municipalidad de Arica')
@section('content')

<div class="container d-flex justify-content-center">
    <div class="row">
        <div class="d-flex justify-content-center">
            <div class="col-lg-4">
                <div class="card-body text-center ">
                    <img src="https://www.svgrepo.com/show/105032/avatar.svg" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;" id="img1">
                    <img src="https://www.svgrepo.com/show/61986/avatar.svg" alt="avatar" class="rounded-circle img-fluid" style="width: 150px; display: none;" id="img2">
                    <img src="https://www.svgrepo.com/show/57853/avatar.svg" alt="avatar" class="rounded-circle img-fluid" style="width: 150px; display: none;" id="img3">
                    <img src="https://www.svgrepo.com/show/79566/avatar.svg" alt="avatar" class="rounded-circle img-fluid" style="width: 150px; display: none;" id="img4">
                    <img src="https://www.svgrepo.com/show/382106/male-avatar-boy-face-man-user-9.svg" alt="avatar" class="rounded-circle img-fluid" style="width: 150px; display: none;" id="img5">
                    <h2 class="my-3">{{ auth()->user()->username}}</h2>
                </div>
            </div>
      </div>
      <form action="{{ route('auth.editarPerfil') }}" method="POST">
        @csrf
        <div class="card">
          <div class="card-body">
            <div class="form-group">
                <div class="row mt-2">
                    <div class="col-sm-3">
                        <label class="mb-0" for="nombreUsuario"><h3>Nombre de Usuario</h3></label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control ms-auto" id="nombreUsuario" name="nombreUsuario" value="{{ auth()->user()->username }}"  required>
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
                            <input type="text" class="form-control ms-auto" id="correoUsuario" name="correoUsuario" value="{{ auth()->user()->email }}" required>
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
                            <input type="password" class="form-control ms-auto" id="contraseñaUsuario" name="contraseñaUsuario" value="" required>
                        </div>
                    </div>
                </div>
            <hr>
                @if(auth()->user()->rol === 'ADM')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="mb-0" for="rolUsuario"><h3>Rol</h3></label>
                            </div>
                            <div class="col-sm-9">
                                <select class="form-select" id="rolUsuario" name="rolUsuario" required>
                                    <option value="ADM" {{ auth()->user()->rol == 'ADM' ? 'selected' : '' }}>ADM</option>
                                    <option value="USR" {{ auth()->user()->rol == 'USR' ? 'selected' : '' }}>USR</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endif
          </div>
                  <div class="d-flex justify-content-center">
                    <button id="submit-btn" class="btn btn-primary editButton col-sm-5 mb-3">Guardar Cambios</button>
                  </div>
        </div>
      </form>
    </div>
</div>
@endsection
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script>

        function showRandomImage() {
            const images = [$("#img1"), $("#img2"), $("#img3"), $("#img4"), $("#img5")];
            images.forEach(img => img.hide());
            const randomIndex = Math.floor(Math.random() * images.length);
            images[randomIndex].show();
        }
        $(document).ready(function() {
            showRandomImage();
        });

        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Perfil actualizado',
                text: '{{ session('perfil-actualizado') }}',
                confirmButtonText: 'OK'
            });
        });
            
    </script>