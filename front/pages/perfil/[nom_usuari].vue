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
                            <input type="decimal" v-model="usuario.pes">
                        </div>
                        <div class="input-container">
                            <label>Gènere:</label>
                            <select v-model="usuario.genere">
                                <option value="Home">Home</option>
                                <option value="Dona">Dona</option>
                                <option value="Altres">Altres</option>
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
                            <input type="text" v-model="usuario.fotoPerfil">
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
import { useUsuariPerfilStore } from '@/stores/index'
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
                fotoPerfil: null,
                alergia_intolerancia: '',
                lesio: '',
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

            fetch(`http://localhost:8000/api/usuari/${idUsuario}`)
                .then(response => response.json())
                .then(data => {
                    this.usuario = {
                        nom: data.usuario.nom,
                        cognoms: data.usuario.cognoms,
                        email: data.usuario.email,
                        telefon: data.usuario.telefon,
                        data_naixement: data.usuario.data_naixement,
                        altura: data.usuario.altura,
                        pes: data.usuario.pes,
                        genere: data.usuario.genere,
                        fotoPerfil: data.usuario.foto_perfil, // Asegúrate de que coincida con la clave del objeto recibido
                        alergia_intolerancia: data.usuario.alergia_intolerancia,
                        lesio: data.usuario.lesio
                    };
                    console.log('Datos del usuario obtenidos:', data);
                })
                .catch(error => {
                    console.error('Error al obtener los datos del usuario:', error);
                });
        },
        onFileChange(event) {
            const file = event.target.files[0];
            this.usuario.fotoPerfil = file;
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
                foto_perfil: this.usuario.fotoPerfil,
                alergia_intolerancia: this.usuario.alergia_intolerancia,
                lesio: this.usuario.lesio,
            };

            console.log('Datos a enviar en la solicitud PUT:', formData);

            fetch(`http://localhost:8000/api/editar-usuari/${idUsuario}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            }).then(response => {
                if (response.ok) {
                    console.log('Datos actualizados exitosamente');
                    // Redireccionar a la página de detalles de sesión
                    this.$router.push(`/home`);
                } else {
                    console.error('Error al actualizar la sesión:', response.statusText);
                }
            }).catch(error => {
                console.error('Error de red:', error);
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
