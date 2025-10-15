<nav class="navbar navbar-expand-lg bg-white fixed-top">
    {{-- 1. Rutas de imágenes corregidas con el helper asset() --}}
    <img src="{{ asset('assets/images/matraz.gif') }}" height="40" style="margin-left:1%; margin-right: -1%;">

    {{-- 2. Enlace a la página principal corregido para usar rutas de Laravel --}}
    <a class="navbar-brand" href="{{ route('dashboard') }}">ADM Calidad Central | Ramos</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto navbar-right-top">
            
            {{--
               3. (ACCIÓN REQUERIDA) Reemplazo del include de notificaciones.
                  Deberás crear el archivo 'notifications.blade.php'
                  y migrar la lógica de tu 'notification.php' original.
            --}}
            {{-- @include('layouts.partials.notifications') --}}

            <li class="nav-item dropdown nav-user">
                <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"><img src="{{ asset('assets/images/perfil.gif') }}" alt=""
                        class="user-avatar-md rounded-circle"></a>
                <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                    <div class="nav-user-info">
                        {{-- 4. Obtención del nombre de usuario con el sistema de autenticación de Laravel --}}
                        <h5 class="mb-0 text-white nav-user-name">
                           {{ Auth::user()->name }}
                           {{-- Nota: Para mostrar la 'Ubicacion', necesitarás agregar ese campo a tu tabla 'users'
                                y luego podrías mostrarlo con algo como: Auth::user()->ubicacion --}}
                        </h5>
                        <span class="status"></span><span class="ml-2">
                            <p>Tiempo restante:&ensp;<span id="timer"></span>min</p>
                        </span>
                    </div>

                    {{-- 5. Cierre de sesión (Logout) seguro, al estilo Laravel --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            <i class="fas fa-power-off mr-2"></i>Cerrar sesión
                        </a>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>