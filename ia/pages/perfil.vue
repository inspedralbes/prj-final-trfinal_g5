<template>
    <body>
        <div>
            <div class="flex-container">
                <capçalera />
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
                        <label>Foto de Perfil:</label>
                        <input type="file" @change="onFileChange">
                    </div>
                    <button class="large-button" @click="guardarDatosUsuario">Guardar</button>
                </div>
            </div>
            <navBar />
        </div>
    </body>
</template>

<script>
export default {
    data() {
        return {
            usuario: {
                nom: '',
                cognoms: '',
                data_naixement: '',
                altura: '',
                pes: '',
                genere: '',
                fotoPerfil: null
            }
        };
    },
    mounted() {
        this.obtenerDatosUsuario();
    },
    methods: {
        obtenerDatosUsuario() {
            const idUsuario = localStorage.getItem('idUsuario');
            fetch(`http://localhost:8000/api/usuario/${idUsuario}`)
                .then(response => response.json())
                .then(data => {
                    this.usuario = data;
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
            const idUsuario = localStorage.getItem('idUsuario');
            
            const formData = new FormData();
            formData.append('nom', this.usuario.nom);
            formData.append('cognoms', this.usuario.cognoms);
            formData.append('data_naixement', this.usuario.data_naixement);
            formData.append('altura', this.usuario.altura);
            formData.append('pes', this.usuario.pes);
            formData.append('genere', this.usuario.genere);
            formData.append('fotoPerfil', this.usuario.fotoPerfil);

            fetch(`http://localhost:8000/api/editar-usuario/${idUsuario}`, {
                method: 'PUT',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Datos del usuario actualizados:', data);
            })
            .catch(error => {
                console.error('Error al guardar los datos del usuario:', error);
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
