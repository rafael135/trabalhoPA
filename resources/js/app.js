import './bootstrap';

import Alpine from 'alpinejs';

// Importo todos os arquivos da pasta para o vite
import.meta.glob([
    '../img/**'
]);

window.Alpine = Alpine;

Alpine.start();
