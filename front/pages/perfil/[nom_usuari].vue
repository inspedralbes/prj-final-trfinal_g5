<template>

    <body>
        <div id="main">
            <div class="flex-container">
                <HeaderPerfil />
                
                <form @submit.prevent="guardarDatosUsuario">
                    <div class="user-info-container">
                        <div class="input-container">
                            <label>Nom:</label><br>
                            <input type="text" v-model="usuario.nom">
                        </div>
                        <div class="input-container">
                            <label>Cognoms:</label><br>
                            <input type="text" v-model="usuario.cognoms">
                        </div>
                        <div class="input-container">
                            <label>Correu electrònic:</label><br>
                            <input type="email" v-model="usuario.email">
                        </div>
                        <div class="input-container">
                            <label>Telefon:</label><br>
                            <input type="tel" v-model="usuario.telefon">
                        </div>
                        
                        <div class="input-container">
                            <label>Data naixement:</label><br>
                            <input type="date" v-model="usuario.data_naixement">
                        </div>

                        <div class="input-container">
                            <label>Gènere:</label><br>
                            <select v-model="usuario.genere">
                                <option value="Home">Home</option>
                                <option value="Dona">Dona</option>
                                <option value="Altres">Altres</option>
                            </select>
                        </div>
                        
                        <div class="input-container">
                            <label>Altura (cm):</label><br>
                            <input type="number" v-model="usuario.altura">
                        </div>
                        <div class="input-container">
                            <label>Pes (kg):</label><br>
                            <input type="decimal" v-model="usuario.pes">
                        </div>
                        
                        <div class="input-container">
                            <label>Aleriga/Intolerancia:</label><br>
                            <input type="text" v-model="usuario.alergia_intolerancia">
                        </div>
                        <div class="input-container">
                            <label>Lesió:</label><br>
                            <input type="text" v-model="usuario.lesio">
                        </div>
                        <div class="input-container">
                            <label>Foto de Perfil:</label><br>
                            <input type="text" v-model="usuario.foto_perfil">
                            <!-- <input type="file" @change="onFileChange"> -->
                        </div>
                    </div>

                    <button type="submit" class="large-button">Guardar</button>

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
                this.usuario.foto_perfil &&
                this.usuario.lesio
            ) {
                store.registratExitosament();
            }else{
                store.registreIncomplet();
            }

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


            console.log('Datos a enviar en la solicitud PUT:', formData);

            actualizarDatosUsuario(idUsuario, formData)
                .then(message => {
                    console.log("respnse", message);

                    store.actualitzarDadesUsuari(message);
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

#main {
    position: relative;
}

.flex-container {
    display: flex;
    flex-direction: column;
    align-items: stretch;
    min-height: 100vh;
    background: linear-gradient(to top right, #FFA500, #f44336);
}


.user-info-container {
    margin-top: 5px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 20px;
     
}

input {
    background-color: transparent;
    padding: 2rem;
    margin-bottom: 2.5rem;
    width: 160px;
    
}


.user-info-container label {
    font-weight: bold;
}

.input-container input,
.input-container select {
    flex: 1;
    padding: 5px;
    border-radius: 5px;
    border: none;   
    border-bottom: 2px solid #ccc;
    
}

.large-button {
    width: 40%;
    height: 50px;
    margin-top: 20px;
    font-size: 18px;
    font-weight: bold;
    color: #FFF;
    cursor: pointer;
    border: none;
    outline: none;
    background-color: #333;
    border-radius: 50px;
    margin: auto;
}

form{
    display: grid;
    grid-template-columns: 1fr;
    margin: auto;
    background-color: #f3f3f3;
    padding: 20px;
    padding-top: 40px;
    border-radius: 20px;   
    margin-top: 0;
}



</style>
