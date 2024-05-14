<template>
    <div>
        <!-- Mostrar el título solo cuando se activa la rutina -->
        <div v-if="mostrarRutina">
            <p @click="mostrarRutina = false">x</p>
            <h1>Rutina</h1>
            <div v-for="(ejercicio, index) in rutinas" :key="index">
                <template v-if="index === 0 || rutinas[index - 1].dia !== ejercicio.dia">
                    <p @click="toggleDia(ejercicio.dia)">Dia {{ ejercicio.dia }}</p>
                    <div v-if="diaSeleccionado === ejercicio.dia">
                        <ul>
                            <!-- Mostrar todos los ejercicios del día -->
                            <li v-for="(ejercicioDia, idx) in rutinas.filter(e => e.dia === ejercicio.dia)" :key="idx">
                                {{ ejercicioDia.nom_exercici }}
                            </li>
                        </ul>
                    </div>
                </template>
            </div>
            <button @click="enviarRutina" :disabled="isSaving">Enviar</button>
        </div>
        <div v-if="mostrarDieta">
            <p @click="mostrarDieta = false">x</p>
            <h1>Dieta</h1>
            <template v-for="(apats, index) in dietas" :key="index">
                <template v-if="index === 0 || dietas[index - 1].apat !== apats.apat">
                    <p @click="toggleDia(apats.apat)">Apat {{ apats.apat }}</p>
                </template>
                <div v-if="diaSeleccionado === apats.apat">
                    <ul>
                        <li>{{ apats.nom_plat }}</li>
                    </ul>
                </div>
            </template>
            <button @click="enviarDieta" :disabled="isSaving">Enviar</button>
        </div>





        <!-- Resto del contenido del chat -->
        <div v-if="!mostrarRutina && !mostrarDieta">
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
                    <div v-for="mensaje in ordenarMensajesPorId(mensajesDia)" :key="mensaje.id"
                        class="mensaje-container">
                        <div
                            :class="{ 'mensaje-recibido': mensaje.usuario_envia_mensaje === usuario.id, 'mensaje-enviado': mensaje.usuario_envia_mensaje !== usuario.id }">
                            <!-- Verificar si el mensaje tiene una imagen -->
                            <template v-if="mensaje.imagen">
                                <img :src="'http://localhost:8000/storage/imagen/' + mensaje.imagen" alt="Foto Chat"
                                    class="imagen-chat">
                            </template>
                            <template v-if="mensaje.video">
                                <video width="320" height="240" controls>
                                    <source :src="'http://localhost:8000/storage/video/' + mensaje.video"
                                        type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </template>
                            <div>
                                <p v-if="mensaje.idRutina">Rutina</p>
                                <div v-if="mensaje.idRutina">
                                    <div v-for="(ejercicio, index) in rutinas2" :key="index">
                                        <p>NOM{{ ejercicio.nom_exercici }}</p>
                                        <p>SERIES{{ ejercicio.series }}</p>
                                        <p>REPETICIONES{{ ejercicio.repeticions }}</p>
                                    </div>
                                    <button @click="GuardarRutina(usuarioActual, rutinas2)">Guardar Rutina</button>
                                </div>
                            </div>

                            <template v-if="mensaje.idDieta">
                                <p>Dieta</p>
                                <div v-for="(plat, index) in dietas2" :key="index">
                                    <p>Nom{{ plat.nom_plat }}</p>
                                </div>
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
                <div v-if="videoSeleccionado" class="video-seleccionado">
                    <p @click="videoSeleccionado = null">x</p>
                    <video width="320" height="240" controls>
                        <source :src="videoSeleccionado" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="entrada-mensaje-container">
                    <textarea v-model="mensaje" class="entrada-mensaje" placeholder="Escribe tu mensaje..."></textarea>
                    <button @click="toggleModal" class="boton-agregar"><img src="@/public/adjunto.png"></button>
                    <button @click="enviarMensaje" :disabled="isSaving" class="boton-enviar">Enviar</button>
                </div>

                <!-- Modal -->
                <div class="modal" v-if="mostrar" @click="toggleModal">
                    <div class="modal-contenido" ref="modalContenido">
                        <!-- Opciones del modal -->
                        <div><img src="@/public/foto.png" class="modal-contenido-foto" @click="openFileInput"></div>
                        <div><img src="@/public/video.png" class="modal-contenido-video" @click="openVideo"></div>

                        <div><img src="@/public/rutina.png" class="modal-contenido-rutina" @click="clickRutina">
                        </div>
                        <div><img src="@/public/dieta.png" class="modal-contenido-dieta" @click="clickDieta">
                        </div>
                    </div>
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
            videoSeleccionado: null,
            mostrarRutina: false,
            mostrarDieta: false,
            rutinas: [], // Array para almacenar los datos de las rutinas
            rutinas2: [],
            diaSeleccionado: null, // Almacena el día seleccionado por el usuario
            dietas: [],
            dietas2: [],
            usuarioActual: null,

        };
    },
    methods: {
        async enviarMensaje() {
            try {
                this.isSaving = true;

                const id_usuario = useUsuariPerfilStore().id_usuari;
                const id_amic = useUsuariPerfilStore().amic;
                const mensaje = this.mensaje;

                //  Verificar si tanto el mensaje como la imagen están vacíos
                if (!this.mensaje.trim() && !this.imagenSeleccionada && !this.videoSeleccionado) {
                    // Si no hay mensaje ni imagen, muestra un mensaje de error y no envíes la solicitud
                    console.error('No puedes enviar un mensaje vacío.');
                    this.isSaving = false;

                    return; // Salir del método
                }

                // Obtener todos los IDs de rutina mostrados
                let data = { mensaje }; // Incluir idRutinas en los datos que se envían al servidor

                // Si hay una imagen seleccionada, agregarla a los datos
                if (this.imagenSeleccionada) {
                    data.imagen_base64 = this.imagenSeleccionada.split(',')[1]; // Extraer solo el contenido base64
                }
                if (this.videoSeleccionado) {
                    data.video_base64 = this.videoSeleccionado.split(',')[1];
                }
                // console.log(data);
                const response = await fetch(`http://localhost:8000/api/enviar-mensaje/${id_usuario}/${id_amic}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data), // Enviar el mensaje, las rutinas y la imagen (si existe) en el cuerpo de la solicitud
                });

                const responseData = await response.json();
                console.log(responseData);
                if (responseData.status === 1) {
                    // Mensaje enviado correctamente
                    await this.mostrarMensajes();
                    // Vaciar el área de texto después de enviar el mensaje
                    this.mensaje = '';
                    // Vaciar la imagen seleccionada después de enviar el mensaje
                    this.imagenSeleccionada = null;
                    this.videoSeleccionado = null;
                    this.isSaving = false;
                } else {
                    // Manejar el caso de error al enviar el mensaje
                    console.error('Error al enviar el mensaje:', responseData.message);
                }
            } catch (error) {
                // Manejar errores
                console.error('Error al enviar el mensaje:', error);
            }
        },
        async enviarRutina() {
            try {
                this.isSaving = true;
                this.mostrarRutina = false;
                const idRutina = useUsuariPerfilStore().id_usuari;

                const id_usuario = useUsuariPerfilStore().id_usuari;
                const id_amic = useUsuariPerfilStore().amic;

                // Obtener todos los IDs de rutina mostrados
                console.log(idRutina);

                const response = await fetch(`http://localhost:8000/api/enviar-mensaje/${id_usuario}/${id_amic}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        idRutina: idRutina // Incluye el valor de idRutina aquí
                    }),
                });

                const responseData = await response.json();
                // console.log(responseData);
                if (responseData.status === 1) {
                    // Mensaje enviado correctamente
                    await this.mostrarMensajes();
                    this.isSaving = false;

                } else {
                    // Manejar el caso de error al enviar el mensaje
                    console.error('Error al enviar el mensaje:', responseData.message);
                }
            } catch (error) {
                // Manejar errores
                console.error('Error al enviar el mensaje:', error);
            }
        },
        async enviarDieta() {
            try {
                this.isSaving = true;
                this.mostrarDieta = false;
                const idDieta = useUsuariPerfilStore().id_usuari;

                const id_usuario = useUsuariPerfilStore().id_usuari;
                const id_amic = useUsuariPerfilStore().amic;

                // Obtener todos los IDs de rutina mostrados
                // console.log(idDieta);

                const response = await fetch(`http://localhost:8000/api/enviar-mensaje/${id_usuario}/${id_amic}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        idDieta: idDieta // Incluye el valor de idRutina aquí
                    }),
                });

                const responseData = await response.json();
                // console.log(responseData);
                if (responseData.status === 1) {
                    // Mensaje enviado correctamente
                    await this.mostrarMensajes();
                    this.isSaving = false;

                } else {
                    // Manejar el caso de error al enviar el mensaje
                    console.error('Error al enviar el mensaje:', responseData.message);
                }
            } catch (error) {
                // Manejar errores
                console.error('Error al enviar el mensaje:', error);
            }
        },
        async GuardarRutina(usuario, rutinas2) {
            // Modificar rutinas2 para cambiar el id_usuario según el usuario actual
            rutinas2.forEach((ejercicio, index) => {
                // console.log(`Datos del ejercicio ${index + 1}:`);
                for (const key in ejercicio) {
                    // console.log(`${key}: ${ejercicio[key]}`);
                    // Verificar si la clave es igual a "id_usuari"
                    if (key === "id_usuari") {
                        ejercicio[key] = usuario; // Asignar el valor del id_usuari del usuario al campo correspondiente del ejercicio
                    }
                }
                // console.log("----------------------");
            });

            console.log("Rutinas modificadas:", rutinas2); // Agrega este console.log
            const response = await fetch(`http://localhost:8000/api/descargarRutina`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(rutinas2), // Enviar los datos de la rutina al servidor

            });
            const responseData = await response.json();
            console.log(responseData);


        },



        async toggleDia(dia) {
            // Si el día seleccionado es el mismo que el anterior, lo deseleccionamos
            this.diaSeleccionado = this.diaSeleccionado === dia ? null : dia;
        },


        handleFileChange(event) {
            const file = event.target.files[0]; // Obtener el archivo del evento

            if (file) {
                // Verificar si el archivo es una imagen
                if (!file.type.startsWith('image/')) {
                    // console.error('El archivo seleccionado no es una imagen.');
                    return; // Salir del método si el archivo no es una imagen
                }
                // Mostrar la imagen seleccionada
                const reader = new FileReader();
                reader.onload = () => {
                    this.imagenSeleccionada = reader.result; // Asignar la imagen al src
                };
                reader.readAsDataURL(file);
            } else {
                // console.error('No se seleccionó ningún archivo.');
            }
        },
        handleVideoChange(event) {
            // Verificar si ya se ha seleccionado una imagen
            if (this.imagenSeleccionada) {
                // console.error('Ya has seleccionado una imagen. No puedes seleccionar un video.');
                return; // Salir del método si ya hay una imagen seleccionada
            }

            const file = event.target.files[0];

            if (file) {
                // Verificar si el archivo es un video
                if (!file.type.startsWith('video/')) {
                    // console.error('El archivo seleccionado no es un video.');
                    return;
                }

                const reader = new FileReader();
                reader.onload = () => {
                    this.videoSeleccionado = reader.result;
                };
                reader.readAsDataURL(file);
            } else {
                // console.error('No se seleccionó ningún archivo.');
            }
        },
        async mostrarMensajes() {
            try {
                const id_usuario = useUsuariPerfilStore().id_usuari;
                this.usuarioActual = id_usuario;
                const id_amic = useUsuariPerfilStore().amic;
                const response = await fetch(`http://localhost:8000/api/missatges/${id_usuario}/${id_amic}`);
                const responseData = await response.json();
                if (responseData.status === 1) {
                    // Agrupar mensajes por día
                    const mensajesPorDia = {};
                    responseData.messages.forEach(async mensaje => {
                        const fecha = new Date(mensaje.created_at).toLocaleDateString('ca-ES');
                        if (!mensajesPorDia[fecha]) {
                            mensajesPorDia[fecha] = [];
                        }
                        mensajesPorDia[fecha].push(mensaje);

                        // Mostrar un mensaje en la consola si el campo idRutina tiene un valor
                        if (mensaje.idRutina) {
                            const rutinaResponse = await fetch(`http://localhost:8000/api/rutina/${mensaje.idRutina}`);
                            const rutinaData = await rutinaResponse.json();
                            this.rutinas2 = rutinaData;
                            // console.log('Datos de la rutina:', rutinaData);
                        }
                        if (mensaje.idDieta) {
                            const dietaResponse = await fetch(`http://localhost:8000/api/dietas/${mensaje.idDieta}`);
                            const dietaData = await dietaResponse.json();
                            this.dietas2 = dietaData;
                        }
                    });
                    // Asignar los mensajes agrupados a la variable mensajes
                    this.mensajes = mensajesPorDia;
                }
            } catch (error) {
                // console.error('Error al obtener los mensajes del chat:', error);
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
                // console.error('Error al obtener las solicitudes:', error);
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
            // console.log("Opción seleccionada:", opcion);
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
        async clickRutina() {
            // Cambiar el estado para mostrar la rutina
            this.mostrarRutina = true;
        },
        async clickDieta() {
            // Cambiar el estado para mostrar la dieta
            this.mostrarDieta = true;
        },
        async mostrarRutinas() {
            try {
                const id_usuario = useUsuariPerfilStore().id_usuari;
                const response = await fetch(`http://localhost:8000/api/rutina/${id_usuario}`);
                const responseData = await response.json();
                this.rutinas = responseData;

            } catch (error) {
                // console.error('Error al obtener la rutina:', error);
            }
        },
        async mostrarDietas() {
            try {
                const id_usuario = useUsuariPerfilStore().id_usuari;
                const response = await fetch(`http://localhost:8000/api/dietas/${id_usuario}`);
                const responseData = await response.json();
                this.dietas = responseData;
                // console.log(this.dietas);

            } catch (error) {
                // console.error('Error al obtener la dieta:', error);
            }
        }


    },
    async mounted() {
        await this.mostrarAmigo();
        await this.mostrarMensajes();
        await this.mostrarRutinas();
        await this.mostrarDietas();

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

.imagen-seleccionada {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;


}

.imagen-seleccionada img {
    width: 50px;
    height: 50px;
}

h3 {
    text-align: center;
}
</style>