<x-app-layout>
  <x-slot name="header">
    <h2 class="h4 font-weight-bold">
      {{ __('Administración de Correos') }}
    </h2>
  </x-slot>

  {{-- Bloque para mostrar mensajes de sesión --}}
  @if (session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif

  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <span>Catálogo de Correos para Notificaciones</span>
      <button class="btn btn-primary" data-toggle="modal" data-target="#mail-form-modal">
        <i class="fa fa-plus"></i> Agregar Correo
      </button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="bg-light">
            <tr class="border-0">
              <th class="border-0">#</th>
              <th class="border-0">Nombre</th>
              <th class="border-0">Correo</th>
              <th class="border-0">Planta</th>
              <th class="border-0">Estatus</th>
              <th class="border-0">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($correos as $correo)
            <tr>
              <td>{{ $correo->id }}</td>
              <td>{{ $correo->nombre }}</td>
              <td>{{ $correo->correo }}</td>
              <td>{{ $correo->planta }}</td>
              <td>
                @if($correo->estatus == 1)
                <span class="badge badge-success">Activo</span>
                @else
                <span class="badge badge-danger">Inactivo</span>
                @endif
              </td>
              <td>
                <a href="{{-- route('admin.mails.edit', $correo->id) --}}" class="btn btn-sm btn-warning"
                  title="Editar">
                  <i class="fa fa-edit"></i>
                </a>
                {{-- Aquí irá el formulario de eliminar --}}
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="text-center">No se encontraron correos registrados.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>

{{-- Aquí irá el modal para el formulario de creación --}}