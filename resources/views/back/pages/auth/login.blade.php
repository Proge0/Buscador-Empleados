@extends('back.layouts.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Login - Buscador Anexos Municipalidad de Arica')
@section('content')

<div class="page page-center">
      <div class="container container-tight py-4">
        <div class="text-center mb-4">
          <a href="https://www.muniarica.cl" class="navbar-brand navbar-brand-autodark"><img src="./back/static/logo3.png" height="150" alt=""></a>
        </div>
        @livewire('login-form')
      </div>
    </div>

@endsection