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

<body>
    <header>
        <div class="container-fluid">
            <div class="row border-bottom border-secondary-subtle">
                <div class="col-3 justify-content-center d-flex admin-logo p-4 ">
                    <div class="logo-circle me-2">
                        <span>BA</span>
                    </div>
                    <div class="logo-text">
                        <span class="brand-title">Bergarako Antzoki Web</span>
                        <span class="brand-subtitle">ADMIN</span>
                    </div>
                </div>
                <div class="col-9 admin-user-info p-4">
                    <div class="logo-text">
                        <span class="user-title">ADMINISTRAZIOA</span>
                        @auth
                        <span class="user-subtitle mt-1">Kaixo {{ auth()->user()->izena }}</span>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="flex-grow-1 d-flex">
        <div class="d-flex flex-grow-1">
            <div class="nav flex-column nav-pills col-3 admin-menua" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link active" id="v-pills-dashboard-tab" data-bs-toggle="pill" data-bs-target="#v-pills-dashboard" type="button" role="tab" aria-controls="v-pills-dashboard" aria-selected="true">Dashboard</button>
                <button class="nav-link" id="v-pills-ekitaldiak-tab" data-bs-toggle="pill" data-bs-target="#v-pills-ekitaldiak" type="button" role="tab" aria-controls="v-pills-ekitaldiak" aria-selected="false">Ekitaldiak</button>
                <button class="nav-link" id="v-pills-erabiltzaileak-tab" data-bs-toggle="pill" data-bs-target="#v-pills-erabiltzaileak" type="button" role="tab" aria-controls="v-pills-erabiltzaileak" aria-selected="false">Erabiltzaileak</button>
                <button class="nav-link" id="v-pills-sarrerak-tab" data-bs-toggle="pill" data-bs-target="#v-pills-sarrerak" type="button" role="tab" aria-controls="v-pills-sarrerak" aria-selected="false">Sarrerak</button>
            </div>
            <div class="tab-content admin-main flex-grow-1 p-4" id="v-pills-tabContent">
                {{-- DASHBOARD --}}
                <div class="tab-pane fade show active" id="v-pills-dashboard" role="tabpanel" aria-labelledby="v-pills-dashboard-tab" tabindex="0">
                    <div class="d-flex justify-content-between align-items-end mb-3">
                        <div>
                            <h2 class="mb-0">Dashboard</h2>
                            <small class="text-muted">Hona hemen antzokiaren kudeaketarako gunea.</small>
                        </div>
                        <small class="text-muted">Azken eguneraketa: gaur, 10:42</small>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <small class="text-uppercase text-muted">Salmentak guztira</small>
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                                            <path d="M2 10h20"></path>
                                        </svg>
                                    </div>
                                    <h3 class="mt-2 mb-1">48.240€</h3>
                                    <small class="text-success">+12,5%</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <small class="text-uppercase text-muted">Sarrera salduak</small>
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M3 7a2 2 0 0 0 0 4v6h18v-6a2 2 0 0 0 0-4V5H3Z"></path>
                                            <path d="M13 5v12"></path>
                                        </svg>
                                    </div>
                                    <h3 class="mt-2 mb-1">2.184</h3>
                                    <small class="text-success">+8,2%</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <small class="text-uppercase text-muted">Ekitaldi aktiboak</small>
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                                            <path d="M16 3v4M8 3v4M3 10h18"></path>
                                        </svg>
                                    </div>
                                    <h3 class="mt-2 mb-1">12</h3>
                                    <small class="text-success">3 aste honetan</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <small class="text-uppercase text-muted">Erabiltzaileak</small>
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                            <path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"></path>
                                        </svg>
                                    </div>
                                    <h3 class="mt-2 mb-1">4.892</h3>
                                    <small class="text-success">+156 hilabete honetan</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                    <section class="admin-content">
                        <div class="admin-intro">
                            <div>
                                <h2>Sarrerak</h2>
                                <p>Salmentak eta erreserbak egiaztatu.</p>
                            </div><span>Azken eguneraketa: gaur, 10:42</span>
                        </div>
                        <section class="admin-table-card">
                            <div class="table-header">
                                <div>
                                    <h2>Sarrerak eta erreserbak</h2>
                                    <p>Azken salmenten jarraipena.</p>
                                </div><button type="button" class="btn btn-primary ">+ Sarrera gehitu</button>
                            </div>
                            <div class="admin-table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Erreferentzia</th>
                                            <th>Bezeroa</th>
                                            <th>Ekitaldia</th>
                                            <th>Mota</th>
                                            <th>Zenbatekoa</th>
                                            <th>Egoera</th>
                                            <th>Ekintzak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><b>BER-2026-9812A</b></td>
                                            <td>Ane Aranburu</td>
                                            <td>Erresuma</td>
                                            <td>Online</td>
                                            <td>23,50€</td>
                                            <td><span class="status">Ordainduta</span></td>
                                            <td>
                                                <div class="actions"><button aria-label="Ikusi"><svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                                                            <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"></path>
                                                            <circle cx="12" cy="12" r="2.5"></circle>
                                                        </svg></button><button aria-label="Editatu"><svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                                                            <path d="M12 20h9"></path>
                                                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"></path>
                                                        </svg></button><button aria-label="Ezabatu"><svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                                                            <path d="M3 6h18M8 6V4h8v2M19 6l-1 15H6L5 6M10 11v5M14 11v5"></path>
                                                        </svg></button></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>BER-SE-2026-1148</b></td>
                                            <td>Joxe Mari Aranburu</td>
                                            <td>Erresuma</td>
                                            <td>Silver Economy</td>
                                            <td>12,00€</td>
                                            <td><span class="status">Erreserbatuta</span></td>
                                            <td>
                                                <div class="actions"><button aria-label="Ikusi"><svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                                                            <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"></path>
                                                            <circle cx="12" cy="12" r="2.5"></circle>
                                                        </svg></button><button aria-label="Editatu"><svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                                                            <path d="M12 20h9"></path>
                                                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"></path>
                                                        </svg></button><button aria-label="Ezabatu"><svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                                                            <path d="M3 6h18M8 6V4h8v2M19 6l-1 15H6L5 6M10 11v5M14 11v5"></path>
                                                        </svg></button></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>BER-2026-9734B</b></td>
                                            <td>Nora Agirre</td>
                                            <td>Izaro</td>
                                            <td>Online</td>
                                            <td>19,50€</td>
                                            <td><span class="status">Ordainduta</span></td>
                                            <td>
                                                <div class="actions"><button aria-label="Ikusi"><svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                                                            <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"></path>
                                                            <circle cx="12" cy="12" r="2.5"></circle>
                                                        </svg></button><button aria-label="Editatu"><svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                                                            <path d="M12 20h9"></path>
                                                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"></path>
                                                        </svg></button><button aria-label="Ezabatu"><svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                                                            <path d="M3 6h18M8 6V4h8v2M19 6l-1 15H6L5 6M10 11v5M14 11v5"></path>
                                                        </svg></button></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </section>
                </div>
            </div>
        </div>
    </main>


</body>

</html>