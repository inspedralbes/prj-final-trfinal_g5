<template>
    <div class="header-container">
        <nuxt-link :to="`/perfil/${nom_usuari}`">
            <img src="../public/usuario.png" alt="Usuario" class="user-icon" />
        </nuxt-link>
        <h1 class="title">{{ usuari }}</h1>
    </div>
</template>

<script>
import { useUsuariPerfilStore } from '@/stores/index'

export default {
    data() {
        return {
            usuari: '',
            saludo: ''
        };
    },
    computed: {
        nom_usuari() {
            return useUsuariPerfilStore().nom_usuari;
        },
    },
    mounted() {
        // Recuperar el nombre de usuario del pinia
        const store = useUsuariPerfilStore();
        this.usuari = store.nom_usuari;
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
