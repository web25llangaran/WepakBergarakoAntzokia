{{-- Ze plantila erabili behar den definitu: --}}
@extends('layouts.arrunta')

{{-- Webgune honen estiloa eta filtroen JavaScript-a kargatu --}}
@push('styles')
@vite(['resources/css/hasieraorria.css', 'resources/js/hasieraorria.js'])
@endpush


{{-- Plantilan txertatuko dena garatu: --}}
@section('content1')

{{-- Ekitaldiak irudirik ez badu, hau erakutsiko da --}}
@php($irudiLehenetsia = 'https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?auto=format&fit=crop&w=1600&q=80')

{{-- carousel --}}
<section id="ekitaldiKarrusela" class="carousel slide hero-karrusela" data-bs-ride="carousel">

    {{-- Puntuak: zenbat irudi dauden eta zein den ikusten ari garena --}}
    <div class="carousel-indicators">
        @foreach ($ekitaldiak as $ekitaldia)
        <button type="button" data-bs-target="#ekitaldiKarrusela" data-bs-slide-to="{{ $loop->index }}"
            class="{{ $loop->first ? 'active' : '' }}" aria-label="{{ $ekitaldia->izena }}"></button>
        @endforeach
    </div>

    <div class="carousel-inner">
        @foreach ($ekitaldiak as $ekitaldia)
        <div class="carousel-item {{ $loop->first ? 'active' : '' }}"
            style="background-image: linear-gradient(90deg, rgba(20, 18, 20, 0.95) 0%, rgba(20, 18, 20, 0.65) 50%, rgba(20, 18, 20, 0.1)), url('{{ $ekitaldia->irudia ?: $irudiLehenetsia }}');">
            <div class="hero-content">
                <span class="hero-eyebrow">{{ $ekitaldia->ekitaldi_mota }} · {{ $ekitaldia->aretoa->izena }}</span>
                <h2>{{ $ekitaldia->izena }}</h2>
                <p class="hero-data">{{ $ekitaldia->data->format('Y/m/d · H:i') }}</p>
                <a href="{{ route('ekitaldiak.show', $ekitaldia) }}" class="btn btn-primary">Sarrerak erosi</a>
            </div>
        </div>
        @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#ekitaldiKarrusela" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Aurrekoa</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#ekitaldiKarrusela" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Hurrengoa</span>
    </button>
</section>
{{-- FIN carousel --}}



<section class="catalog-section" id="ekitaldiak">
    <div class="section-heading">
        <div>
            <span class="eyebrow">Programazioa</span>
            <h2>Datozen ekitaldiak</h2>
        </div>
        <p>Aurkitu zure hurrengo kultura-plana Bergaran.</p>
    </div>
    <div class="filter-bar">
        <label class="search-field">
            <svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="7"></circle>
                <path d="m20 20-4-4"></path>
            </svg>
            <input id="filtro-bilatu" placeholder="Bilatu..." value="">
        </label>
        <label class="field">
            {{-- Aukerak datu baseko ekitaldi motetatik ateratzen dira --}}
            <select id="filtro-mota">
                <option value="">Guztiak</option>
                @foreach (\App\Enums\EkitaldiMota::cases() as $mota)
                <option value="{{ $mota->value }}">{{ ucfirst($mota->value) }}</option>
                @endforeach
            </select>
        </label>
        <label class="date-field">
            <svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                <path d="M16 3v4M8 3v4M3 10h18"></path>
            </svg>
            <input id="filtro-data" aria-label="Data filtratu" type="date">
        </label>
        <button type="button" class="btn btn-primary" id="filtratu-botoia">Filtratu</button>
    </div>
    <div class="event-grid">
        @foreach ($ekitaldiak as $ekitaldia)
        {{-- data-* atributuak JavaScript-eko filtroek irakurtzen dituzte --}}
        <article class="event-card"
            data-izena="{{ strtolower($ekitaldia->izena) }}"
            data-mota="{{ $ekitaldia->ekitaldi_mota }}"
            data-data="{{ $ekitaldia->data->format('Y-m-d') }}">
            <a href="{{ route('ekitaldiak.show', $ekitaldia) }}" class="event-image">
                <img alt="{{ $ekitaldia->izena }}" src="{{ $ekitaldia->irudia ?: $irudiLehenetsia }}">
                <span>{{$ekitaldia->ekitaldi_mota}}</span>
            </a>
            <div class="event-body">
                <p class="date">{{ $ekitaldia->data->format('Y/m/d · H:i') }}</p>
                <h3>{{$ekitaldia->izena}}</h3>
                <p class="hall">
                    <svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                        <path d="M6 11v7M18 11v7M4 18h16v3H4z"></path>
                        <path d="M7 14V6a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v8"></path>
                    </svg> {{ $ekitaldia->aretoa->izena }}
                </p>
                <div class="event-bottom">
                    <div>
                        <small>Preziotik</small>
                        <p class="prezioa "><strong>{{$ekitaldia->sarrerak->min('prezioa')}} €</strong></p>
                    </div>
                    <a href="{{ route('ekitaldiak.show', [$ekitaldia->id]) }}" class="btn btn-dark">Sarrerak erosi</a>
                </div>
            </div>
        </article>
        @endforeach
    </div>

    {{-- Filtroekin ekitaldirik aurkitzen ez bada erakusten da --}}
    <p class="emaitzarik-ez" id="emaitzarik-ez" hidden>Ez da ekitaldirik aurkitu bilaketa honekin.</p>
</section>


@endsection
