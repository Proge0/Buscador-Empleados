@extends('back.layouts.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Recuperar Contraseña - Buscador Empleados Municipalidad de Arica')
@section('content')

<div class="page page-center">
      <div class="container container-tight py-4">
        <div class="text-center mb-4">
          <a href="." class="navbar-brand navbar-brand-autodark"><img src="./back/static/logo3.png" height="150" alt=""></a>
        </div>
        <form class="card card-md" action="./" method="get" autocomplete="off" novalidate="">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Olvido su contraseña</h2>
            <p class="text-muted mb-4">Introduzca su dirección de correo y su contraseña sera enviada a este.</p>
            <div class="mb-3">
              <label class="form-label">Dirección de correo</label>
              <input type="email" class="form-control" placeholder="Introduzca su correo">
            </div>
            <div class="form-footer">
              <a href="#" class="btn btn-primary w-100">
                <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"></path><path d="M3 7l9 6l9 -6"></path></svg>
                Enviarme contraseña
              </a>
            </div>
          </div>
        </form>
        <div class="text-center text-muted mt-3">
          Olvidalo, <a href="{{ route('auth.login')}}">regresame</a> a la vista de inicio de sesión.
        </div>
      </div>
    </div>

@endsection