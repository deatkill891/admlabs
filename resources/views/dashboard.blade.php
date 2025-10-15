@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="page-header">
      <h2 class="pageheader-title">Dashboard</h2>
      <p class="pageheader-text">Esta es tu página de inicio.</p>
      <div class="page-breadcrumb">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="breadcrumb-link">Control Panel</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        ¡Has iniciado sesión correctamente!
      </div>
    </div>
  </div>
</div>

@endsection