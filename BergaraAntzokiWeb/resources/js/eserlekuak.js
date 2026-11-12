import '../css/eserlekuak.css';

const orria = document.getElementById('eserlekuak');

// Eserlekuak aukeratzeko orrian bakarrik exekutatzen da.
if (orria) {
    const prezioa = parseFloat(orria.dataset.prezioa);
    const silverPrezioa = parseFloat(orria.dataset.silverPrezioa);
    const silverMota = orria.dataset.silverMota;

    const silverBotoia = document.getElementById('silver-botoia');
    const silverOharra = document.getElementById('silver-oharra');
    const silverKopurua = document.getElementById('silver-kopurua');
    const zerrenda = document.getElementById('aukeratutakoZerrenda');
    const zerrendaHutsik = document.getElementById('zerrenda-hutsik');
    const sarreraKopurua = document.getElementById('sarrera-kopurua');
    const guztira = document.getElementById('guztira');
    const ordainduBotoia = document.getElementById('ordaindu-botoia');
    const ordainduTestua = document.getElementById('ordaindu-testua');

    const eserlekuak = Array.from(orria.querySelectorAll('.seat'));
    // Silver Economy eserleku libreak, eszenatokitik gertuenetik hasita (orrian agertzen diren ordenan).
    const silverLibreak = eserlekuak.filter((eserlekua) => eserlekua.dataset.mota === silverMota && !eserlekua.classList.contains('booked'));

    let silverModua = false;

    // 22.5 -> "22,50€"
    function prezioaIdatzi(zenbakia) {
        return zenbakia.toFixed(2).replace('.', ',') + '€';
    }

    // Aukeratutako eserlekuen laburpena (zerrenda, kopurua eta prezio totala) eguneratu.
    function laburpenaEguneratu() {
        const aukeratuak = eserlekuak.filter((eserlekua) => eserlekua.classList.contains('selected'));
        const unekoPrezioa = silverModua ? silverPrezioa : prezioa;

        zerrenda.querySelectorAll('.zerrenda-lerroa').forEach((lerroa) => lerroa.remove());

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

        zerrendaHutsik.classList.toggle('d-none', aukeratuak.length > 0);
        sarreraKopurua.textContent = aukeratuak.length + ' sarrera';
        guztira.textContent = prezioaIdatzi(aukeratuak.length * unekoPrezioa);
        ordainduBotoia.disabled = aukeratuak.length === 0;
        ordainduTestua.textContent = silverModua ? 'Silver Economy Erreserba' : 'Ordaindu (Online)';
        ordainduBotoia.classList.toggle('btn-violet', silverModua);
        ordainduBotoia.classList.toggle('btn-primary', !silverModua);
    }

    function aukeraGuztiakGarbitu() {
        eserlekuak.forEach((eserlekua) => eserlekua.classList.remove('selected'));
    }

    // Silver Economy-ko lehen n eserleku libreak automatikoki esleitu.
    function silverEserlekuakEsleitu(kopurua) {
        silverLibreak.forEach((eserlekua, indizea) => {
            eserlekua.classList.toggle('selected', indizea < kopurua);
        });
    }

    function silverAktibatu() {
        aukeraGuztiakGarbitu();
        silverModua = true;
        silverBotoia.classList.add('selected-mode');
        silverOharra.classList.remove('d-none');
        silverEserlekuakEsleitu(parseInt(silverKopurua.value, 10));
        laburpenaEguneratu();
    }

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

    silverBotoia.addEventListener('click', () => {
        if (silverModua) {
            silverDesaktibatu();
        } else {
            silverAktibatu();
        }
    });

    silverKopurua.addEventListener('change', () => {
        silverEserlekuakEsleitu(parseInt(silverKopurua.value, 10));
        laburpenaEguneratu();
    });

    // Eserleku arrunta aukeratu / desautatu.
    orria.addEventListener('click', (gertaera) => {
        const eserlekua = gertaera.target.closest('.seat');

        if (!eserlekua || eserlekua.disabled) {
            return;
        }

        // Eserleku arrunta aukeratzean Silver Economy modua utzi.
        if (silverModua) {
            silverDesaktibatu();
        }

        eserlekua.classList.toggle('selected');
        laburpenaEguneratu();
    });
}
