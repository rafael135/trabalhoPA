import './bootstrap';

import Alpine from 'alpinejs';

// Importo todos os arquivos da pasta para o vite
import.meta.glob([
    '../images/**'
]);

window.Alpine = Alpine;

Alpine.start();
