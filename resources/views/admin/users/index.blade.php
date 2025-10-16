@extends('layouts.app')

@section('content')

{{-- Encabezado de la página --}}
<div class="row">
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="page-header">
      <h2 class="pageheader-title">Administración de Usuarios</h2>
      <div class="page-breadcrumb">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

{{-- Bloque para mostrar mensajes de sesión (éxito o error) --}}
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

{{-- Tarjeta principal con la tabla de usuarios --}}
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <span>Usuarios del sistema</span>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#user-form-modal">
      <i class="fa fa-plus"></i> Agregar Usuario
    </button>
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
            <th class="border-0">Acciones</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($users as $user)
          <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->puesto ?? 'No definido' }}</td>
            <td>
              <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning" title="Editar">
                <i class="fa fa-edit"></i>
              </a>
              <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline"
                onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
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
            <td colspan="5" class="text-center">No se encontraron usuarios.</td>
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
      <form action="{{ route('admin.users.store') }}" method="POST">
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
          {{-- SELECTOR TIPO DE USUARIO CORREGIDO --}}
          <div class="form-group">
            <label for="IdTipoUsuario">Tipo de Usuario</label>
            <select id="IdTipoUsuario" name="IdTipoUsuario" class="form-control" required>
              <option value="">Seleccione un tipo...</option>
              @foreach ($tiposUsuario as $tipo)
              <option value="{{ $tipo->idTipoUsuario }}">{{ $tipo->TipoUsuario }}</option>
              @endforeach
            </select>
          </div>

          {{-- SELECTOR UBICACIÓN CORREGIDO --}}
          <div class="form-group">
            <label for="IdUbicacion">Ubicación</label>
            <select id="IdUbicacion" name="IdUbicacion" class="form-control" required>
              <option value="">Seleccione una ubicación...</option>
              @foreach ($ubicaciones as $ubicacion)
              <option value="{{ $ubicacion->idUbicacion }}">{{ $ubicacion->Ubicacion }}</option>
              @endforeach
            </select>
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
@endsection