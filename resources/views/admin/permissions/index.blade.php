@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="page-header">
      <h2 class="pageheader-title">Administración de Permisos</h2>
      <div class="page-breadcrumb">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Permisos</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

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
    <span>Catálogo de Permisos del Sistema</span>
    {{-- Botón para abrir el modal --}}
    <button class="btn btn-primary" data-toggle="modal" data-target="#permission-form-modal">
      <i class="fa fa-plus"></i> Agregar Permiso
    </button>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped">
        <thead class="bg-light">
          <tr class="border-0">
            <th class="border-0">#</th>
            <th class="border-0">Nombre del Permiso</th>
            <th class="border-0">Acciones</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($permissions as $permission)
          <tr>
            <td>{{ $permission->id }}</td>
            <td>{{ $permission->name }}</td>
            <td>
              {{-- Botones de editar y eliminar --}}
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="3" class="text-center">No se han creado permisos todavía.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="permission-form-modal" tabindex="-1" role="dialog"
  aria-labelledby="permissionFormModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="permissionFormModalLabel">Agregar Nuevo Permiso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.permissions.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="name">Nombre del Permiso</label>
            <input id="name" name="name" type="text" required class="form-control" placeholder="Ej: crear usuarios">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar Permiso</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection