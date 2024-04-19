import { defineStore } from 'pinia';

export const useUsuariPerfilStore = defineStore('usuariPerfil', () => {
    const loguejat = ref(false);
    const tipus_usuari = ref("");
    const nom_usuari = ref("");
    const cognoms = ref("");
    const id_usuari = ref("");
    const email_usuari = ref("");
    const foto_perfil = ref("");
    const altura = ref("");
    const pes = ref("");
    const genere = ref("");
    const data_naixement = ref("");
    const lesio = ref("");
    const alergia_intolerancia = ref("");
    const telefon = ref("");
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

    function actualitzarDadesUsuari(dades) {
        nom_usuari.value = dades.nom;
        cognoms.value = dades.cognoms;
        id_usuari.value = dades.id;
        email_usuari.value = dades.email;
        foto_perfil.value = dades.foto_perfil;
        altura.value = dades.altura;
        pes.value = dades.pes;
        genere.value = dades.genere;
        data_naixement.value = dades.data_naixement;
        lesio.value = dades.lesio;
        alergia_intolerancia.value = dades.alergia_intolerancia;
        telefon.value = dades.telefon;
        registre.value = dades.registre;
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
        actualitzarDadesUsuari,
    };
});