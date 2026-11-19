// Script de la página de elegir butacas. Importa el CSS de esa página.
import '../css/eserlekuak.css';

// Contenedor principal del plano de butacas (si no existe, no estamos en esta página y no se hace nada).
const orria = document.getElementById('eserlekuak');

// Eserlekuak aukeratzeko orrian bakarrik exekutatzen da.
if (orria) {
    // Leemos los datos que manda el servidor en atributos data-*: precio normal, precio Silver y el nombre del tipo Silver.
    const prezioa = parseFloat(orria.dataset.prezioa);
    const silverPrezioa = parseFloat(orria.dataset.silverPrezioa);
    const silverMota = orria.dataset.silverMota;

    // Cogemos todos los elementos de la página que vamos a usar: botón Silver, aviso, desplegable, lista del resumen, total, botón de pagar...
    const silverBotoia = document.getElementById('silver-botoia');
    const silverOharra = document.getElementById('silver-oharra');
    const silverKopurua = document.getElementById('silver-kopurua');
    const zerrenda = document.getElementById('aukeratutakoZerrenda');
    const zerrendaHutsik = document.getElementById('zerrenda-hutsik');
    const aukeratutakoEserlekuak = document.getElementById('aukeratutako-eserlekuak');
    const sarreraKopurua = document.getElementById('sarrera-kopurua');
    const guztira = document.getElementById('guztira');
    const ordainduBotoia = document.getElementById('ordaindu-botoia');
    const ordainduTestua = document.getElementById('ordaindu-testua');

    // Array con todas las butacas del plano.
    const eserlekuak = Array.from(orria.querySelectorAll('.seat'));
    // Silver Economy eserleku libreak, eszenatokitik gertuenetik hasita (orrian agertzen diren ordenan).
    const silverLibreak = eserlekuak.filter((eserlekua) => eserlekua.dataset.mota === silverMota && !eserlekua.classList.contains('booked'));

    // Variable que guarda si el modo Silver Economy está activado o no.
    let silverModua = false;

    // 22.5 -> "22,50€"
    function prezioaIdatzi(zenbakia) {
        return zenbakia.toFixed(2).replace('.', ',') + '€';
    }

    // Aukeratutako eserlekuen laburpena (zerrenda, kopurua eta prezio totala) eguneratu.
    function laburpenaEguneratu() {
        // Cogemos las butacas seleccionadas y el precio que toca (normal o Silver).
        const aukeratuak = eserlekuak.filter((eserlekua) => eserlekua.classList.contains('selected'));
        const unekoPrezioa = silverModua ? silverPrezioa : prezioa;

        // Guardamos los IDs de las butacas elegidas en un input oculto ("1,2,3") para mandarlos al servidor al pagar.
        aukeratutakoEserlekuak.value = aukeratuak.map((eserlekua) => eserlekua.dataset.id).join(',');
        zerrenda.querySelectorAll('.zerrenda-lerroa').forEach((lerroa) => lerroa.remove());

        // Por cada butaca elegida, añadimos una línea en el resumen: "fila · butaca" y su precio.
        aukeratuak.forEach((eserlekua) => {
            const lerroa = document.createElement('div');
            lerroa.className = 'zerrenda-lerroa';

            const izena = document.createElement('span');
            izena.textContent = eserlekua.dataset.lerroa + '. ilara · ' + eserlekua.dataset.zenbakia + '. eserlekua';

            const lerroPrezioa = document.createElement('b');
            lerroPrezioa.textContent = prezioaIdatzi(unekoPrezioa);

            lerroa.append(izena, lerroPrezioa);
            zerrenda.appendChild(lerroa);
        });

        // Actualizamos el resto del resumen: mensaje de lista vacía, nº de entradas, total, y activamos/desactivamos eyl botón de pagar (cambia texto  color en modo Silver).
        // Mensaje "no has elegido ninguna butaca": se oculta (clase d-none de Bootstrap) si hay alguna butaca elegida, y se muestra si no hay ninguna.
        zerrendaHutsik.classList.toggle('d-none', aukeratuak.length > 0);
        // Escribe cuántas entradas hay elegidas, por ejemplo "3 sarrera".
        sarreraKopurua.textContent = aukeratuak.length + ' sarrera';
        // Precio total = nº de butacas x precio de cada una, con formato europeo (ej. "22,50€").
        guztira.textContent = prezioaIdatzi(aukeratuak.length * unekoPrezioa);
        // El botón de pagar solo se puede pulsar si hay al menos una butaca elegida.
        ordainduBotoia.disabled = aukeratuak.length === 0;
        // Texto del botón: en modo Silver "Silver Economy Erreserba" (se paga en taquilla); si no, "Ordaindu (Online)".
        ordainduTestua.textContent = silverModua ? 'Silver Economy Erreserba' : 'Ordaindu (Online)';
        // En modo Silver el botón se pone morado (btn-violet)...
        ordainduBotoia.classList.toggle('btn-violet', silverModua);
        // ...y en modo normal lleva el color principal (btn-primary). Nunca tiene las dos clases a la vez.
        ordainduBotoia.classList.toggle('btn-primary', !silverModua);
    }

    // Quita la selección de todas las butacas.
    function aukeraGuztiakGarbitu() {
        eserlekuak.forEach((eserlekua) => eserlekua.classList.remove('selected'));
    }

    // Silver Economy-ko lehen n eserleku libreak automatikoki esleitu.
    function silverEserlekuakEsleitu(kopurua) {
        silverLibreak.forEach((eserlekua, indizea) => {
            eserlekua.classList.toggle('selected', indizea < kopurua);
        });
    }

    // Activa el modo Silver: limpia la selección, marca el botón, muestra el aviso y elige automáticamente las butacas Silver.
    function silverAktibatu() {
        aukeraGuztiakGarbitu();
        silverModua = true;
        silverBotoia.classList.add('selected-mode');
        silverOharra.classList.remove('d-none');
        silverEserlekuakEsleitu(parseInt(silverKopurua.value, 10));
        laburpenaEguneratu();
    }

    // Desactiva el modo Silver y vuelve a dejar todo como al principio.
    function silverDesaktibatu() {
        silverModua = false;
        silverBotoia.classList.remove('selected-mode');
        silverOharra.classList.add('d-none');
        aukeraGuztiakGarbitu();
        laburpenaEguneratu();
    }

    // Desplegablean aukera bakoitza: 1etik aretoko lehen lerroan libre dauden Silver eserlekuen kopurura (aretoaren arabera aldatzen da).
    for (let kopurua = 1; kopurua <= silverLibreak.length; kopurua++) {
        silverKopurua.add(new Option(kopurua, kopurua));
    }

    // Silver eserleku libreik ez badago, botoia desgaitu.
    if (silverLibreak.length === 0) {
        silverBotoia.disabled = true;
    }

    // Al pulsar el botón Silver: si está activado lo desactiva y si no, lo activa.
    silverBotoia.addEventListener('click', () => {
        if (silverModua) {
            silverDesaktibatu();
        } else {
            silverAktibatu();
        }
    });

    // Al cambiar el número en el desplegable Silver, se vuelven a elegir las butacas y se actualiza el resumen.
    silverKopurua.addEventListener('change', () => {
        silverEserlekuakEsleitu(parseInt(silverKopurua.value, 10));
        laburpenaEguneratu();
    });

    // Eserleku arrunta aukeratu / desautatu.
    orria.addEventListener('click', (gertaera) => {
        const eserlekua = gertaera.target.closest('.seat');

        // Si no se ha pulsado una butaca, o está ocupada (disabled), no hacemos nada.
        if (!eserlekua || eserlekua.disabled) {
            return;
        }

        // Eserleku arrunta aukeratzean Silver Economy modua utzi.
        if (silverModua) {
            silverDesaktibatu();
        }

        // Marcamos/desmarcamos la butaca pulsada y actualizamos el resumen.
        eserlekua.classList.toggle('selected');
        laburpenaEguneratu();
    });
}
