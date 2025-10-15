<x-app-layout>
  {{-- Slot para el encabezado de la página (opcional, pero buena práctica) --}}
  <x-slot name="header">
    <h2 class="h4 font-weight-bold">
      {{ __('Administración de Usuarios') }}
    </h2>
  </x-slot>

  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <span>Usuarios del sistema</span>
        {{-- Este botón abrirá el modal para crear un nuevo usuario --}}
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#user-form-modal">
          <i class="fa fa-plus"></i> Agregar Usuario
        </button>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="bg-light">
            <tr class="border-0">
              <th class="border-0">#</th>
              <th class="border-0">Usuario</th>
              <th class="border-0">Correo</th>
              <th class="border-0">Puesto</th>
              <th class="border-0">Estatus</th>
              <th class="border-0">Acciones</th>
            </tr>
          </thead>
          <tbody>
            {{--
                            Aquí reemplazamos el antiguo bucle 'while' de PHP.
                            La variable '$users' es la que pasaste desde el UserController.
                        --}}
            @forelse ($users as $user)
            <tr>
              <td>{{ $user->id }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>
                {{-- Asumiendo que tendrás una columna 'puesto' en tu tabla users --}}
                {{ $user->puesto ?? 'No definido' }}
              </td>
              <td>
                {{-- Lógica para mostrar el estatus del usuario --}}
                @if($user->is_active ?? true)
                <span class="badge badge-success">Activo</span>
                @else
                <span class="badge badge-danger">Inactivo</span>
                @endif
              </td>
              <td>
                {{--
                                        ACCIÓN: Estos enlaces deberán apuntar a las rutas de 'editar' y 'permisos'
                                        cuando las crees. Por ahora, los dejamos como ejemplo.
                                    --}}
                <a href="{{-- route('admin.users.permissions', $user->id) --}}" class="btn btn-sm btn-info"
                  title="Permisos">
                  <i class="fa fa-shield-alt"></i>
                </a>
                <a href="{{-- route('admin.users.edit', $user->id) --}}" class="btn btn-sm btn-warning" title="Editar">
                  <i class="fa fa-edit"></i>
                </a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="text-center">No se encontraron usuarios.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="user-form-modal" tabindex="-1" role="dialog" aria-labelledby="userFormModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="userFormModalLabel">Agregar Nuevo Usuario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{--
                    El formulario ahora apunta a una ruta de Laravel (que deberás crear)
                    y tiene la protección @csrf que es OBLIGATORIA.
                --}}
        <form action="{{-- route('admin.users.store') --}}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Nombre completo</label>
              <input id="name" name="name" type="text" required class="form-control">
            </div>
            <div class="form-group">
              <label for="email">Correo electrónico</label>
              <input id="email" name="email" type="email" required class="form-control">
            </div>
            <div class="form-group">
              <label for="puesto">Puesto</label>
              <input id="puesto" name="puesto" type="text" class="form-control">
            </div>
            <div class="form-group">
              <label for="ubicacion">Ubicación</label>
              <input id="ubicacion" name="ubicacion" type="text" class="form-control">
            </div>
            <div class="form-group">
              <label for="password">Contraseña</label>
              <input id="password" name="password" type="password" required class="form-control">
            </div>
            <div class="form-group">
              <label for="password_confirmation">Confirmar Contraseña</label>
              <input id="password_confirmation" name="password_confirmation" type="password" required
                class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar Usuario</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>