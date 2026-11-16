{{-- Ze plantila erabili behar den definitu: --}}
@extends('layouts.arrunta')

{{-- Webgune honen estiloa kargatu --}}
@push('styles')
@vite('resources/css/erosketaProzezua.css')
@endpush


{{-- Plantilan txertatuko dena garatu: --}}
@section('content1')

<div class="flow-page checkout-page">
    <header class="site-header">
        <div class="header-inner">
            <button class="brand" aria-label="Hasierara">
                <span class="brand-mark">BA</span>
                <span>Bergarako <i>Antzoki Web</i></span>
            </button>
            <nav>
                <button>Ekitaldiak</button>
                <button type="button" class="btn btn-outline ">Erregistratu / Saioa</button>
            </nav>
        </div>
    </header>

    <div class="stepper">
        <div class="active">
            <span>
                <svg aria-hidden="true" class="icon" width="15" height="15" viewBox="0 0 24 24">
                    <path d="m5 12 4 4L19 6"></path>
                </svg>
            </span>
            <b>Sesioa eta Butakak</b>
        </div>
        <div class="active">
            <span>2</span><b>Ordainketa</b></div>
            <div class="">
                <span>3</span>
                <b>Berrespena</b>
            </div>
        </div>
        <main class="checkout-layout">
            <form class="checkout-form">
                <div class="flow-title">
                    <button type="button">← Atzera</button>
                    <span class="eyebrow">Ordainketa segurua</span>
                    <h1>Osatu zure erosketa</h1>
                </div>
                <section class="form-section">
                    <div class="form-section-title">
                        <span>1</span>
                        <div>
                            <h2>Harremanetarako datuak</h2>
                            <p>Sarrerak helbide honetara bidaliko ditugu.</p>
                        </div>
                    </div>
                    <label class="field">
                        <span>Izen-abizenak<b> *</b></span>
                        <input placeholder="Adib. Ane Aranburu" required="" type="text"name="nombre" value="{{ auth()->check() ? auth()->user()->name : '' }}">
                    </label>
                    <div class="field-grid">
                        <label class="field">
                            <span>Emaila<b> *</b></span>
                            <input placeholder="ane@email.eus" required="" type="email"name="email" value="{{ auth()->check() ? auth()->user()->email : '' }}">
                        </label>
                        <label class="field">
                            <span>Telefono zenbakia<b> *</b></span>
                            <input placeholder="+34 600 000 000" required="" type="tel" name="telefono">
                        </label>
                    </div>
                </section>
                <section class="form-section">
                    <div class="form-section-title">
                        <span>2</span>
                        <div>
                            <h2>Ordainketa-metodoa</h2>
                            <p>Aukeratu zuretzat erosoena den aukera.</p>
                        </div>
                    </div>
                    <div class="payment-tabs">
                        <button type="button" class="active">
                            <svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                                <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                                <path d="M2 10h20"></path>
                            </svg>Txartela
                        </button>
                        <button type="button" class="">Bizum</button>
                        <button type="button" class="">Apple Pay</button>
                    </div>
                    <div class="card-fields">
                        <label class="field">
                            <span>Txartelaren zenbakia<b> *</b></span>
                            <input placeholder="1234 5678 9012 3456" required="" type="text">
                        </label>
                        <div class="field-grid">
                            <label class="field">
                                <span>Iraungitzea<b> *</b></span>
                                <input placeholder="MM/YY" required="" type="text"></label>
                                <label class="field">
                                    <span>CVV<b> *</b></span>
                                    <input placeholder="123" required="" type="text"></label>
                                </div>
                            </div>
                        </section>
                        <label class="checkbox">
                            <input required="" type="checkbox">
                            <span>
                                <svg aria-hidden="true" class="icon" width="14" height="14" viewBox="0 0 24 24">
                                    <path d="m5 12 4 4L19 6"></path>
                                </svg>
                            </span>Baldintzak eta pribatutasuna onartzen ditut.
                        </label>
                        <button type="submit" class="btn btn-primary mobile-pay">Ordaindu orain · 23,50€</button>
                    </form>
                    <aside class="order-summary">
                        <span class="eyebrow">Zure eskaera</span>
                        <h2>Erosketaren laburpena</h2>
                        
                        <div class="summary-event">
                            <!-- Imagen del evento dinámico -->
                            <img alt="{{ $ekitaldia->izena }}" src="{{ asset($ekitaldia->irudia) }}">
                            <div>
                                <!-- Nombre y fecha del evento dinámico -->
                                <b>{{ $ekitaldia->izena }}</b>
                                <span>{{ \Carbon\Carbon::parse($ekitaldia->data)->translatedFormat('M. j · H:i') }}</span>
                            </div>
                        </div>
                    
                        <!-- Bucle para mostrar todos los asientos seleccionados -->
                        @foreach($aukeratutakoEserlekuak as $asiento)
                        <div class="ticket-line">
                            <span>{{ $asiento->lerro_zenb }}. ilara · {{ $asiento->eserleku_zenb }}. eserlekua</span>
                            <b>{{ number_format($prezioa, 2, ',', '.') }}€</b>
                            
                            <!-- Inputs ocultos para pasar los IDs de los asientos seleccionados al siguiente paso (pago) -->
                            <input type="hidden" name="eserlekuak[]" value="{{ $asiento->id }}">
                        </div>
                        @endforeach
                    
                        <div class="price-lines">
                            <div>
                                <span>Azpitotala ({{ $kopurua }} sarrera)</span>
                                <b>{{ number_format($azpitotala, 2, ',', '.') }}€</b>
                            </div>
                            <div>
                                <span>Kudeaketa-gastuak</span>
                                <b>{{ number_format($kudeaketaGastuak, 2, ',', '.') }}€</b>
                            </div>
                        </div>
                        
                        <div class="summary-total">
                            <span>Guztira</span>
                            <strong>{{ number_format($guztira, 2, ',', '.') }}€</strong>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Ordaindu orain · {{ number_format($guztira, 2, ',', '.') }}€ 
                            <svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                                <path d="M5 12h14"></path>
                                <path d="m13 6 6 6-6 6"></path>
                            </svg>
                        </button>
                        
                        <small>
                            <svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                                <path d="m5 12 4 4L19 6"></path>
                            </svg> SSL bidez babestutako ordainketa
                        </small>
                    </aside>
                    </main>
                    <footer class="footer">
                        <div>
                            <strong>Bergarako Antzoki Web</strong>
                            <span>Kultura, zuzen-zuzenean.</span>
                        </div>
                        <p>© 2026 Bergarako Udala · Pribatutasuna · Lege oharra</p>
                    </footer>
                </div>
@endsection