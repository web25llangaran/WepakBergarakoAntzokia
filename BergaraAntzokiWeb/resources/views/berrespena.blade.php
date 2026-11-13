{{-- Ze plantila erabili behar den definitu: --}}
@extends('plantilla.arrunta')

{{-- Orri honen estiloa kargatu --}}
@push('styles')
@vite('resources/css/berrespena.css')
@endpush

@section('content1')

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

                    <span class="eyebrow">Ordainketa baieztatuta</span>
                    <h1>Ordainketa ondo burutu da</h1>
                    <p class="subtitle">Su pago ha sido realizado / Zure ordainketa behar bezala egin da</p>

                    {{-- QR kodea (geroago automatikoki sortuko da) --}}
                    <div class="qr-box mx-auto" id="qr-kodea"></div>

                    {{-- Erosketaren datuak --}}
                    <dl class="datuak text-start">
                        <div class="d-flex justify-content-between align-items-center gap-3">
                            <dt>Ekitaldia</dt>
                            <dd>{{ $ekitaldia->izena }}</dd>
                        </div>
                        <div class="d-flex justify-content-between align-items-center gap-3">
                            <dt>Eserlekua</dt>
                            <dd>{{ $eserlekua->lerro_zenb }}. ilara · {{ $eserlekua->eserleku_zenb }}. eserlekua</dd>
                        </div>
                        <div class="d-flex justify-content-between align-items-center gap-3">
                            <dt>Erreferentzia</dt>
                            <dd>BER-{{ date('Y') }}-{{ str_pad($ekitaldia->id, 4, '0', STR_PAD_LEFT) }}{{ $eserlekua->id }}</dd>
                        </div>
                    </dl>

                    <button type="button" class="btn btn-primary w-100" id="onartu-botoia">
                        Onartu / Aceptar
                        <svg aria-hidden="true" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                            <path d="m13 6 6 6-6 6"></path>
                        </svg>
                    </button>

                    <small>Sarrerak eta faktura zure emailera bidali ditugu.</small>
                </section>

            </div>
        </div>
    </div>
</div>

@endsection
