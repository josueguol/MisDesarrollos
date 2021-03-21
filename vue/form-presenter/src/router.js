import Inicio from './components/inicio/Inicio.vue';
import Tablero from './components/tablero/Tablero.vue';
import Contenido from './components/contenido/Contenido.vue';
import Documentos from './components/documentos/Documentos.vue';
import Plantillas from './components/plantillas/Plantillas.vue';

export const routes = [
    { path:'/', component: Inicio },
    { path:'/tablero', component: Tablero },
    { path:'/contenido', component: Contenido },
    { path:'/documentos', component: Documentos },
    { path:'/plantillas', component: Plantillas },
]