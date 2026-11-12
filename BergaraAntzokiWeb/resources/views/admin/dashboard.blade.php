{{-- DASHBOARD --}}
@php
    // Datak datu-basean ordu lokalean gordetzen dira (app.timezone = UTC), beraz "orain" ordu lokalean hartu.
    $orain = now('Europe/Madrid')->shiftTimezone(config('app.timezone'));
    $ekitaldiAktiboak = $ekitaldiak->filter(fn ($ekitaldia) => $ekitaldia->data->gte($orain));
    $burututakoEkitaldiak = $ekitaldiak->filter(fn ($ekitaldia) => $ekitaldia->data->lt($orain));
    $erabiltzaileArruntak = $users->where('rola', \App\Enums\Rola::Arrunta->value);
    $silverSarrerak = $sarrerak->filter(fn ($sarrera) => $sarrera->eserlekua->eserleku_mota === \App\Enums\EserlekuMota::Silver_economy->value);

    // Progress barren ehunekoak (zeroz ez zatitzeko max(..., 1)).
    $aktiboEhunekoa = round(count($ekitaldiAktiboak) * 100 / max(count($ekitaldiak), 1));
    $arruntEhunekoa = round(count($erabiltzaileArruntak) * 100 / max(count($users), 1));
    $silverEhunekoa = round(count($silverSarrerak) * 100 / max(count($sarrerak), 1));
@endphp
<div class="tab-pane fade show active overflow-auto" style="min-height:0;" id="v-pills-dashboard" role="tabpanel" aria-labelledby="v-pills-dashboard-tab" tabindex="0">
    <div class="d-flex justify-content-between align-items-end mb-3">
        <div>
            <h2 class="mb-0">Bergarako Antzoki Web gunerako kudeaketa gunea</h2>
            <small class="text-muted">Hona hemen antzokiaren kudeaketarako gunea.</small>
        </div>
        <small class="text-muted">Azken eguneraketa: gaur, {{ now('Europe/Madrid')->format('H:i') }}</small>
    </div>
    <div class="row g-3 mb-4">
        {{-- EKITALDIAK --}}
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <small class="text-uppercase text-muted">Ekitaldi aktiboak</small>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                            <path d="M16 3v4M8 3v4M3 10h18"></path>
                        </svg>
                    </div>
                    <h3 class="mt-2 mb-1">{{ count($ekitaldiAktiboak) }}</h3>
                    <small class="text-muted">{{ count($burututakoEkitaldiak) }} burututa · {{ count($ekitaldiak) }} guztira</small>
                    <div class="progress mt-3" style="height:6px;" role="progressbar" aria-label="Ekitaldi aktiboak" aria-valuenow="{{ $aktiboEhunekoa }}" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-danger" style="width: {{ $aktiboEhunekoa }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- ERABILTZAILEAK --}}
        <div class="col-md-4">
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
                    <h3 class="mt-2 mb-1">{{ count($users) }}</h3>
                    <small class="text-muted">{{ count($erabiltzaileArruntak) }} arrunta · {{ count($users) - count($erabiltzaileArruntak) }} admin</small>
                    <div class="progress mt-3" style="height:6px;" role="progressbar" aria-label="Erabiltzaile arruntak" aria-valuenow="{{ $arruntEhunekoa }}" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-danger" style="width: {{ $arruntEhunekoa }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- SARRERAK --}}
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <small class="text-uppercase text-muted">Saldutako sarrerak</small>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 7a2 2 0 0 0 0 4v6h18v-6a2 2 0 0 0 0-4V5H3Z"></path>
                            <path d="M13 5v12"></path>
                        </svg>
                    </div>
                    <h3 class="mt-2 mb-1">{{ count($sarrerak) }}</h3>
                    <small class="text-muted">{{ count($silverSarrerak) }} Silver economy ({{ $silverEhunekoa }}%)</small>
                    <div class="progress mt-3" style="height:6px;" role="progressbar" aria-label="Silver economy sarrerak" aria-valuenow="{{ $silverEhunekoa }}" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-danger" style="width: {{ $silverEhunekoa }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- EKITALDIEN KUDEAKETA GEHITU: EKITALDIA.DASHBOARD --}}
        <div class="col-12">
            @include('admin.ekitaldiak.dashboard')
        </div>
    </div>
</div>
