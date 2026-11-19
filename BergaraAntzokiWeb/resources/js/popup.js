// Script del popup de inicio de sesión / registro. Importa su CSS y el componente Modal de Bootstrap.
import '../css/popup.css';
import { Modal } from 'bootstrap';

// Buscamos el popup en la página (solo existe si el usuario NO ha iniciado sesión).
const popup = document.getElementById('popup-saioa');

// Saioa hasita dagoenean popup-a ez dago orrian.
if (popup) {
    // Elemento del título del popup, que cambia según la pestaña (login o registro).
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
