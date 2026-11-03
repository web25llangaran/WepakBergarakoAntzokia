<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin dashboard')</title>

    {{-- Plantilako estiloak kargatu --}}
    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js'])

    {{-- Plantilan kargatuko diren webguneen estiloa kargatzeko deia --}}
    @stack('styles')
</head>


<body class="d-flex flex-column vh-100 overflow-hidden">
    <header>
        <div class="container-fluid">
            <div class="row border-bottom">
                <div class="col-2 bg-dark text-white d-flex align-items-center p-4">
                    <span class="rounded-circle border border-light d-inline-flex align-items-center justify-content-center me-2 fw-bold" style="width:44px;height:44px;">BA</span>
                    <div class="d-flex flex-column lh-sm">
                        <span class="fw-bold">Bergarako Antzoki Web</span>
                        <small class="text-warning">ADMIN</small>
                    </div>
                </div>
                <div class="col-10 bg-white d-flex justify-content-between align-items-center p-4">
                    <div class="d-flex flex-column">
                        <small class="fw-bold text-danger">ADMINISTRAZIOA</small>
                        @auth
                        <span class="fs-4 fw-semibold">Egun on, {{ auth()->user()->izena }}</span>
                        @endauth
                    </div>
                    @auth
                    <div class="d-flex align-items-center">
                        <span class="rounded-circle bg-danger text-white d-inline-flex align-items-center justify-content-center me-2 fw-bold" style="width:44px;height:44px;">{{ strtoupper(substr(auth()->user()->izena, 0, 2)) }}</span>
                        <div class="d-flex flex-column lh-sm">
                            <span class="fw-semibold">{{ auth()->user()->izena }}</span>
                            <small class="text-muted">Administratzailea</small>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </header>
    <main class="flex-grow-1 d-flex overflow-hidden">
        <div class="d-flex flex-grow-1 bg-light" style="min-height:0;">
            <div class="nav flex-column nav-pills col-2 bg-dark p-3" style="--bs-nav-pills-link-active-bg: var(--bs-danger);" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link text-white text-start active" id="v-pills-dashboard-tab" data-bs-toggle="pill" data-bs-target="#v-pills-dashboard" type="button" role="tab" aria-controls="v-pills-dashboard" aria-selected="true">Dashboard</button>
                <button class="nav-link text-white text-start" id="v-pills-ekitaldiak-tab" data-bs-toggle="pill" data-bs-target="#v-pills-ekitaldiak" type="button" role="tab" aria-controls="v-pills-ekitaldiak" aria-selected="false">Ekitaldiak</button>
                <button class="nav-link text-white text-start" id="v-pills-erabiltzaileak-tab" data-bs-toggle="pill" data-bs-target="#v-pills-erabiltzaileak" type="button" role="tab" aria-controls="v-pills-erabiltzaileak" aria-selected="false">Erabiltzaileak</button>
                <button class="nav-link text-white text-start" id="v-pills-sarrerak-tab" data-bs-toggle="pill" data-bs-target="#v-pills-sarrerak" type="button" role="tab" aria-controls="v-pills-sarrerak" aria-selected="false">Saldutako sarrerak</button>
                <a href="/" class="mt-auto pt-3 border-top border-secondary text-white text-decoration-none d-flex justify-content-between">
                    <span>Publikora joan</span><span>→</span>
                </a>
            </div>
            <div class="tab-content admin-main flex-grow-1 p-4 d-flex flex-column overflow-hidden" id="v-pills-tabContent">
                {{-- DASHBOARD --}}
                @include('admin.dashboard')
                {{-- EKITALDIAK --}}
                <div class="tab-pane fade" id="v-pills-ekitaldiak" role="tabpanel" aria-labelledby="v-pills-ekitaldiak-tab" tabindex="0">
                    ...EKITALDIAK
                </div>
                {{-- ERABILTZAILEAK --}}
                <div class="tab-pane fade" id="v-pills-erabiltzaileak" role="tabpanel" aria-labelledby="v-pills-erabiltzaileak-tab" tabindex="0">
                    ...ERABILTZAILEAK
                </div>
                {{-- SARRERAK --}}
                <div class="tab-pane fade" id="v-pills-sarrerak" role="tabpanel" aria-labelledby="v-pills-sarrerak-tab" tabindex="0">
                    @include('admin.sarrerak.sarreraDashboard', ['sarrerak' => $sarrerak])
                </div>
            </div>
        </div>
    </main>


</body>

</html>