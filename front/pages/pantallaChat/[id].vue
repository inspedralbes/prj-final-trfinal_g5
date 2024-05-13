<template>
    <div>
        <!-- Cabecera del chat -->
        <input type="file" ref="fileInput" style="display: none;" @change="handleFileChange">
        <input type="file" ref="videoInput" style="display: none;" @change="handleVideoChange">

        <div class="cabecera">
            <!-- Mostrar foto de perfil del usuario -->
            <img :src="'http://localhost:8000/storage/imagenes_perfil/' + usuario.foto_perfil" alt="Foto de perfil">
            <p>{{ usuario.nom }}</p>
        </div>

        <!-- Contenedor de mensajes -->
        <div class="mensajes-container">
            <!-- Iterar sobre los grupos de mensajes por día -->
            <div v-for="(mensajesDia, fecha) in mensajes" :key="fecha" class="mensajes-dia">
                <h3>{{ fecha }}</h3>

                <!-- Ordenar los mensajes por su ID -->
                <div v-for="mensaje in ordenarMensajesPorId(mensajesDia)" :key="mensaje.id" class="mensaje-container">
                    <div
                        :class="{ 'mensaje-recibido': mensaje.usuario_envia_mensaje === usuario.id, 'mensaje-enviado': mensaje.usuario_envia_mensaje !== usuario.id }">
                        <!-- Verificar si el mensaje tiene una imagen -->
                        <template v-if="mensaje.imagen">
                            <img :src="'http://localhost:8000/storage/imagen/' + mensaje.imagen" alt="Foto Chat"
                                class="imagen-chat">
                        </template>
                        <template v-if="mensaje.video">
                            <video width="320" height="240" controls>
                                <source :src="'http://localhost:8000/storage/video/' + mensaje.video" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </template>
                        <p>{{ mensaje.mensaje }}</p>
                        <p>{{ formatDate(mensaje.created_at) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Controles inferiores -->
        <div class="controles-inferiores">
            <!-- Área de texto con el botón "+" -->
            <div v-if="imagenSeleccionada" class="imagen-seleccionada">
                <p @click="imagenSeleccionada = null">x</p>
                <img :src="imagenSeleccionada" alt="Imagen seleccionada">
            </div>
            <div class="entrada-mensaje-container">
                <textarea v-model="mensaje" class="entrada-mensaje" placeholder="Escribe tu mensaje..."></textarea>
                <button @click="toggleModal" class="boton-agregar"><img src="@/public/adjunto.png"></button>
                <button @click="enviarMensaje" class="boton-enviar">Enviar</button>
            </div>

            <!-- Modal -->
            <div class="modal" v-if="mostrar" @click="toggleModal">
                <div class="modal-contenido" ref="modalContenido">
                    <!-- Opciones del modal -->
                    <div><img src="@/public/foto.png" class="modal-contenido-foto" @click="openFileInput"></div>
                    <div><img src="@/public/video.png" class="modal-contenido-video" @click="openVideo"></div>

                    <div><img src="@/public/rutina.png" class="modal-contenido-rutina"
                            @click="opcionSeleccionada('rutina')">
                    </div>
                    <div><img src="@/public/dieta.png" class="modal-contenido-dieta"
                            @click="opcionSeleccionada('dieta')"></div>
                </div>
            </div>
        </div>

        <!-- Navbar -->
        <navBar />
    </div>
</template>

<script>
import { useUsuariPerfilStore } from '@/stores/index';

export default {
    data() {
        return {
            usuario: {}, // Objeto para almacenar la información del usuario
            mensajes: {}, // Objeto para almacenar los mensajes agrupados por día
            mensaje: '', // Variable para almacenar el mensaje escrito por el usuario
            mostrar: false,
            imagen: null,
            isSaving: false,
            imagenSeleccionada: null,

        };
    },
    methods: {
        async enviarMensaje() {
            try {
                // Verificar si tanto el mensaje como la imagen están vacíos
                if (!this.mensaje.trim() && !this.imagenSeleccionada) {
                    console.error('No puedes enviar un mensaje vacío.');
                    return; // Salir del método si no hay mensaje ni imagen
                }

                const id_usuario = useUsuariPerfilStore().id_usuari;
                const id_amic = useUsuariPerfilStore().amic;
                const mensaje = this.mensaje; // Usar directamente el mensaje del data
                let data = { mensaje }; // Inicializar el objeto de datos con el mensaje

                // Si hay una imagen seleccionada, agregarla a los datos
                if (this.imagenSeleccionada) {
                    data.imagen_base64 = this.imagenSeleccionada.split(',')[1]; // Extraer solo el contenido base64
                }

                const response = await fetch(`http://localhost:8000/api/enviar-mensaje/${id_usuario}/${id_amic}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data), // Enviar el mensaje y la imagen (si existe) en el cuerpo de la solicitud
                });

                const responseData = await response.json();
                if (responseData.status === 1) {
                    // Mensaje enviado correctamente
                    console.log('Mensaje enviado correctamente');
                    await this.mostrarMensajes();
                    // Vaciar el área de texto después de enviar el mensaje
                    this.mensaje = '';
                    // Vaciar la imagen seleccionada después de enviar el mensaje
                    this.imagenSeleccionada = null;
                } else {
                    console.error('Error al enviar el mensaje:', responseData.message);
                }
            } catch (error) {
                console.error('Error al enviar el mensaje:', error);
            }
        },


        handleFileChange(event) {
            const file = event.target.files[0]; // Obtener el archivo del evento
            console.log(file);

            if (file) {
                // Verificar si el archivo es una imagen
                if (!file.type.startsWith('image/')) {
                    console.error('El archivo seleccionado no es una imagen.');
                    return; // Salir del método si el archivo no es una imagen
                }
                // Mostrar la imagen seleccionada
                const reader = new FileReader();
                reader.onload = () => {
                    this.imagenSeleccionada = reader.result; // Asignar la imagen al src
                };
                reader.readAsDataURL(file);
            } else {
                console.error('No se seleccionó ningún archivo.');
            }
        },
        handleVideoChange(event) {
            const file = event.target.files[0];

            if (file) {
                // Verificar si el archivo es un video
                if (!file.type.startsWith('video/')) {
                    console.error('El archivo seleccionado no es un video.');
                    return;
                }

                this.imagen = file; // Cambiar a this.imagen = file;

                this.guardarMensaje2(); // Llamar al método guardarMensaje2
            } else {
                console.error('No se seleccionó ningún archivo.');
            }
        },
        async mostrarMensajes() {
            try {
                const id_usuario = useUsuariPerfilStore().id_usuari;
                const id_amic = useUsuariPerfilStore().amic;
                const response = await fetch(`http://localhost:8000/api/missatges/${id_usuario}/${id_amic}`);
                const responseData = await response.json();
                if (responseData.status === 1) {
                    // Agrupar mensajes por día
                    const mensajesPorDia = {};
                    responseData.messages.forEach(mensaje => {
                        const fecha = new Date(mensaje.created_at).toLocaleDateString('ca-ES');
                        if (!mensajesPorDia[fecha]) {
                            mensajesPorDia[fecha] = [];
                        }
                        mensajesPorDia[fecha].push(mensaje);
                    });
                    // Asignar los mensajes agrupados a la variable mensajes
                    this.mensajes = mensajesPorDia;
                }
            } catch (error) {
                console.error('Error al obtener los mensajes del chat:', error);
            }
        },

        async guardarMensaje2() {
            // Verificar si ya se está guardando para evitar múltiples envíos
            if (this.isSaving) return;

            this.isSaving = true; // Establecer la variable de estado a true para indicar que se está guardando

            try {
                let data = {}; // Inicializar el objeto de datos

                // Si el mensaje es un video, conviértelo a base64
                if (this.imagen instanceof File) {
                    const reader = new FileReader();
                    reader.onload = () => {
                        data.video_base64 = reader.result.split(',')[1]; // Extraer solo el contenido base64
                        this.enviarDatos(data); // Enviar los datos al servidor
                    };
                    reader.readAsDataURL(this.imagen);
                } else {
                    console.error('El archivo del video no se ha seleccionado correctamente.');
                }
            } catch (error) {
                console.error('Error al enviar el mensaje:', error);
            }
        },

        async enviarDatos(data) {
            console.log(data);
            try {
                const id_usuario = useUsuariPerfilStore().id_usuari;
                const id_amic = useUsuariPerfilStore().amic;
                const response = await fetch(`http://localhost:8000/api/enviar-mensaje/${id_usuario}/${id_amic}`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data),
                });

                const responseData = await response.json();
                if (responseData.status === 1) {
                    // Mensaje enviado correctamente
                    console.log('Mensaje enviado correctamente');
                    await this.mostrarMensajes();
                    // Vaciar el área de texto después de enviar el mensaje
                    this.mensaje = '';
                } else {
                    console.error('Error al enviar el mensaje:', responseData.message);
                }
            } catch (error) {
                console.error('Error al enviar el mensaje:', error);
            }
        },

        ordenarMensajesPorId(mensajes) {
            // Convertir el objeto de mensajes a un array
            const mensajesArray = Object.values(mensajes);
            // Ordenar el array de mensajes por su ID
            return mensajesArray.flat().sort((a, b) => a.id - b.id);
        },
        async mostrarAmigo() {
            try {
                const id_usuario = useUsuariPerfilStore().amic;
                const response = await fetch(`http://localhost:8000/api/usuari/${id_usuario}`);
                const responseData = await response.json();
                // console.log(responseData);
                if (responseData.status === 1) {
                    // Asignar la información del usuario devuelta por la API a la variable usuario
                    this.usuario = responseData.usuario;
                } else {
                    // Manejar el caso de error
                }
            } catch (error) {
                console.error('Error al obtener las solicitudes:', error);
            }
        },
        formatDate(dateTimeString) {
            const date = new Date(dateTimeString);
            return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        },
        toggleModal() {
            this.mostrar = !this.mostrar;
        },
        opcionSeleccionada(opcion) {
            // Aquí puedes manejar la opción seleccionada, como abrir un componente específico o ejecutar una función
            console.log("Opción seleccionada:", opcion);
            // Cerrar el modal después de seleccionar una opción
            this.cerrarModal();
        },
        openFileInput() {
            // Al hacer clic en la imagen, activar el input de archivo
            this.$refs.fileInput.click();
        },
        openVideo() {
            this.$refs.videoInput.click();
        },
        cerrarModal() {
            this.mostrar = false; // Cerrar el modal
        },

    },
    async mounted() {
        await this.mostrarAmigo();
        await this.mostrarMensajes();
    },
    beforeRouteLeave(to, from, next) {
        // Deja el campo 'amic' del almacenamiento de Pinia como null al salir de la página
        useUsuariPerfilStore().amic = null;
        next();
    },


};
</script>



<style scoped>
html,
body {
    margin: 0;
    padding: 0;
    height: 100%;
}

body {
    /* Establecer la fuente predeterminada */
    background: linear-gradient(to top right, #FFA500, #f45c36);

    /* Color de fondo */
    height: 100vh;
}

.contenedor {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    height: 100vh;
}

.cabecera {
    display: flex;
    /* Para que los elementos estén en línea */
    align-items: center;
    /* Para centrar verticalmente */
    justify-content: center;
    /* Para centrar horizontalmente */
    background-color: #333;
    color: rgb(255, 255, 255);
    padding: 10px 20px;
    border-radius: 10px;
    width: 95%;
    margin-top: 20px;
    margin-bottom: 10px;
}

.cabecera p {
    margin-left: 20px;

    margin: 0;
    font-size: 18px;
}

.cabecera img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

.mensaje-bienvenida {
    display: grid;
    grid-template-columns: .2fr 1fr;
    margin-top: 50%;


}

.mensaje-bienvenida h2 {
    font-size: 1.5em;
    font-weight: 600;
    text-align: center;
    padding: 15px;

    background-color: #33333327;
    font-style: italic;
    /* Add this line to make the text italic */
    width: 70%;
    margin: auto;
    border-radius: 10px;
}

.mensaje-bienvenida img {
    width: 55px;
    height: 55px;
    border-radius: 50%;
    margin-left: 45px;
}

.chat-container {
    overflow-y: auto;
    /* Hace que el contenido sea desplazable verticalmente si es necesario */
    flex: 1;
    /* Permite que el área del chat ocupe el espacio disponible */
    width: 90%;
}

.chat {
    display: flex;
    flex-direction: column;
    margin-top: 20px;
    padding: 0 20px;
    width: 90%;
}

.chat img {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin-right: 10px;

}

.info-usuario {
    display: grid;
    grid-template-columns: .1fr 1fr;
    align-items: center;
}

.info-usuario p {
    font-style: italic;
}

.mensaje-usuario {
    background-color: #FFDAB9;
    padding: 10px;
    border-radius: 25px;
    border-top-right-radius: 0;
    align-self: flex-end;
    margin-bottom: 8px;
}

.boton-agregar {
    justify-content: center;
    align-items: center;

}

.boton-agregar img {
    width: 20px;
    height: 20px;

}

.mensaje-asistente {
    display: flex;
    align-items: flex-start;
    margin-bottom: 8px;
    padding: 10px;
    border-radius: 25px;
    border-bottom-left-radius: 0;
    background-color: #c7ab92;
    margin-right: 10%;
}

.avatar-asistente {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin-right: 10px;
    background-color: #FFA500;
}

.contenido-mensaje-asistente {
    max-width: 100%;
}

.animacion-carga {
    width: 20px;
    height: 20px;
    border: 2px solid #4CAF50;
    border-radius: 50%;
    border-top: 2px solid #ccc;
    animation: spin 1s linear infinite;
    align-self: flex-start;
    margin-bottom: 8px;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}

.entrada-mensaje-container {
    display: flex;
    align-items: center;
    width: 100%;
    margin-left: 30px;
}

.controles-inferiores {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 20px;
    padding-bottom: 20px;
}

.entrada-mensaje {
    margin-left: 10px;
    width: 70%;
    padding: 10px;
    margin: 10px 0;
    box-sizing: border-box;
    background-color: #f0f0f0;
    border: none;
    border-radius: 8px;
    height: 50px;
}

.boton-enviar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #333;
    color: white;
    border: none;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-left: 10px;
}

.boton-enviar:hover {
    background-color: #333;
}

navBar {
    position: fixed;
    /* Para que el navbar sea fijo */
    bottom: 0;
    /* Lo posiciona en la parte inferior */
    width: 100%;
    /* Ocupa todo el ancho de la pantalla */
    z-index: 999;
    /* Asegura que esté por encima del contenido */
}

.modal-contenido {
    display: grid;
    grid-template-columns: 1fr 1fr;
    align-items: center;
    width: 100%;
    height: 100%;
    background-color: white;

}

.modal-contenido img {
    width: 50px;
    height: 50px;
    margin: 10px;
    border-radius: 20%;
}

.modal-contenido-dieta {
    background-color: red;
}

.modal-contenido-rutina {
    background-color: green;
}

.modal-contenido-video {
    background-color: blue;
}

.modal-contenido-foto {
    background-color: yellow;
}


/* Estilos para los mensajes recibidos */


.mensajes-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.mensajes-dia {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.mensaje-container {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.mensaje-enviado,
.mensaje-recibido {
    padding: 8px;
    border-radius: 8px;
}

.mensaje-recibido {
    text-align: left;
    display: flex;
    justify-content: flex-start;
    width: 50%;

    background-color: #E2E2E2;
}

.mensaje-enviado {
    width: 50%;
    display: flex;

    justify-content: flex-end;
    text-align: left;

    background-color: red;
    align-self: flex-end;
}

.imagen-chat {
    width: 80%;
    height: auto;
    border-radius: 8px;
}
.imagen-seleccionada{
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;


}
.imagen-seleccionada img{
    width: 50px;
    height: 50px;
}
h3 {
    text-align: center;
}
</style>