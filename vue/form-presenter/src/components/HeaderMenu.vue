<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">MCMS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav">
                <router-link class="nav-item nav-link" active-class="active" to="/tablero">Tablero</router-link>
                <router-link class="nav-item nav-link" active-class="active" to="/contenido">Contenido</router-link>
                <router-link class="nav-item nav-link" active-class="active" to="/documentos">Documentos</router-link>
                <router-link class="nav-item nav-link" active-class="active" to="/plantillas">Plantillas</router-link>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Otros
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Configuración</a>
                        <a class="dropdown-item" href="#">Salir</a>
                    </div>
                </li>
            </div>
        </div>
    </nav>
</template>

<script>

export default {
    
    computed: {
      auth () {
        return this.$store.getters.isAuthenticated
      }
    },
    methods: {
      onLogout() {
        this.$store.dispatch('logout')
      }
    }
}
</script>