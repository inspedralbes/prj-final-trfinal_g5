<template>
    <div class="header-container">
        <a href="/perfil">
            <img src="../public/usuario.png" alt="Usuario" class="user-icon" />
        </a>
        <h1 class="title">{{ saludo }}</h1>
    </div>
</template>

<script>
export default {
    data() {
        return {
            usuario: '',
            saludo: ''
        };
    },
    mounted() {
        // Recuperar el nombre de usuario del almacenamiento local
        this.usuario = localStorage.getItem('username');

        // Recuperar el número de visitas del usuario del almacenamiento local
        let visitas = localStorage.getItem('visitas');
        if (!visitas) {
            visitas = 1;
        } else {
            visitas = parseInt(visitas) + 1;
        }

        // Mostrar saludo solo en las dos primeras visitas
        if (visitas <= 2) {
            this.saludo = 'Benvingut ' + this.usuario;
        } else {
            this.saludo = this.usuario;
        }

        // Actualizar el número de visitas en el almacenamiento local
        localStorage.setItem('visitas', visitas);
    },
}
</script>

<style scoped>
.header-container {
    background-color: #FFA500;
    display: flex;
    align-items: center;
    padding: 1rem;
    width: 100%;
    padding-left: 12%;            
    padding-top: 25px;
    padding-bottom: 25px;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
}

.user-icon {
    width: 40px;
    height: 40px;
    margin-right: 10px;
}

.title {
    font-weight: bold;
    font-size: 24px;
}
</style>
