
<header class="navbar navbar-expand-md d-print-none sticky-top">
  <div class="container-xl">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal p-1 ms-2">
      <a href="{{ route('auth.home')}}">
        <img src="./back/static/logo3.png" width="125" height="60" alt="LogoMuni">
      </a>
    </h1>
            <div class="navbar-nav flex-row order-md-last">
              <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                  <div class="d-xl-none"> <!-- Ocultar en pantallas extra grandes -->
                    <div class="btn btn-outline-dark w-100">{{ auth()->user()->username}}</div>
                  </div>
                  <div class="d-none d-xl-block ps-2"> <!-- Mostrar solo en pantallas extra grandes -->
                    <div class="btn btn-outline-dark w-100">{{ auth()->user()->username}}</div>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <a href="#" class="dropdown-item"">Mi Perfil</a>
                  <a href="{{ route('auth.logout') }}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Desconectarse</a>
                  <form action="{{ route('auth.logout') }}" id="logout-form" method="POST">@csrf</form>
                </div>
              </div>
            </div>
          <div class="collapse navbar-collapse ps-2" id="navbar-menu">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
              <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('auth.home')}}" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Inicio
                    </span>
                  </a>
                </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('auth.addEmpleados')}}" >
                      <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M12 11l0 6" /><path d="M9 14l6 0" /></svg>
                      </span>
                      <span class="nav-link-title">
                        Agregar Anexos
                      </span>
                    </a>
                  </li> 
            @if(auth()->user()->rol === 'ADM')
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('auth.register')}}" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M16 19h6" /><path d="M19 16v6" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Agregar Usuario
                    </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('auth.users')}}" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-group" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" /><path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M17 10h2a2 2 0 0 1 2 2v1" /><path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M3 13v-1a2 2 0 0 1 2 -2h2" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Usuarios Registrados
                    </span>
                  </a>
                </li>
              @endif
              </ul>
            </div>
          </div>
        </div>
</header>