<div class="page-body">
    <div class="container-xl">
      <div class="text-center">
        <h1>Registrar un Usuario</h1>
      </div>
        <div class="card">
            <div class="card-body">
                
                <form wire:submit.prevent="createUser()" method="post" autocomplete="off" novalidate="">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Nombre:</label>
                                <input type="text" class="form-control" placeholder="Nombre" autocomplete="off" wire:model="username">
                                @error('name')
                                    <span class="text-danger">{{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Correo electrónico:</label>
                                <input type="email" class="form-control" placeholder="Correo electrónico" autocomplete="off" wire:model="email">
                                @error('email')
                                    <span class="text-danger">{{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Contraseña:</label>
                                <input type="password" class="form-control" placeholder="Contraseña" autocomplete="off" wire:model="password">
                                @error('password')
                                    <span class="text-danger">{{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" wire:model="is_admin">
                                <label class="form-check-label" for="flexSwitchCheckDefault">¿Es administrador?</label>
                                
                            </div>
                        </div>
                            <button type="submit" class="btn btn-primary w-100">Crear Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>