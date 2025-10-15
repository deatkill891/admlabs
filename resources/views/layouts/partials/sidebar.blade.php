<nav class="navbar navbar-expand-lg navbar-light">
  <a class="d-xl-none d-lg-none" href="{{ route('dashboard') }}">Inicio</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav flex-column">

      <li class="nav-divider">Menu</li>
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
          <i class="fa-solid fa-house"></i>Inicio
        </a>
      </li>

      {{-- Lógica de permisos para la sección de Administración --}}
      @if(Auth::user()->is_admin ?? false)
      <li class="nav-divider"><i class="fa-solid fa-user-pen"></i> Administración</li>
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-adm"
          aria-controls="submenu-adm">
          <i class="fa-solid fa-gear"></i>ADM
        </a>
        <div id="submenu-adm" class="collapse submenu {{ request()->routeIs('admin.*') ? 'show' : '' }}">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                href="{{ route('admin.users.index') }}">
                <i class="fa-solid fa-user-gear"></i>Usuarios
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.materials.*') ? 'active' : '' }}"
                href="{{ route('admin.materials.index') }}">
                <i class="fa-solid fa-dna"></i>Materiales
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.mails.*') ? 'active' : '' }}"
                href="{{ route('admin.mails.index') }}">
                <i class="fa-solid fa-share-from-square"></i>Correos
              </a>
            </li>
            {{-- --- NUEVO ENLACE AÑADIDO --- --}}
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}"
                href="{{ route('admin.permissions.index') }}">
                <i class="fa-solid fa-shield-halved"></i>Permisos
              </a>
            </li>
          </ul>
        </div>
      </li>
      @endif

      {{-- Lógica de permisos para la sección de Procesos --}}
      @if(Auth::user()->can_analize ?? false)
      <li class="nav-divider"><i class="fa-solid fa-dna"></i> Procesos</li>
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-results"
          aria-controls="submenu-results">
          <i class="fa-solid fa-chart-simple"></i>Resultados
        </a>
        <div id="submenu-results" class="collapse submenu">
          <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="#">
                <i class="fa-solid fa-chart-line"></i>Dashboard</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="#">
                <i class="fa-solid fa-vial-circle-check"></i>Reporte de análisis</a>
            </li>
          </ul>
        </div>
      </li>
      {{-- ... resto de los menús ... --}}
      @endif
    </ul>
  </div>
</nav>