{{-- Ze plantila erabili behar den definitu: --}}
@extends('layouts.arrunta')

{{-- Webgune honen estiloa eta JavaScript-a kargatu (JavaScript fitxategiak CSS-a berak inportatzen du, popup.js-ek egiten duen bezala) --}}
@push('styles')
@vite('resources/js/eserlekuak.js')
@endpush

{{-- Plantilan txertatuko dena garatu: --}}
@section('content1')

@php
    // Ekitaldiaren izena bakarrik ":" aurretik (adibidez "Erresuma: Shakespeareren Tragediak" -> "Erresuma").
    $izenLaburra = Str::before($ekitaldia->izena, ':');
    $data = $ekitaldia->data->locale('eu');
    $irudia = $ekitaldia->irudia ?: 'https://images.unsplash.com/photo-1503095396549-807759245b35?auto=format&fit=crop&w=1600&q=88';
@endphp

<div class="flow-page">

    {{-- Urratsak --}}
    <div class="stepper">
        <div class="active"><span>1</span><b>Sesioa eta Butakak</b></div>
        <div><span>2</span><b>Ordainketa</b></div>
        <div><span>3</span><b>Berrespena</b></div>
    </div>

    <div class="container seat-layout"
        id="eserlekuak"
        data-prezioa="{{ $prezioa }}"
        data-silver-prezioa="{{ $silverPrezioa }}"
        data-silver-mota="{{ $silverMota }}">
        <div class="row g-4">

            {{-- Eserlekuen mapa --}}
            <div class="col-md">
                <section class="seat-main">
                    <div class="seat-heading d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <div>
                            <span class="eyebrow">{{ $ekitaldia->aretoa->izena }}</span>
                            <h1>Aukeratu zure eserlekuak</h1>
                            <p>{{ $data->translatedFormat('Y') }}ko {{ $data->translatedFormat('F') }}ren {{ $data->translatedFormat('j') }}a · {{ $data->format('H:i') }}</p>
                        </div>
                        <button type="button" class="btn btn-violet" id="silver-botoia">
                            <span class="plus-badge">65+</span>Silver Economy <small>+65 adinekoak</small>
                        </button>
                    </div>

                    {{-- Silver Economy aukeratzean agertzen den mezua --}}
                    <div class="silver-note d-none" id="silver-oharra">
                        <div>
                            <b>Silver Economy eserlekua automatikoki esleituta</b>
                            <span>Eszenatokitik gertuen dauden eserleku libreak gorde dizkizugu, lehen ilaratik hasita. Ordainketa leihatilan egingo da.</span>
                        </div>
                        <label class="silver-quantity">
                            <span>Sarrera kopurua</span>
                            <select class="form-select" id="silver-kopurua"></select>
                        </label>
                    </div>

                    <div class="seat-map">
                        <div class="stage"><span>ESZENATOKIA</span></div>

                        @foreach ($lerroak as $lerroZenbakia => $eserlekuak)
                        @php $silverLerroa = $eserlekuak->first()->eserleku_mota === $silverMota; @endphp
                        <div class="seat-row {{ $silverLerroa ? 'silver-row' : '' }}">
                            <span class="row-label">{{ $lerroZenbakia }}. ILARA</span>
                            <div>
                                @foreach ($eserlekuak as $eserlekua)
                                @php
                                    $silver = $eserlekua->eserleku_mota === $silverMota;
                                    $okupatuta = in_array($eserlekua->id, $okupatutakoEserlekuak);
                                @endphp
                                <button type="button"
                                    class="seat {{ $silver ? 'silver' : '' }} {{ $okupatuta ? 'booked' : '' }}"
                                    data-id="{{ $eserlekua->id }}"
                                    data-lerroa="{{ $eserlekua->lerro_zenb }}"
                                    data-zenbakia="{{ $eserlekua->eserleku_zenb }}"
                                    data-mota="{{ $eserlekua->eserleku_mota }}"
                                    aria-label="{{ $eserlekua->lerro_zenb }}. ilara, {{ $eserlekua->eserleku_zenb }}. eserlekua{{ $silver ? ', Silver Economy bidez automatikoki esleitzeko' : '' }}"
                                    @disabled($silver || $okupatuta)>
                                    <span>{{ $eserlekua->eserleku_zenb }}</span>
                                </button>
                                @endforeach
                            </div>
                        </div>
                        @endforeach

                        <div class="legend">
                            <span><i class="available"></i>Libre</span>
                            <span><i class="chosen"></i>Hautatua</span>
                            <span><i class="occupied"></i>Okupatua</span>
                            <span><i class="silver"></i>Silver Economy</span>
                        </div>
                    </div>
                </section>
            </div>

            {{-- Laburpena --}}
            <div class="col-md-auto summary-col">
                <aside class="summary-panel">
                    <span class="eyebrow">Zure aukeraketa</span>
                    <h2>Laburpena</h2>

                    <div class="summary-event">
                        <img alt="" src="{{ $irudia }}">
                        <div>
                            <b>{{ $izenLaburra }}</b>
                            <span>{{ $data->translatedFormat('M') }} {{ $data->translatedFormat('j') }} · {{ $data->format('H:i') }}</span>
                        </div>
                    </div>

                    <div class="selected-list" id="aukeratutakoZerrenda">
                        <p class="empty-selection" id="zerrenda-hutsik">
                            <svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                                <path d="M6 11v7M18 11v7M4 18h16v3H4z"></path>
                                <path d="M7 14V6a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v8"></path>
                            </svg>Oraindik ez duzu eserlekurik aukeratu.
                        </p>
                    </div>

                    <div class="summary-row"><span>Kopurua</span><b id="sarrera-kopurua">0 sarrera</b></div>
                    <div class="summary-total"><span>Guztira</span><strong id="guztira">0,00€</strong></div>

                    <button type="button" class="btn btn-primary" id="ordaindu-botoia" disabled>
                        <span id="ordaindu-testua">Ordaindu (Online)</span>
                        <svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                            <path d="M5 12h14"></path>
                            <path d="m13 6 6 6-6 6"></path>
                        </svg>
                    </button>
                    <small>
                        <svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                            <path d="m5 12 4 4L19 6"></path>
                        </svg> Ordainketa segurua eta datu babestuak
                    </small>
                </aside>
            </div>

        </div>
    </div>
</div>

@endsection
