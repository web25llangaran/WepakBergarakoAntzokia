<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bergarako Antzoki Web')</title>

    @vite(['resources/css/app.css', 'resources/css/hasieraorria.css', 'resources/js/app.js'])

    <style>
        /* Reset general */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ---------- HEADER ---------- */
        .main-header {
            background-color: #701920;
            color: #ffffff;
            padding: 16px 24px;
            width: 100%;
            box-shadow: 0px 10px 15px -3px rgba(0, 113, 188, 1);
        }

        .header-container {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #ffffff;
            gap: 14px;
        }

        .logo-circle {
            width: 46px;
            height: 46px;
            border: 1px solid rgba(255, 255, 255, 0.65);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Georgia', 'Times New Roman', serif;
            font-weight: bold;
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        .logo-text {
            display: flex;
            flex-direction: column;
            font-family: 'Georgia', 'Times New Roman', serif;
            line-height: 1.25;
        }

        .brand-title {
            font-weight: bold;
            font-size: 18px;
        }

        .brand-subtitle {
            font-style: italic;
            font-size: 17px;
            color: #f2e6e6;
        }

        .main-nav {
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .nav-link {
            color: #ffffff;
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
            transition: opacity 0.2s ease;
        }

        .nav-link:hover {
            opacity: 0.8;
        }

        .nav-btn {
            color: #ffffff;
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
            border: 1px solid rgba(255, 255, 255, 0.55);
            padding: 9px 18px;
            border-radius: 4px;
            transition: background-color 0.2s ease, border-color 0.2s ease;
        }

        .nav-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: #ffffff;
        }

        .nav-btn-admin {
            background-color: #ffffff;
            color: #701920;
            border-color: #ffffff;
        }

        .nav-btn-admin:hover {
            background-color: #f2e6e6;
            border-color: #f2e6e6;
        }

        main {
            flex: 1;
        }

        /* ---------- FOOTER ---------- */
        .main-footer {
            background-color: #1f262d;
            color: #b8bec5;
            padding: 40px 24px;
            width: 100%;
        }

        .footer-container {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .footer-title {
            display: block;
            color: #ffffff;
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 8px;
        }

        .footer-tagline {
            font-size: 14px;
            color: #b8bec5;
        }

        .footer-legal {
            font-size: 14px;
            color: #b8bec5;
        }

        .footer-legal a {
            color: #b8bec5;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer-legal a:hover {
            color: #ffffff;
        }
    </style>
</head>
<body>

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