<!DOCTYPE html>
{{-- Plantilla (layout) de la parte pública: todas las páginas del usuario normal la usan (cabecera, contenido y pie). --}}
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bergarako Antzoki Web')</title>

    {{-- Plantilako estiloak kargatu --}}
    @vite(['resources/css/app.css', 'resources/css/arrunta.css', 'resources/js/app.js'])

    {{-- Plantilan kargatuko diren webguneen estiloa kargatzeko deia --}}
    @stack('styles')
</head>

<body>
    
    {{-- Cabecera: logo que lleva al inicio y menú de navegación. --}}
    <header class="main-header">
        <div class="header-container">
            <a href="{{ url('/') }}" class="brand-logo">
                <div class="logo-circle">
                    <span>BA</span>
                </div>
                <div class="logo-text">
                    <span class="brand-title">Bergarako</span>
                    <span class="brand-subtitle">Antzoki Web</span>
                </div>
            </a>

            {{-- Menú: enlace a eventos y, según si hay sesión o no, saludo + panel admin + cerrar sesión, o botón para abrir el popup de login. --}}
            <nav class="main-nav">
                <a href="#ekitaldiak" class="nav-link">Ekitaldiak</a>

                {{-- Si el usuario ha iniciado sesión: lo saludamos por su nombre. --}}
                @auth
                <span class="nav-link">Kaixo, {{ auth()->user()->izena }}!</span>

                {{-- Si además es admin, mostramos el enlace al panel de gestión. --}}
                @if (auth()->user()->rola === \App\Enums\Rola::Admin->value)
                <a href = "{{route ('admin.dashboard')}}" class = "nav-link"> App Kudeaketa </a>
                @endif

                {{-- Botón para cerrar sesión (formulario POST con token CSRF). --}}
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="nav-btn">Saioa itxi</button>
                </form>
                @endauth

                {{-- Si NO ha iniciado sesión: botón que abre el popup de login/registro. --}}
                @guest
                    <button type="button" class="nav-btn" data-bs-toggle="modal" data-bs-target="#popup-saioa">Erregistratu / Saioa</button>
                @endguest
            </nav>
        </div>
    </header>

    {{-- Aquí se mete el contenido de cada página (lo que cada vista pone en @section('content1')). --}}
    <main>
        @yield('content1')
    </main>

    {{-- Pie de página con el nombre, eslogan y enlaces legales. --}}
    <footer class="main-footer">
        <div class="footer-container">
            <div class="footer-brand">
                <strong class="footer-title">Bergarako Antzoki Web</strong>
                <p class="footer-tagline">Kultura, zuzen-zuzenean.</p>
            </div>

            <p class="footer-legal">
                &copy; {{ date('Y') }} Bergarako Udala ·
                <a href="#">Pribatutasuna</a> ·
                <a href="#">Lege oharra</a>
            </p>
        </div>
    </footer>

    {{-- El popup de login/registro solo se incluye si el usuario no ha iniciado sesión. --}}
    @guest
        {{-- Orri batek 'popup_hurrengoa' definitzen badu, saioa hasi ondoren hara joango da; bestela orri berean geratuko da --}}
        <x-popup :hurrengoa="trim($__env->yieldContent('popup_hurrengoa')) ?: url()->full()" />
    @endguest

</body>

</html>