<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Bergara Antzokia') }}</title>
        @vite(['resources/css/app.css', 'resources/css/hasieraorria.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="page-content">
            <main>
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
                            <input placeholder="Bilatu..." value=""></label>
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
                                <input aria-label="Data filtratu" type="date"></label>
                                <button type="button" class="btn btn-primary ">Filtratu</button>
                            </div>
                            <div class="event-grid">
                                <article class="event-card">
                                    <button class="event-image" aria-label="Erresuma: Shakespeareren Tragediak ekitaldiaren xehetasunak ikusi">
                                        <img alt="Erresuma: Shakespeareren Tragediak ikuskizuna" src="https://images.unsplash.com/photo-1503095396549-807759245b35?auto=format&amp;fit=crop&amp;w=1600&amp;q=88">
                                        <span>Antzerkia</span>
                                        <b>Gomendatua</b>
                                    </button>
                                    <div class="event-body">
                                        <p class="date">2026/10/24 · 20:00</p>
                                        <h3>Erresuma: Shakespeareren Tragediak</h3>
                                        <p class="hall">
                                            <svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                                                <path d="M6 11v7M18 11v7M4 18h16v3H4z"></path>
                                                <path d="M7 14V6a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v8"></path>
                                            </svg>
                                         Areto Nagusia</p>
                                         <div class="event-bottom">
                                            <div>
                                                <small>Preziotik</small>
                                                <strong>22,00€</strong>
                                            </div>
                                            <button type="button" class="btn btn-dark ">Sarrerak erosi</button>
                                        </div>
                                    </div>
                                </article>
                                <article class="event-card">
                                    <button class="event-image" aria-label="Izaro: Cerodenero ekitaldiaren xehetasunak ikusi">
                                        <img alt="Izaro: Cerodenero ikuskizuna" src="https://images.unsplash.com/photo-1501386761578-eac5c94b800a?auto=format&amp;fit=crop&amp;w=1000&amp;q=80">
                                        <span>Musika</span>
                                    </button>
                                    <div class="event-body">
                                        <p class="date">2026/11/07 · 21:00</p>
                                        <h3>Izaro: Cerodenero</h3>
                                        <p class="hall">
                                            <svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                                                <path d="M6 11v7M18 11v7M4 18h16v3H4z"></path>
                                                <path d="M7 14V6a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v8"></path>
                                            </svg>
                                         Areto Nagusia</p>
                                        <div class="event-bottom"><div>
                                            <small>Preziotik</small>
                                            <strong>18,00€</strong>
                                        </div>
                                        <button type="button" class="btn btn-dark ">Sarrerak erosi</button>
                                    </div>
                                </div>
                            </article>
                            <article class="event-card">
                                <button class="event-image" aria-label="Oskara: Sustraien Dantza ekitaldiaren xehetasunak ikusi">
                                    <img alt="Oskara: Sustraien Dantza ikuskizuna" src="https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?auto=format&amp;fit=crop&amp;w=1000&amp;q=80">
                                    <span>Dantza</span>
                                </button>
                                <div class="event-body">
                                    <p class="date">2026/11/15 · 19:00</p>
                                    <h3>Oskara: Sustraien Dantza</h3>
                                    <p class="hall">
                                        <svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                                            <path d="M6 11v7M18 11v7M4 18h16v3H4z"></path>
                                            <path d="M7 14V6a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v8"></path>
                                        </svg>
                                     Areto Nagusia</p>
                                    <div class="event-bottom"><div>
                                        <small>Preziotik</small>
                                        <strong>16,00€</strong>
                                    </div>
                                    <button type="button" class="btn btn-dark ">Sarrerak erosi</button>
                                </div>
                            </div>
                        </article>
                    </div>
                </section>
            </main>
        </div>
    </body>
</html>
