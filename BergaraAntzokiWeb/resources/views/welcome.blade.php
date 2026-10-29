{{-- Ze plantila erabili behar den definitu: --}}
@extends('plantilla.arrunta')

{{-- Webgune honen estiloa kargatu --}}
@push('styles')
@vite('resources/css/hasieraorria.css')
@endpush


{{-- Plantilan txertatuko dena garatu: --}}
@section('content1')

<section class="hero"
    style="background-image: linear-gradient(90deg, rgba(20, 16, 18, 0.9), rgba(20, 16, 18, 0.2)), url(&quot;https://images.unsplash.com/photo-1514306191717-452ec28c7814?auto=format&amp;fit=crop&amp;w=1800&amp;q=88&quot;);">
    <div class="hero-content">
        <span class="eyebrow light">Bergarako kultura agenda · 2026</span>
        <p class="hero-kicker">Kultura Bizia Bergaran</p>
        <h1>Erresuma: <em>Shakespeareren Tragediak</em></h1>
        <p>Boterea, traizioa eta maitasuna. Antzerki klasikoa gaur egungo begiradatik, eszenaratze zirraragarri batean.</p>
        <div class="hero-meta">
            <span>
                <svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                    <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                    <path d="M16 3v4M8 3v4M3 10h18"></path>
                </svg>
                Urriak 24
            </span>
            <span>
                <svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="9"></circle>
                    <path d="M12 7v5l3 2"></path>
                </svg>
                20:00
            </span>
        </div>
        <button type="button" class="btn btn-primary ">Sarrerak erosi
            <svg
                aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                <path d="M5 12h14"></path>
                <path d="m13 6 6 6-6 6"></path>
            </svg>
        </button>
    </div>
</section>
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
            <input placeholder="Bilatu..." value="">
        </label>
        <label class="field">
            <select>
                <option>Guztiak</option>
                <option>Antzerkia</option>
                <option>Musika</option>
                <option>Dantza</option>
            </select>
        </label>
        <label class="date-field">
            <svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                <path d="M16 3v4M8 3v4M3 10h18"></path>
            </svg>
            <input aria-label="Data filtratu" type="date">
        </label>
        <button type="button" class="btn btn-primary ">Filtratu</button>
    </div>
    <div class="event-grid">
        @foreach ($ekitaldiak as $ekitaldia)
        <article class="event-card">
            <button class="event-image">
                <img alt="Oskara: Sustraien Dantza ikuskizuna" src="https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?auto=format&amp;fit=crop&amp;w=1000&amp;q=80">
                <span>{{$ekitaldia->ekitaldi_mota}}</span>
            </button>
            <div class="event-body">
                <p class="date">{{$ekitaldia->data}}</p>
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
                        <strong>{{$ekitaldia->sarrerak->min('prezioa')}} €</strong>
                    </div>
                    <button type="button" class="btn btn-dark ">Sarrerak erosi</button>
                </div>
            </div>
        </article>
        @endforeach
    </div>
</section>


@endsection