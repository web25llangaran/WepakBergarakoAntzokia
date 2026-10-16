// Importa la función defineConfig desde Vite. Esta función ayuda a declarar la configuración del proyecto de forma reconocible para el editor y las herramientas.
import { defineConfig } from 'vite';
// Importa el complemento oficial de Laravel para Vite, que conecta los recursos del proyecto Laravel con el sistema de desarrollo y compilación de Vite.
import laravel from 'laravel-vite-plugin';

// Exporta la configuración principal de Vite. Vite leerá este objeto para saber qué complementos y recursos debe gestionar.
export default defineConfig({
    // Indica la lista de complementos que Vite debe activar en este proyecto.
    plugins: [
        // Configura el complemento de Laravel para Vite; las opciones siguientes describen qué archivos debe procesar y cómo actualizar la página.
        laravel({
            // Enumera los archivos de entrada que Vite debe procesar: las hojas CSS y el JavaScript de la aplicación. Las rutas son relativas a la raíz del proyecto.
            input: ['resources/css/app.css', 'resources/css/hasieraorria.css', 'resources/js/app.js'],
            // Activa la actualización automática del navegador cuando cambian archivos relevantes durante el desarrollo.
            refresh: true,
        // Cierra la llamada o estructura de configuración que se abrió anteriormente; los paréntesis, corchetes y llaves deben quedar equilibrados.
        }),
    // Cierra la llamada o estructura de configuración que se abrió anteriormente; los paréntesis, corchetes y llaves deben quedar equilibrados.
    ],
// Cierra la llamada o estructura de configuración que se abrió anteriormente; los paréntesis, corchetes y llaves deben quedar equilibrados.
});
