<div>

    @if(Session::get('success'))
    <div class="alert alert-success"> 
        {{ Session::get('success')}}
    </div>
    @endif

    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Regístrar un usuario</h2>
            <form wire:submit.prevent="createUser()" method="post" autocomplete="off" novalidate="">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nombre:</label>
                    <input type="text" class="form-control" placeholder="Nombre" autocomplete="off" wire:model="username">
                    @error('name')
                        <span class="text-danger">{{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo electrónico:</label>
                    <input type="email" class="form-control" placeholder="Correo electrónico" autocomplete="off" wire:model="email">
                    @error('email')
                        <span class="text-danger">{{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" placeholder="Contraseña" autocomplete="off" wire:model="password">
                    @error('password')
                        <span class="text-danger">{{ $message }} </span>
                    @enderror
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Registrarse</button>
                </div>
            </form>
        </div>
    </div>

</div>
