<!DOCTYPE html>
<html lang="eu">

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

    {{-- Feedback mezuak (sortu, eguneratu, ezabatu) --}}
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show position-fixed bottom-0 end-0 m-4 shadow" style="z-index:1080;" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Itxi"></button>
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show position-fixed bottom-0 end-0 m-4 shadow" style="z-index:1080;" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Itxi"></button>
    </div>
    @endif

    {{--
      Alboko menua orri guztietan. Dashboard-ean fitxak aldatzen ditu (Bootstrap pills);
      beste orrietan dashboard-eko fitxa horretara eramaten du (#hash bidez).
      Orri bakoitzak @section('fitxa', '...') erabil dezake menuko aukera aktiboa adierazteko.
    --}}
    @php
        $dashboardanDago = request()->routeIs('admin.dashboard');
        $fitxaAktiboa = trim($__env->yieldContent('fitxa', 'dashboard'));
        $menukoFitxak = [
            'dashboard' => 'Dashboard',
            'ekitaldiak' => 'Ekitaldiak',
            'erabiltzaileak' => 'Erabiltzaileak',
            'sarrerak' => 'Saldutako sarrerak',
        ];
    @endphp

    <!-- MAIN - DASHBOARD - EKITALDIAK- ERABILTZAILEAK - SALDUTAKO SARRERAK -->
    <main class="flex-grow-1 d-flex overflow-hidden">
        <div class="d-flex flex-grow-1 bg-light" style="min-height:0;">
            <nav class="nav flex-column nav-pills col-2 bg-dark p-3" style="--bs-nav-pills-link-active-bg: var(--bs-danger);" id="v-pills-tab" @if ($dashboardanDago) role="tablist" @endif aria-orientation="vertical">
                @foreach ($menukoFitxak as $fitxa => $izena)
                <a href="{{ route('admin.dashboard') }}#{{ $fitxa }}"
                    id="v-pills-{{ $fitxa }}-tab"
                    @class(['nav-link text-white text-start', 'active' => $fitxaAktiboa === $fitxa])
                    @if ($dashboardanDago)
                    data-bs-toggle="pill" data-bs-target="#v-pills-{{ $fitxa }}" role="tab"
                    aria-controls="v-pills-{{ $fitxa }}" aria-selected="{{ $fitxaAktiboa === $fitxa ? 'true' : 'false' }}"
                    @endif>{{ $izena }}</a>
                @endforeach
                {{-- Publikora joatean saioa itxi (POST logout); ondoren welcome orrira bideratzen du --}}
                <form method="POST" action="{{ route('logout') }}" class="mt-auto pt-3 border-top border-secondary">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 w-100 text-white text-decoration-none d-flex justify-content-between">
                        <span>Publikora joan / Saioa itxi</span><span>→</span>
                    </button>
                </form>
            </nav>

            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>

</html>
