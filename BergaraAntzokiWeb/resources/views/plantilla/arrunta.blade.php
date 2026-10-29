<!DOCTYPE html>
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
    kk
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

            <nav class="main-nav">
                <a href="#ekitaldiak" class="nav-link">Ekitaldiak</a>

                @auth
                @if(auth()->user()->rola === 'admin')
                <a href="#" class="nav-btn nav-btn-admin">Admin</a>
                @endif
                @endauth

                @guest
                <a href="#" class="nav-btn">Erregistratu / Saioa</a>
                @endguest
            </nav>
        </div>
    </header>

    <main>
        @yield('content1')
    </main>

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
</body>

</html>