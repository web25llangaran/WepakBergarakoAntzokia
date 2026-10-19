<!-- La directiva @vite de Laravel carga los recursos CSS y JavaScript indicados y permite que Vite los procese durante el desarrollo y la compilación. -->
<!-- @vite(['resources/css/app.css', 'resources/css/hasieraorria.css', 'resources/js/app.js']) -->

<!-- Explicación: Indica que esta vista Blade utiliza 'plantilla' como plantilla base, heredando su estructura compartida. -->
@extends('plantilla.arrunta.blade.php')
<!-- Explicación: Abre la sección Blade llamada content1; su contenido se insertará en el lugar correspondiente de la plantilla base. -->
@section('content1')

    <!-- Explicación: Crea un contenedor general del contenido; page-content permite aplicarle estilos desde CSS. -->
    <div class="page-content">
        <!-- Explicación: Marca el contenido principal de la página, aportando una estructura semántica clara. -->
        <main>
            <!-- Explicación: Abre la sección del catálogo de eventos. La clase permite darle estilo con CSS y el id ekitaldiak permite identificarla mediante enlaces o código. -->
            <section class="catalog-section" id="ekitaldiak">
                <!-- Explicación: Agrupa el encabezado de la sección, con el rótulo, el título y el texto descriptivo. -->
                <div class="section-heading">
                    <!-- Explicación: Esta línea forma parte de la estructura de la vista Blade/HTML y define contenido, organización o atributos de un elemento. -->
                    <div>
                        <!-- Explicación: Muestra un rótulo breve que aparece encima del título principal. -->
                        <span class="eyebrow">Programazioa</span>
                        <!-- Explicación: Define el título de nivel 2 de esta sección: el encabezado de los próximos eventos. -->
                        <h2>Datozen ekitaldiak</h2>
                    <!-- Explicación: Cierra el elemento HTML abierto anteriormente; debe corresponder al elemento adecuado. -->
                    </div>
                    <!-- Explicación: Muestra un párrafo de texto. -->
                    <p>Aurkitu zure hurrengo kultura-plana Bergaran.</p>
                <!-- Explicación: Cierra el elemento HTML abierto anteriormente; debe corresponder al elemento adecuado. -->
                </div>
                <!-- Explicación: Agrupa los controles visuales de búsqueda y filtrado de los eventos. -->
                <div class="filter-bar">
                    <!-- Explicación: Agrupa el icono de búsqueda y el campo de texto. -->
                    <label class="search-field">
                        <!-- Explicación: Inicia un icono vectorial SVG. aria-hidden="true" lo marca como decorativo para tecnologías de asistencia; viewBox define sus coordenadas y width/height su tamaño. -->
                        <svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                            <!-- Explicación: Dibuja un círculo dentro del icono SVG. -->
                            <circle cx="11" cy="11" r="7"></circle>
                            <!-- Explicación: Muestra un párrafo de texto. -->
                            <path d="m20 20-4-4"></path>
                        <!-- Explicación: Cierra el icono SVG. -->
                        </svg>
                        <!-- Explicación: Crea el campo donde se puede escribir una búsqueda. placeholder muestra una pista y value="" lo deja inicialmente vacío. -->
                        <input placeholder="Bilatu..." value=""></label>
                        <!-- Explicación: Agrupa el selector de categoría para aplicarle estilos. -->
                        <label class="field">
                            <!-- Explicación: Crea una lista desplegable para elegir la categoría de un evento. -->
                            <select>
                                <!-- Explicación: Define una de las opciones que aparecen en la lista desplegable. -->
                                <option>Guztiak</option>
                                <!-- Explicación: Define una de las opciones que aparecen en la lista desplegable. -->
                                <option>Antzerkia</option>
                                <!-- Explicación: Define una de las opciones que aparecen en la lista desplegable. -->
                                <option>Musika</option>
                                <!-- Explicación: Define una de las opciones que aparecen en la lista desplegable. -->
                                <option>Dantza</option>
                            <!-- Explicación: Cierra el elemento HTML abierto anteriormente; debe corresponder al elemento adecuado. -->
                            </select>
                        <!-- Explicación: Cierra el elemento HTML abierto anteriormente; debe corresponder al elemento adecuado. -->
                        </label>
                        <!-- Explicación: Agrupa el icono del calendario y el campo para seleccionar una fecha. -->
                        <label class="date-field">
                            <!-- Explicación: Inicia un icono vectorial SVG. aria-hidden="true" lo marca como decorativo para tecnologías de asistencia; viewBox define sus coordenadas y width/height su tamaño. -->
                            <svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                                <!-- Explicación: Dibuja un rectángulo dentro del icono SVG. -->
                                <rect x="3" y="5" width="18" height="16" rx="2"></rect>
                                <!-- Explicación: Muestra un párrafo de texto. -->
                                <path d="M16 3v4M8 3v4M3 10h18"></path>
                            <!-- Explicación: Cierra el icono SVG. -->
                            </svg>
                            <!-- Explicación: Crea un control para elegir una fecha. aria-label proporciona una descripción accesible. -->
                            <input aria-label="Data filtratu" type="date"></label>
                            <!-- Explicación: Crea el botón de filtrado. type="button" hace que no actúe como botón de envío de formulario. -->
                            <button type="button" class="btn btn-primary ">Filtratu</button>
                        <!-- Explicación: Cierra el elemento HTML abierto anteriormente; debe corresponder al elemento adecuado. -->
                        </div>
                        <!-- Explicación: Crea el contenedor en cuadrícula que organiza las tarjetas de eventos. -->
                        <div class="event-grid">
                            <!-- Explicación: Abre una tarjeta de evento independiente; article representa una unidad de contenido que tiene sentido por sí sola. -->
                            <article class="event-card">
                                <!-- Explicación: Crea un botón que contiene la imagen y las etiquetas del evento. aria-label describe su finalidad a lectores de pantalla. -->
                                <button class="event-image" aria-label="Erresuma: Shakespeareren Tragediak ekitaldiaren xehetasunak ikusi">
                                    <!-- Explicación: Inserta la imagen del evento. alt ofrece una descripción textual y src indica la dirección desde la que se carga la imagen. -->
                                    <img alt="Erresuma: Shakespeareren Tragediak ikuskizuna" src="https://images.unsplash.com/photo-1503095396549-807759245b35?auto=format&amp;fit=crop&amp;w=1600&amp;q=88">
                                    <!-- Explicación: Muestra una etiqueta de categoría encima de la imagen. -->
                                    <span>Antzerkia</span>
                                    <!-- Explicación: Muestra en negrita la etiqueta que marca el evento como recomendado. -->
                                    <b>Gomendatua</b>
                                <!-- Explicación: Cierra el elemento HTML abierto anteriormente; debe corresponder al elemento adecuado. -->
                                </button>
                                <!-- Explicación: Agrupa los detalles textuales del evento: fecha, título, sala, precio y botón. -->
                                <div class="event-body">
                                    <!-- Explicación: Muestra la fecha y la hora previstas para este evento. -->
                                    <p class="date">2026/10/24 · 20:00</p>
                                    <!-- Explicación: Define el nombre del evento dentro de su tarjeta. -->
                                    <h3>Erresuma: Shakespeareren Tragediak</h3>
                                    <!-- Explicación: Muestra el lugar donde se celebra el evento e incluye un icono SVG decorativo. -->
                                    <p class="hall">
                                        <!-- Explicación: Inicia un icono vectorial SVG. aria-hidden="true" lo marca como decorativo para tecnologías de asistencia; viewBox define sus coordenadas y width/height su tamaño. -->
                                        <svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                                            <!-- Explicación: Muestra un párrafo de texto. -->
                                            <path d="M6 11v7M18 11v7M4 18h16v3H4z"></path>
                                            <!-- Explicación: Muestra un párrafo de texto. -->
                                            <path d="M7 14V6a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v8"></path>
                                        <!-- Explicación: Cierra el icono SVG. -->
                                        </svg>
                                     <!-- Explicación: Esta línea forma parte de la estructura de la vista Blade/HTML y define contenido, organización o atributos de un elemento. -->
                                     Areto Nagusia</p>
                                     <!-- Explicación: Agrupa la parte inferior de la tarjeta, donde se muestran el precio y el botón de compra. -->
                                     <div class="event-bottom">
                                        <!-- Explicación: Esta línea forma parte de la estructura de la vista Blade/HTML y define contenido, organización o atributos de un elemento. -->
                                        <div>
                                            <!-- Explicación: Muestra un texto secundario de menor tamaño; aquí indica que el precio mostrado es el precio inicial. -->
                                            <small>Preziotik</small>
                                            <!-- Explicación: Resalta el precio para darle mayor importancia visual y semántica. -->
                                            <strong>22,00€</strong>
                                        <!-- Explicación: Cierra el elemento HTML abierto anteriormente; debe corresponder al elemento adecuado. -->
                                        </div>
                                        <!-- Explicación: Crea el botón visual para comprar entradas; aquí no se define por sí solo el proceso de compra. -->
                                        <button type="button" class="btn btn-dark ">Sarrerak erosi</button>
                                    <!-- Explicación: Cierra el elemento HTML abierto anteriormente; debe corresponder al elemento adecuado. -->
                                    </div>
                                <!-- Explicación: Cierra el elemento HTML abierto anteriormente; debe corresponder al elemento adecuado. -->
                                </div>
                            <!-- Explicación: Cierra el elemento HTML abierto anteriormente; debe corresponder al elemento adecuado. -->
                            </article>
                            <!-- Explicación: Abre una tarjeta de evento independiente; article representa una unidad de contenido que tiene sentido por sí sola. -->
                            <article class="event-card">
                                <!-- Explicación: Crea un botón que contiene la imagen y las etiquetas del evento. aria-label describe su finalidad a lectores de pantalla. -->
                                <button class="event-image" aria-label="Izaro: Cerodenero ekitaldiaren xehetasunak ikusi">
                                    <!-- Explicación: Inserta la imagen del evento. alt ofrece una descripción textual y src indica la dirección desde la que se carga la imagen. -->
                                    <img alt="Izaro: Cerodenero ikuskizuna" src="https://images.unsplash.com/photo-1501386761578-eac5c94b800a?auto=format&amp;fit=crop&amp;w=1000&amp;q=80">
                                    <!-- Explicación: Muestra una etiqueta de categoría encima de la imagen. -->
                                    <span>Musika</span>
                                <!-- Explicación: Cierra el elemento HTML abierto anteriormente; debe corresponder al elemento adecuado. -->
                                </button>
                                <!-- Explicación: Agrupa los detalles textuales del evento: fecha, título, sala, precio y botón. -->
                                <div class="event-body">
                                    <!-- Explicación: Muestra la fecha y la hora previstas para este evento. -->
                                    <p class="date">2026/11/07 · 21:00</p>
                                    <!-- Explicación: Define el nombre del evento dentro de su tarjeta. -->
                                    <h3>Izaro: Cerodenero</h3>
                                    <!-- Explicación: Muestra el lugar donde se celebra el evento e incluye un icono SVG decorativo. -->
                                    <p class="hall">
                                        <!-- Explicación: Inicia un icono vectorial SVG. aria-hidden="true" lo marca como decorativo para tecnologías de asistencia; viewBox define sus coordenadas y width/height su tamaño. -->
                                        <svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                                            <!-- Explicación: Muestra un párrafo de texto. -->
                                            <path d="M6 11v7M18 11v7M4 18h16v3H4z"></path>
                                            <!-- Explicación: Muestra un párrafo de texto. -->
                                            <path d="M7 14V6a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v8"></path>
                                        <!-- Explicación: Cierra el icono SVG. -->
                                        </svg>
                                     <!-- Explicación: Esta línea forma parte de la estructura de la vista Blade/HTML y define contenido, organización o atributos de un elemento. -->
                                     Areto Nagusia</p>
                                    <!-- Explicación: Agrupa la parte inferior de la tarjeta, donde se muestran el precio y el botón de compra. -->
                                    <div class="event-bottom"><div>
                                        <!-- Explicación: Muestra un texto secundario de menor tamaño; aquí indica que el precio mostrado es el precio inicial. -->
                                        <small>Preziotik</small>
                                        <!-- Explicación: Resalta el precio para darle mayor importancia visual y semántica. -->
                                        <strong>18,00€</strong>
                                    <!-- Explicación: Cierra el elemento HTML abierto anteriormente; debe corresponder al elemento adecuado. -->
                                    </div>
                                    <!-- Explicación: Crea el botón visual para comprar entradas; aquí no se define por sí solo el proceso de compra. -->
                                    <button type="button" class="btn btn-dark ">Sarrerak erosi</button>
                                <!-- Explicación: Cierra el elemento HTML abierto anteriormente; debe corresponder al elemento adecuado. -->
                                </div>
                            <!-- Explicación: Cierra el elemento HTML abierto anteriormente; debe corresponder al elemento adecuado. -->
                            </div>
                        <!-- Explicación: Cierra el elemento HTML abierto anteriormente; debe corresponder al elemento adecuado. -->
                        </article>
                        <!-- Explicación: Abre una tarjeta de evento independiente; article representa una unidad de contenido que tiene sentido por sí sola. -->
                        <article class="event-card">
                            <!-- Explicación: Crea un botón que contiene la imagen y las etiquetas del evento. aria-label describe su finalidad a lectores de pantalla. -->
                            <button class="event-image" aria-label="Oskara: Sustraien Dantza ekitaldiaren xehetasunak ikusi">
                                <!-- Explicación: Inserta la imagen del evento. alt ofrece una descripción textual y src indica la dirección desde la que se carga la imagen. -->
                                <img alt="Oskara: Sustraien Dantza ikuskizuna" src="https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?auto=format&amp;fit=crop&amp;w=1000&amp;q=80">
                                <!-- Explicación: Muestra una etiqueta de categoría encima de la imagen. -->
                                <span>Dantza</span>
                            <!-- Explicación: Cierra el elemento HTML abierto anteriormente; debe corresponder al elemento adecuado. -->
                            </button>
                            <!-- Explicación: Agrupa los detalles textuales del evento: fecha, título, sala, precio y botón. -->
                            <div class="event-body">
                                <!-- Explicación: Muestra la fecha y la hora previstas para este evento. -->
                                <p class="date">2026/11/15 · 19:00</p>
                                <!-- Explicación: Define el nombre del evento dentro de su tarjeta. -->
                                <h3>Oskara: Sustraien Dantza</h3>
                                <!-- Explicación: Muestra el lugar donde se celebra el evento e incluye un icono SVG decorativo. -->
                                <p class="hall">
                                    <!-- Explicación: Inicia un icono vectorial SVG. aria-hidden="true" lo marca como decorativo para tecnologías de asistencia; viewBox define sus coordenadas y width/height su tamaño. -->
                                    <svg aria-hidden="true" class="icon" width="20" height="20" viewBox="0 0 24 24">
                                        <!-- Explicación: Muestra un párrafo de texto. -->
                                        <path d="M6 11v7M18 11v7M4 18h16v3H4z"></path>
                                        <!-- Explicación: Muestra un párrafo de texto. -->
                                        <path d="M7 14V6a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v8"></path>
                                    <!-- Explicación: Cierra el icono SVG. -->
                                    </svg>
                                 <!-- Explicación: Esta línea forma parte de la estructura de la vista Blade/HTML y define contenido, organización o atributos de un elemento. -->
                                 Areto Nagusia</p>
                                <!-- Explicación: Agrupa la parte inferior de la tarjeta, donde se muestran el precio y el botón de compra. -->
                                <div class="event-bottom"><div>
                                    <!-- Explicación: Muestra un texto secundario de menor tamaño; aquí indica que el precio mostrado es el precio inicial. -->
                                    <small>Preziotik</small>
                                    <!-- Explicación: Resalta el precio para darle mayor importancia visual y semántica. -->
                                    <strong>16,00€</strong>
                                <!-- Explicación: Cierra el elemento HTML abierto anteriormente; debe corresponder al elemento adecuado. -->
                                </div>
                                <!-- Explicación: Crea el botón visual para comprar entradas; aquí no se define por sí solo el proceso de compra. -->
                                <button type="button" class="btn btn-dark ">Sarrerak erosi</button>
                            <!-- Explicación: Cierra el elemento HTML abierto anteriormente; debe corresponder al elemento adecuado. -->
                            </div>
                        <!-- Explicación: Cierra el elemento HTML abierto anteriormente; debe corresponder al elemento adecuado. -->
                        </div>
                    <!-- Explicación: Cierra el elemento HTML abierto anteriormente; debe corresponder al elemento adecuado. -->
                    </article>
                <!-- Explicación: Cierra el elemento HTML abierto anteriormente; debe corresponder al elemento adecuado. -->
                </div>
            <!-- Explicación: Cierra el elemento HTML abierto anteriormente; debe corresponder al elemento adecuado. -->
            </section>
        <!-- Explicación: Cierra el elemento HTML abierto anteriormente; debe corresponder al elemento adecuado. -->
        </main>
    <!-- Explicación: Cierra el elemento HTML abierto anteriormente; debe corresponder al elemento adecuado. -->
    </div>

<!-- Explicación: Cierra la sección content1. Todo lo comprendido entre @section y @endsection pertenece a esa sección Blade. -->
@endsection
