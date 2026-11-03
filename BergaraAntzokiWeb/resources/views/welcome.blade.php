{{-- Ze plantila erabili behar den definitu: --}}
@extends('plantilla.arrunta')

{{-- Webgune honen estiloa kargatu --}}
@push('styles')
@vite('resources/css/hasieraorria.css')
@endpush


{{-- Plantilan txertatuko dena garatu: --}}
@section('content1')


{{-- carousel --}}
<section id="ekitaldiKarrusela" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($ekitaldiak as $ekitaldia)
        <div class="carousel-item {{ $loop->first ? 'active' : '' }}"
            style="background-image: linear-gradient(90deg, rgba(20,16,18,.9), rgba(20,16,18,.2)), url('{{ $ekitaldia->irudia }}');">
            <div class="hero-content">
                <h2>{{ $ekitaldia->izena }}</h2>
                <p>{{ $ekitaldia->data }}</p>
                <p>{{ $ekitaldia->aretoa->izena }}</p>
                <button type="button" class="btn btn-primary">Sarrerak erosi</button>
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
                        <p class="prezioa "><strong>{{$ekitaldia->sarrerak->min('prezioa')}} €</strong></p>
                    </div>
                    <button type="button" class="btn btn-dark ">Sarrerak erosi</button>
                </div>
            </div>
        </article>
        @endforeach
    </div>
</section>


@endsection