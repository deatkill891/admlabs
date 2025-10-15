<x-app-layout>
  <x-slot name="header">
    <h2 class="h4 font-weight-bold">
      {{ __('Administración de Materiales') }}
    </h2>
  </x-slot>

  {{-- 1. Bloque añadido para mostrar mensajes de éxito y error --}}
  @if (session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  @if (session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif


  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <span>Catálogo de Materiales</span>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#material-form-modal">
          <i class="fa fa-plus"></i> Agregar Material
        </button>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="bg-light">
            <tr class="border-0">
              <th class="border-0">#</th>
              <th class="border-0">Nombre del Material</th>
              <th class="border-0">Estatus</th>
              <th class="border-0">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($materials as $material)
            <tr>
              <td>{{ $material->id }}</td>
              <td>{{ $material->nombre }}</td>
              <td>
                @if($material->estatus == 1)
                <span class="badge badge-success">Activo</span>
                @else
                <span class="badge badge-danger">Inactivo</span>
                @endif
              </td>
              <td>
                {{-- 2. Enlace de Editar ACTIVADO --}}
                <a href="{{ route('admin.materials.edit', $material->id) }}" class="btn btn-sm btn-warning"
                  title="Editar">
                  <i class="fa fa-edit"></i>
                </a>

                {{-- 3. Formulario de Eliminar AÑADIDO --}}
                <form action="{{ route('admin.materials.destroy', $material->id) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('¿Estás seguro de que deseas eliminar este material?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                    <i class="fa fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="4" class="text-center">No se encontraron materiales.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>

{{-- El modal para agregar nuevos materiales (ya lo tenías) --}}
<div class="modal fade" id="material-form-modal" tabindex="-1" role="dialog" aria-labelledby="materialFormModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="materialFormModalLabel">Agregar Nuevo Material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.materials.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="nombre">Nombre del Material</label>
            <input id="nombre" name="nombre" type="text" required class="form-control">
          </div>
          <div class="form-group">
            <label for="estatus">Estatus</label>
            <select id="estatus" name="estatus" class="form-control">
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar Material</button>
        </div>
      </form>
    </div>
  </div>
</div>