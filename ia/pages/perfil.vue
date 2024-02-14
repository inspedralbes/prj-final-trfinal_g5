<template>
    <div>
        <div class="flex-container">
            <div class="header-container">
                <img src="../public/usuario.png" alt="Usuario" class="user-icon" />
                <h1 class="title">{{ usuari }}</h1>
            </div>
            <div class="user-info-container">
                <div class="input-container">
                    <label>Nom:</label>
                    <input type="text" :disabled="!editable" v-model="usuario.nom">
                </div>
                <div class="input-container">
                    <label>Cognoms:</label>
                    <input type="text" :disabled="!editable" v-model="usuario.cognoms">
                </div>
                <div class="input-container">
                    <label>Data naixement:</label>
                    <input type="date" :disabled="!editable || !editableDate" v-model="usuario.data_naixement">
                </div>
                <div class="input-container">
                    <label>Altura (cm):</label>
                    <input type="number" :disabled="!editable" v-model="usuario.altura">
                </div>
                <div class="input-container">
                    <label>Pes (kg):</label>
                    <input type="number" :disabled="!editable" v-model="usuario.pes">
                </div>
                <div class="input-container">
                    <label>Gènere:</label>
                    <!-- Utilizamos un input para el género antes de hacer clic en "Modificar" -->
                    <input type="text" v-if="!editable" :value="usuario.genere" disabled>
                    <!-- Utilizamos un select con las opciones correspondientes después de hacer clic en "Modificar" -->
                    <select v-model="usuario.genere" v-else :disabled="!editable">
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>
                <div class="input-container" v-if="editable">
                    <label>Foto de Perfil:</label>
                    <input type="file" @change="onFileChange">
                </div>
                <button class="large-button" @click="modificarDatos">{{ editable ? 'Guardar' : 'Modificar' }}</button>
            </div>
        </div>
        <navBar />
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            usuari: '',
            usuario: {
                nom: '',
                cognoms: '',
                data_naixement: '',
                altura: '',
                pes: '',
                genere: '',
                fotoPerfil: null
            },
            editable: false, // Bandera para controlar el estado de edición
            editableDate: true // Bandera para controlar si se puede editar la fecha de nacimiento
        };
    },
    mounted() {
        this.obtenerDatosUsuario();
        this.usuari = localStorage.getItem('username');

    },
    methods: {
        obtenerDatosUsuario() {
            const emailUsuario = localStorage.getItem('email');
            fetch(`http://localhost:8000/api/usuari/${emailUsuario}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la solicitud.');
                    }
                    return response.json();
                })
                .then(data => {
                    // console.log('Respuesta de la API:', data);
                    if (!data || !data.usuario) {
                        throw new Error('Respuesta de la API incompleta o vacía.');
                    }
                    const usuarioData = data.usuario;
                    this.usuario.nom = usuarioData.nom;
                    this.usuario.cognoms = usuarioData.cognoms;
                    this.usuario.data_naixement = usuarioData.data_naixement;
                    this.usuario.altura = usuarioData.altura;
                    this.usuario.pes = usuarioData.pes;
                    this.usuario.genere = usuarioData.genere;
                    // Asignar la foto de perfil también si es necesario
                })
                .catch(error => {
                    console.error('Error al obtener los datos del usuario:', error);
                });
        },
        onFileChange(event) {
            const file = event.target.files[0];
            this.usuario.fotoPerfil = file;
        },
        modificarDatos() {
            if (this.editable) {
                // Guardar los datos del usuario
                const emailUsuario = localStorage.getItem('email');
                const formData = new FormData();
                formData.append('nom', this.usuario.nom);
                formData.append('cognoms', this.usuario.cognoms);
                formData.append('data_naixement', this.usuario.data_naixement);
                formData.append('altura', this.usuario.altura);
                formData.append('pes', this.usuario.pes);
                formData.append('genere', this.usuario.genere);
                formData.append('fotoPerfil', this.usuario.fotoPerfil);

                // Mostrar en consola lo que se está enviando para modificar el usuario
                for (let pair of formData.entries()) {
                    console.log(pair[0] + ': ' + pair[1]);
                }

                fetch(`http://localhost:8000/api/editar-usuario/${emailUsuario}`, {
                    method: 'PUT',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Datos del usuario actualizados:', data);
                        this.editable = false; // Desactivar la edición después de guardar los datos
                        // Redirigir a la página /home
                        this.$router.push('/home');
                    })
                    .catch(error => {
                        console.error('Error al guardar los datos del usuario:', error);
                    });
            } else {
                // Habilitar la edición de los campos
                this.editable = true;
            }
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
  