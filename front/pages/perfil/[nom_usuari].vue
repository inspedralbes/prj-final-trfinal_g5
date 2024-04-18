<template>

    <body>
        <div>
            <div class="flex-container">
                <capçalera />
                <form @submit.prevent="guardarDatosUsuario">
                    <div class="user-info-container">
                        <div class="input-container">
                            <label>Nom:</label>
                            <input type="text" v-model="usuario.nom">
                        </div>
                        <div class="input-container">
                            <label>Cognoms:</label>
                            <input type="text" v-model="usuario.cognoms">
                        </div>
                        <div class="input-container">
                            <label>Correu electrònic:</label>
                            <input type="email" v-model="usuario.email">
                        </div>
                        <div class="input-container">
                            <label>Telefon:</label>
                            <input type="tel" v-model="usuario.telefon">
                        </div>
                        <div class="input-container">
                            <label>Data naixement:</label>
                            <input type="date" v-model="usuario.data_naixement">
                        </div>
                        <div class="input-container">
                            <label>Altura (cm):</label>
                            <input type="number" v-model="usuario.altura">
                        </div>
                        <div class="input-container">
                            <label>Pes (kg):</label>
                            <input type="number" v-model="usuario.pes">
                        </div>
                        <div class="input-container">
                            <label>Gènere:</label>
                            <select v-model="usuario.genere">
                                <option value="masculino">Masculino</option>
                                <option value="femenino">Femenino</option>
                            </select>
                        </div>
                        <div class="input-container">
                            <label>Aleriga/Intolerancia:</label>
                            <input type="text" v-model="usuario.alergia_intolerancia">
                        </div>
                        <div class="input-container">
                            <label>Lesió:</label>
                            <input type="text" v-model="usuario.lesio">
                        </div>
                        <div class="input-container">
                            <label>Foto de Perfil:</label>
                            <input type="text" v-model="usuario.foto_perfil">
                            <!-- <input type="file" @change="onFileChange"> -->
                        </div>
                        <button type="submit" class="large-button">Guardar</button>
                    </div>
                </form>
            </div>
            <navBar />
        </div>
    </body>
</template>

<script>
import { useUsuariPerfilStore } from '@/stores/index'; // Asegúrate de ajustar la ruta correcta
import { getDatosUsuario, actualizarDatosUsuario } from '@/stores/communicationManager';

export default {
    data() {
        return {
            usuario: {
                nom: '',
                cognoms: '',
                email: '',
                telefon: '',
                data_naixement: '',
                altura: '',
                pes: '',
                genere: '',
                foto_perfil: '',
                alergia_intolerancia: '',
                lesio: '',
                registre: '',
            }
        };
    },
    mounted() {
        this.obtenerDatosUsuario();
    },
    methods: {
        obtenerDatosUsuario() {
            const store = useUsuariPerfilStore();
            const idUsuario = store.id_usuari;

            getDatosUsuario(idUsuario)
                .then(data => {
                    this.usuario = data.usuario;
                    console.log('Datos del usuario obtenidos:', data);
                })
                .catch(error => {
                    console.error('Error al obtener los datos del usuario:', error);
                });
        },
        onFileChange(event) {
            const file = event.target.files[0];
            this.usuario.foto_perfil = file;
        },
        guardarDatosUsuario() {
            const store = useUsuariPerfilStore();
            const idUsuario = store.id_usuari;

            const formData = {
                nom: this.usuario.nom,
                cognoms: this.usuario.cognoms,
                email: this.usuario.email,
                telefon: this.usuario.telefon,
                data_naixement: this.usuario.data_naixement,
                altura: this.usuario.altura,
                pes: this.usuario.pes,
                genere: this.usuario.genere,
                foto_perfil: this.usuario.foto_perfil,
                alergia_intolerancia: this.usuario.alergia_intolerancia,
                lesio: this.usuario.lesio,
                registre: store.registre,
            };
            if (
                this.usuario.nom &&
                this.usuario.cognoms &&
                this.usuario.email &&
                this.usuario.telefon &&
                this.usuario.data_naixement &&
                this.usuario.altura &&
                this.usuario.pes &&
                this.usuario.genere &&
                this.usuario.alergia_intolerancia &&
                this.usuario.lesio
            ) {
                store.registratExitosament();
            }else{
                store.registreIncomplet();
            }


            console.log('Datos a enviar en la solicitud PUT:', formData);

            actualizarDatosUsuario(idUsuario, formData)
                .then(message => {
                    console.log(message);
                    // Redireccionar a la página de detalles de sesión
                    this.$router.push(`/home`);
                })
                .catch(error => {
                    console.error('Error al actualizar los datos del usuario:', error);
                });
        }
    }
};
</script>

<style scoped>
/* Estilos de los divs en el componente */
html,
body {
    margin: 0;
    padding: 0;
    height: 100%;
    overflow-x: hidden;
}

body {
    font-family: Arial, sans-serif;
}

.flex-container {
    display: flex;
    flex-direction: column;
    align-items: stretch;
    min-height: 100vh;
    background-color: #FFF;
}

.user-info-container {
    margin-top: 20px;
    display: flex;
    flex-direction: column;
    padding: 0 20px;
}

.input-container {
    display: flex;
    margin-bottom: 10px;
}

.input-container label {
    flex: 1;
    text-align: right;
    margin-right: 10px;
}

.user-info-container label {
    font-weight: bold;
}

.input-container input,
.input-container select {
    flex: 1;
    padding: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.large-button {
    width: 100%;
    max-width: 400px;
    height: 60px;
    margin-top: 20px;
    font-size: 18px;
    font-weight: bold;
    color: #FFF;
    cursor: pointer;
    border: none;
    outline: none;
    background-color: #000000;
    border-radius: 10px;
}

navBar {
    width: 100%;
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px 0;
    position: fixed;
    bottom: 0;
}
</style>
