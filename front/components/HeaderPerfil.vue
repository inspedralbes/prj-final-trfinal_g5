<template>
    <div class="header-container">
        <div class="imgContainer">
            <!-- Input oculto para seleccionar una imagen -->
            <input type="file" ref="fileInput" style="display: none;" @change="handleFileChange">
            <!-- Mostrar la imagen de perfil actual -->
            <div class="user-info">
                <div class="editar-sign">
                    <img src="../public/editar.png">
                </div>
                <div :class="{ 'user-icon-container': true, 'incomplete-profile': !registre }">
                        <img :src="'http://127.0.0.1:8000/storage/imagenes_perfil/' + foto_perfil" alt="Usuario"
                            class="user-icon"@click="openFileInput" />
                    </div>
                <h1>{{ username }}</h1>
            </div>
            <div v-if="!registre" class="alert-sign">
                !
            </div>
            <div id="myProfile">
                <h1>El meu perfil</h1>
            </div>
        </div>
    </div>
</template>

<script>
import { useUsuariPerfilStore } from '@/stores/index';
import { actualizarDatosUsuario } from '@/stores/communicationManager';

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
        username() {
            return useUsuariPerfilStore().username;
        },
        foto_perfil() {
            return useUsuariPerfilStore().foto_perfil;
        },
        registre() {
            return useUsuariPerfilStore().registre;
        }
    },
    methods: {
        openFileInput() {
            // Al hacer clic en la imagen, activar el input de archivo
            this.$refs.fileInput.click();
        },
        handleFileChange(event) {
            const file = event.target.files[0]; // Obtener el archivo del evento

            if (file) {
                // Verificar si el archivo es una imagen
                if (!file.type.startsWith('image/')) {
                    // console.error('El archivo seleccionado no es una imagen.');
                    return; // Salir del método si el archivo no es una imagen
                }

                // Asignar directamente el archivo seleccionado a this.usuario.foto_perfil
                this.usuario.foto_perfil = file;

                // Llamar al método para guardar automáticamente los datos del usuario
                this.guardarDatosUsuario();
            } else {
                // console.error('No se seleccionó ningún archivo.');
            }
        },

        guardarDatosUsuario() {
            // Verificar si ya se está guardando para evitar múltiples envíos
            if (this.isSaving) return;

            this.isSaving = true; // Establecer la variable de estado a true para indicar que se está guardando

            // Lógica para guardar los datos del usuario
            if (this.usuario.foto_perfil instanceof File) {
                this.guardarFotoPerfil();
            }
        },
        guardarFotoPerfil() {
            // Lógica para guardar la foto de perfil
            const reader = new FileReader();
            reader.onload = () => {
                const base64Image = reader.result.split(',')[1]; // Extraer solo el contenido base64

                // Construir el objeto de datos a enviar
                const data = {
                    usuario: this.usuario,
                    foto_perfil_base64: base64Image // Agregar la imagen base64 a los datos del usuario
                };

                // Realizar la solicitud PUT al servidor con los datos del usuario y la imagen en base64
                this.enviarDatos(data);
            };

            // Leer la imagen de perfil como base64
            reader.readAsDataURL(this.usuario.foto_perfil);
        },
        enviarDatos(data) {
            const store = useUsuariPerfilStore();
            const idUsuario = store.id_usuari;
            actualizarDatosUsuario(idUsuario, data) // Llama a la función actualizarDatosUsuario con los datos y el idUsuario
                .then(data => {
                    this.$router.push('/home');
                    if (this.usuario.foto_perfil) {
                        useUsuariPerfilStore().foto_perfil = data.foto_perfil;
                    }
                    this.isSaving = false;
                })
                .catch(error => {
                    this.isSaving = false;
                });
        }
    }
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
    width: 50px; /* Ajustar el tamaño según sea necesario */
    height: 50px; /* Ajustar el tamaño según sea necesario */
    border-radius: 50%; /* Hacer que el contenedor sea redondo */
    overflow: hidden; /* Recortar la imagen que sobresale del contenedor */
    margin-top: 20px;
}

.user-icon {
    width: 100%; /* La imagen llena el contenedor */
    height: 100%; /* La imagen llena el contenedor */
    object-fit: cover; /* Escalar la imagen para que se ajuste dentro del contenedor */
    object-position: center; /* Centrar la imagen dentro del contenedor */
}

.incomplete-profile {
    margin-top: 20px;
    width: 50px; /* Ajustar el tamaño según sea necesario */
    height: 50px; /* Ajustar el tamaño según sea necesario */
    border-radius: 50%; /* Hacer el contenedor redondo */
    overflow: hidden; /* Ocultar cualquier parte de la imagen que se desborde del contenedor */
    border: 4px solid #FFA500;
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

.editar-sign {
    position: absolute;
    top: 3%;
    left: 30%;
    transform: translateX(5%);
    width: 30px;
    height: 30px;
    background-color: #e3e3e3;
    border-radius: 50%;
    display: flex;
}

.editar-sign img {
    margin-left: 4px;
    margin-top: 4px;
    width: 20px;
    height: 20px;
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
    padding-top: 20px;
    position: relative;
    margin-bottom: 20px;
    width: 100%;
}

#myProfile{
    text-align: right;
    margin-right: 20px;
}
</style>
