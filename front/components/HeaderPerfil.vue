<template>
    <div class="header-container">
        <div class="imgContainer">
            <!-- Input oculto para seleccionar una imagen -->
            <input type="file" ref="fileInput" style="display: none;" @change="handleFileChange">
            <!-- Mostrar la imagen de perfil actual -->
            <img :src="'http://127.0.0.1:8000/storage/imagenes_perfil/' + foto_perfil" alt="Usuario" class="user-icon"
                :class="{ 'incomplete-profile': !registre }" @click="openFileInput" />
            <h1>{{ nom_usuari }}</h1>
            <div v-if="!registre" class="alert-sign">
                !
            </div>
            <div class="editar-sign">
                <img src="../public/editar.png">
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

                // Mostrar en la consola la foto de perfil seleccionada
                // console.log('Foto de Perfil seleccionada:', this.usuario.foto_perfil);

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
            // Puedes llamar a funciones separadas para manejar la lógica de guardado de la imagen y los otros campos
            // Por ejemplo:
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
                    // console.log('Datos del usuario actualizados:', data);
                    this.$router.push('/home');
                    if (this.usuario.foto_perfil) {
                        useUsuariPerfilStore().foto_perfil = data.foto_perfil;
                    }

                    // Actualizar los datos originales con los datos modificados
                    this.datosOriginales = { ...this.datosOriginales, ...this.usuario };

                    // Restablecer la variable de estado a false después de completar el guardado
                    this.isSaving = false;
                })
                .catch(error => {
                    // console.error('Error al actualizar los datos del usuario:', error);
                    // Restablecer la variable de estado a false si hay un error en el guardado
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

.imgContainer img {
    width: 38%;
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

.editar-sign {
    width: 30px;
    height: 30px;
    background-color: #e3e3e3;
    border-radius: 50%;
}

.editar-sign img {
    width: 20px;
    height: 20px;
}

h1 {
    padding: 20px;
    font-size: 1.1rem;
}

.header-container {
    background-color: #f0f0f0;
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