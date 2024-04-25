<template>
    <div class="header-container">
        <nuxt-link v-if="nom_usuari" :to="`/perfil/${nom_usuari}`">
            <img v-if="foto_perfil" :src="'http://127.0.0.1:8000/storage/imagenes_perfil/' + foto_perfil" alt="Usuario" class="user-icon" />
        </nuxt-link>
        <div v-if="!registre" :class="{ 'alert-container': true, 'oculto': cerrarAlerta }">
            <div class="alert-message">Perfil incompleto</div>
            <button @click="closeAlert" class="close-button">Cerrar</button>
        </div>
        <h1 v-if="nom_usuari" class="title">{{ nom_usuari }}</h1>
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
            cerrarAlerta: false
        };
    },
    computed: {
        nom_usuari() {
            return useUsuariPerfilStore().nom_usuari;
        },
        foto_perfil(){
            return useUsuariPerfilStore().foto_perfil;
        },
        registre(){
            return useUsuariPerfilStore().registre;
        }
    },
    methods: {
        closeAlert() {
            this.cerrarAlerta = true;
        }
    },
    mounted() {
        // Recuperar el nombre de usuario y la foto de perfil del pinia
        const store = useUsuariPerfilStore();
        
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

.alert-container {
    background-color: #f44336; /* Color rojo para la alerta */
    color: white;
    padding: 10px;
    border-radius: 5px;
    margin-right: 10px;
    display: flex;
    align-items: center;
}

.alert-message {
    font-weight: bold;
    flex-grow: 1;
}

.close-button {
    background-color: transparent;
    border: none;
    color: white;
    cursor: pointer;
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

.oculto {
    display: none;
}
</style>
