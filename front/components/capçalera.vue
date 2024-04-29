<template>
    <div class="header-container">
        <nuxt-link v-if="nom_usuari" :to="`/perfil/${nom_usuari}`">

        <div class="imgContainer">
            <img :src="'fithub.daw.inspedralbes.cat/storage/imagenes_perfil/' + foto_perfil" alt="Usuario" class="user-icon" :class="{ 'incomplete-profile': !registre }" /> 
            <h1>{{nom_usuari}}</h1>
           
            <div v-if="!registre" class="alert-sign">
                !
            </div>
        </div>
    </nuxt-link>

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
        foto_perfil() {
            return useUsuariPerfilStore().foto_perfil;
        },
        registre() {
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

nuxt-link{
    text-decoration: none;
    color: black;
}
.imgContainer {
    display: grid;
    grid-template-columns: .6fr 1fr;
    margin: auto;
    padding: 5px;
    
}

.imgContainer img {
    width: 45%;
    border-radius: 50%;
    margin-right: 75px;
}

.user-icon {
    width: 55%;
    border-radius: 50%;
    text-align: center;
    margin: auto;
}

.incomplete-profile {
    border: 4px solid #f44336;
}

.alert-sign {
    position: absolute;
    bottom: 3%;
    left: 13%;
    transform: translateX(5%);
    width: 30px;
    height: 30px;
    background-color: #f44336;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: Arial, sans-serif;
    color: #fbff00;
    font-size: 1.2rem;
    font-weight: bolder;
}

h1 {
    padding: 20px;
    font-size: 1.1rem;
    font-weight: bolder;
}

.header-container {
    background-color: #FFA500;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 70px;
    width: 95%;
    margin: auto;
    margin-top: 20px;
    position: relative;
    margin-bottom: 20px;

}

.close-button {
    background-color: transparent;
    border: none;
    color: white;
    cursor: pointer;
}

.title {
    font-weight: bold;
    font-size: 24px;
}

.oculto {
    display: none;
}
</style>