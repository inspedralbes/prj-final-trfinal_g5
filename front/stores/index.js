import { defineStore } from 'pinia';

export const useUsuariPerfilStore = defineStore('usuariPerfil', () => {
    const loguejat = ref(false);
    const tipus_usuari = ref("");
    const nom_usuari = ref("");
    const id_usuari = ref("");
    const email_usuari = ref("");
    const foto_perfil = ref("");
    const registre = ref(false);

    function iniciarSesionExitoso() {
        loguejat.value = true;
    }

    function registratExitosament() {
        registre.value = true;
    }

    function registreIncomplet() {
        registre.value = false;
    }

    return { 
        iniciarSesionExitoso,
        loguejat,
        tipus_usuari,
        nom_usuari,
        email_usuari,
        id_usuari,
        foto_perfil,
        registre,
        registreIncomplet,
        registratExitosament,
    };
});