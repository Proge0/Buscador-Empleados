@extends('back.layouts.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Recuperar Contraseña - Buscador Anexos Municipalidad de Arica')
@section('content')

<div class="page page-center">
      <div class="container container-tight py-4">
        <div class="text-center mb-4">
          <a href="." class="navbar-brand navbar-brand-autodark"><img src="./back/static/logo3.png" height="150" alt=""></a>
        </div>
        <form class="card card-md" action="{{ route('auth.reset.password.post')}}" method="POST" autocomplete="off" novalidate="">
          @csrf
          <div class="card-body">
                          <input type="hidden" name="token" value="{{ $token }}">
  
                          <div class="form-group row">
                              <label for="email_address" class="col-md-4 col-form-label text-md-right">Correo</label>
                              <div class="col-md-6">
                                  <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>
                              <div class="col-md-6">
                                  <input type="password" id="password" class="form-control" name="password" required autofocus>
                                  @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar Contraseña</label>
                              <div class="col-md-6">
                                  <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
                                  @if ($errors->has('password_confirmation'))
                                      <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                  @endif
                              </div>
                          </div>
            <div class="form-footer">
              <button  type="submit" class="btn btn-primary w-100">
                Reestablecer Contraseña
              </button>
            </div>
          </div>
        </form>
        <div class="text-center text-muted mt-3">
          Olvidalo, <a href="{{ route('auth.login')}}">regresame</a> a la vista de inicio de sesión.
        </div>
      </div>
    </div>

@endsection