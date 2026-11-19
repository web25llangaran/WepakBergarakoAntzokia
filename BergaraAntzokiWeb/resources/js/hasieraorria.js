// Hasierako orriko filtroak (izena, mota eta data)

// Cogemos los elementos del filtro: buscador de texto, desplegable de tipo, selector de fecha, botón y mensaje de "no hay resultados".
const bilatu = document.getElementById('filtro-bilatu');
const mota = document.getElementById('filtro-mota');
const data = document.getElementById('filtro-data');
const botoia = document.getElementById('filtratu-botoia');
const emaitzarikEz = document.getElementById('emaitzarik-ez');

// Txartel guztiak array batean sartu, .filter() erabili ahal izateko
const txartelak = Array.from(document.querySelectorAll('.event-card'));

// FILTRO: función que se ejecuta cada vez que cambia algo. Compara cada tarjeta con el nombre, tipo y fecha elegidos y deja visibles solo las que cumplen los 3.
function filtratu() {
    // .trim()-ek hasieran eta amaieran dauden hutsuneak kentzen ditu.
    // Adibidez "  irati " idazten bada, "irati" geratzen da, eta horrela
    // hutsune bat sobran jartzeagatik ez da bilaketa hutsik geratzen.
    const testua = bilatu.value.toLowerCase().trim();

    const ikusgai = txartelak.filter((txartela) => {
        // izenaBai: txartelaren izenak idatzitako testua daukan begiratzen du.
        // Bilatzailea hutsik badago, includes('') beti da true, beraz denak agertzen dira.
        const izenaBai = txartela.dataset.izena.includes(testua);

        // motaBai: "Guztiak" aukeratuta badago (value = '') true da zuzenean. Bestela, txartelaren mota aukeratutakoaren berdina den begiratzen du.
        const motaBai = mota.value === '' || txartela.dataset.mota === mota.value;

        // dataBai: data hutsik badago true da. Bestela, txartelaren data (urtea-hila-eguna) aukeratutako egunaren berdina izan behar da.
        const dataBai = data.value === '' || txartela.dataset.data === data.value;

        // Hiru baldintzak betetzen badira bakarrik geratzen da txartela
        return izenaBai && motaBai && dataBai;
    });

    // Denak ezkutatu eta gero filtroa pasatu dutenak erakutsi
    txartelak.forEach((txartela) => {
        txartela.hidden = true;
    });
    ikusgai.forEach((txartela) => {
        txartela.hidden = false;
    });

    // Si no queda ninguna tarjeta visible, se muestra el mensaje "no hay resultados".
    emaitzarikEz.hidden = ikusgai.length > 0;
}

// Al pulsar el botón "Filtrar" también se filtra.
botoia.addEventListener('click', filtratu);

// Idazten edo aukeratzen den bakoitzean ere filtratu
bilatu.addEventListener('input', filtratu);
mota.addEventListener('change', filtratu);
data.addEventListener('change', filtratu);
