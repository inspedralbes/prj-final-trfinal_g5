import { defineStore } from 'pinia';

export const useUsuariPerfilStore = defineStore('usuariPerfil', () => {
    const loguejat = ref(false);
    const tipus_usuari = ref("");
    const nom_usuari = ref("");
    const id_usuari = ref("");
    const email_usuari = ref("");

    function iniciarSesionExitoso() {
        loguejat.value = true;
    }

    return { 
        iniciarSesionExitoso,
        loguejat,
        tipus_usuari,
        nom_usuari,
        email_usuari,
        id_usuari
    };
});