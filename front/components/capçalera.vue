<template>
    <div class="header-container">
        <nuxt-link :to="`/perfil/${nom_usuari}`">
            <img v-if="foto_perfil !== ''" :src="foto_perfil" alt="Usuario" class="user-icon" />
            <img v-else src="../public/usuario.png" alt="Usuario" class="user-icon" />
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
            saludo: '',
            foto_perfil: '',
        };
    },
    computed: {
        nom_usuari() {
            return useUsuariPerfilStore().nom_usuari;
        },
    },
    mounted() {
        // Recuperar el nombre de usuario y la foto de perfil del pinia
        const store = useUsuariPerfilStore();
        this.usuari = store.nom_usuari;
        this.foto_perfil = store.foto_perfil; 
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
