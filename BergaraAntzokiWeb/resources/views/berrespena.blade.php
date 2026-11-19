{{-- Ze plantila erabili behar den definitu: --}}
@extends('layouts.arrunta')

{{-- Orri honen estiloa kargatu --}}
@push('styles')
@vite('resources/css/berrespena.css')
@endpush

@section('content1')

{{-- Página de confirmación: tarjeta centrada con el check, el QR, los datos de la compra y el botón Aceptar. --}}
<div class="berrespena-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-6">

                <section class="berrespena-card text-center">

                    {{-- Egiaztapen ikonoa --}}
                    <div class="check-circle mx-auto">
                        <svg aria-hidden="true" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m5 12 4 4L19 6"></path>
                        </svg>
                    </div>

                    {{-- Títulos de "pago realizado correctamente". --}}
                    <span class="eyebrow">Ordainketa baieztatuta</span>
                    <h1>Ordainketa ondo burutu da</h1>
                    <p class="subtitle">Su pago ha sido realizado / Zure ordainketa behar bezala egin da</p>

                    {{-- QR kodea (oraingoz irudi estatikoa, beti berbera) --}}
                    <div class="qr-box mx-auto" id="qr-kodea">
                        <img src="{{ asset('img/qr-sarrera.svg') }}" alt="Sarreraren QR kodea">
                    </div>

                    {{-- Sarrera bat baino gehiago badaude, QR-ak gainerakoak ere erakusten ditu --}}
                    @if ($eserlekuak->count() > 1)
                    <p class="qr-oharra">
                        Eskaneatu zure QR-a gainerako sarrerak ikusteko<br>
                        Escanea tu QR para ver las demás entradas
                    </p>
                    @endif

                    {{-- Erosketaren datuak --}}
                    <dl class="datuak text-start">
                        <div class="d-flex justify-content-between align-items-center gap-3">
                            {{-- Nombre del evento. --}}
                            <dt>Ekitaldia</dt>
                            <dd>{{ $ekitaldia->izena }}</dd>
                        </div>
                        <div class="d-flex justify-content-between align-items-center gap-3">
                            {{-- Lista de butacas compradas (fila y número). --}}
                            <dt>{{ $eserlekuak->count() > 1 ? 'Eserlekuak' : 'Eserlekua' }}</dt>
                            <dd>
                                @foreach ($eserlekuak as $eserlekua)
                                <span class="d-block">{{ $eserlekua->lerro_zenb }}. ilara · {{ $eserlekua->eserleku_zenb }}. eserlekua</span>
                                @endforeach
                            </dd>
                        </div>
                        <div class="d-flex justify-content-between align-items-center gap-3">
                            {{-- Código de referencia de la compra: BER-año-ID del evento-ID de la primera butaca. --}}
                            <dt>Erreferentzia</dt>
                            <dd>BER-{{ date('Y') }}-{{ str_pad($ekitaldia->id, 4, '0', STR_PAD_LEFT) }}{{ $eserlekuak->first()->id }}</dd>
                        </div>
                    </dl>

                    {{-- Onartu: sarrerak gorde (eserlekuak okupatuta geratzen dira) eta hasierako orrira itzuli, saioa itxi gabe --}}
                    <form method="POST" action="{{ route('ekitaldiak.berrespena.onartu', $ekitaldia) }}">
                        {{-- Mandamos el token CSRF (seguridad) y un input oculto por cada butaca para que el controlador las guarde como entradas. --}}
                        @csrf
                        @foreach ($eserlekuak as $eserlekua)
                        <input type="hidden" name="eserlekuak[]" value="{{ $eserlekua->id }}">
                        @endforeach

                        <button type="submit" class="btn btn-primary w-100" id="onartu-botoia">
                            Onartu / Aceptar
                            <svg aria-hidden="true" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="m13 6 6 6-6 6"></path>
                            </svg>
                        </button>
                    </form>

                    <small>Sarrerak eta faktura zure emailera bidali ditugu.</small>
                </section>

            </div>
        </div>
    </div>
</div>

@endsection
