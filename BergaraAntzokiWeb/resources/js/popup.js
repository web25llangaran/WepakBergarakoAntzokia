import '../css/popup.css';
import { Modal } from 'bootstrap';

const popup = document.getElementById('popup-saioa');

// Saioa hasita dagoenean popup-a ez dago orrian.
if (popup) {
    const titulua = document.getElementById('popup-titulua');

    // Fitxaz aldatzean izenburua ere aldatu.
    popup.addEventListener('shown.bs.tab', (event) => {
        titulua.textContent = event.target.dataset.titulua;
    });

    // Formularioak errorea badu, popup-a berriro ireki orria kargatzean.
    if (popup.hasAttribute('data-berriro-ireki')) {
        Modal.getOrCreateInstance(popup).show();
    }
}
