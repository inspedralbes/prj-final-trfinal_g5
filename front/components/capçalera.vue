<template>
    <div class="header-container">
        <div class="imgContainer">
            <div class="user-info">
                <nuxt-link v-if="nom_usuari" :to="`/perfil/${username}`">
                    <div :class="{ 'user-icon-container': true, 'incomplete-profile': !registre }">
                        <img :src="'http://127.0.0.1:8000/storage/imagenes_perfil/' + foto_perfil" alt="Usuari"
                            class="user-icon" />
                    </div>
                </nuxt-link>
                <h1 id="nomUsuri">{{ username }}</h1>
            </div>
            <div v-if="!registre" class="alert-sign">
                !
            </div>
        </div>
    </div>
</template>

<script>
import { useUsuariPerfilStore } from '@/stores/index';

export default {
    data() {
        return {
            usuario: {
                foto_perfil: null
            },
            isSaving: false
        };
    },
    computed: {
        nom_usuari() {
            return useUsuariPerfilStore().nom_usuari;
        },
        foto_perfil() {
            return useUsuariPerfilStore().foto_perfil;
        },
        registre() {
            return useUsuariPerfilStore().registre;
        },
        username() {
            return useUsuariPerfilStore().username;
        }
    },
}
</script>

<style scoped>
.imgContainer {
    display: grid;
    grid-template-columns: .6fr 1fr;
    margin: auto;
}

.user-info {
    position: relative;
    margin-left: 20px;
    display: grid;
    grid-template-columns: 1.5fr .2fr;
}

.user-icon-container {
    margin-top: 20px;
    width: 50px; /* Ajustar el tamaño según sea necesario */
    height: 50px; /* Ajustar el tamaño según sea necesario */
    border-radius: 50%; /* Hacer el contenedor redondo */
    overflow: hidden; /* Ocultar cualquier parte de la imagen que se desborde del contenedor */


}

.incomplete-profile{
    margin-top: 20px;
    width: 50px; /* Ajustar el tamaño según sea necesario */
    height: 50px; /* Ajustar el tamaño según sea necesario */
    border-radius: 50%; /* Hacer el contenedor redondo */
    overflow: hidden; /* Ocultar cualquier parte de la imagen que se desborde del contenedor */
    border: 4px solid #FFA500;
}

.user-icon {
    width: 100%; /* Ajustar la imagen al 100% del ancho del contenedor */
    height: 100%; /* Ajustar la imagen al 100% de la altura del contenedor */
    object-fit: cover; /* Escalar la imagen para que llene el contenedor sin distorsionarse */
}



.alert-sign {
    position: absolute;
    bottom: 10%;
    left: 15%;
    transform: translateX(5%);
    width: 25px;
    height: 25px;
    background-color: #FFA500;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: Arial, sans-serif;
    color: white;
    font-size: 1.2rem;
    font-weight: bolder;
}

h1 {
    padding: 20px;
    font-size: 1.1rem;
}

.header-container {
    background-color: #fafafa;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin: auto;
    margin-top: 0;
    position: relative;
    margin-bottom: 20px;
    width: 100%;
}

.title {
    font-weight: bold;
    font-size: 24px;
}
</style>
