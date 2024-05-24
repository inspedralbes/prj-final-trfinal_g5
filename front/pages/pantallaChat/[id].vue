<template>

    <body>
        <div class="main-content">
            <div class="cabecera">
                <!-- Mostrar foto de perfil del usuario -->
                <img :src="'http://localhost:8000/storage/imagenes_perfil/' + usuario.foto_perfil" alt="Imatge de perfil">
                <p>{{ usuario.nom }}</p>
            </div>
            <!-- Mostrar el título solo cuando se activa la rutina -->


            <!-- Resto del contenido del chat -->
            <div class="chat-container">
                <!-- Cabecera del chat -->
                <input type="file" ref="fileInput" style="display: none;" @change="handleFileChange">
                <input type="file" ref="videoInput" style="display: none;" @change="handleVideoChange">

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
                                <div class="mensaje-imagen" v-if="mensaje.imagen">
                                    <img :src="'http://localhost:8000/storage/imagen/' + mensaje.imagen" alt="Imatge Chat"
                                        class="imagen-chat">
                                    <p v-if="mensaje.mensaje">{{ mensaje.mensaje }}</p>
                                    <div class="hora-container">
                                        <span id="hora-missatge">{{ formatDate(mensaje.created_at) }}</span>

                                    </div>
                                </div>
                                <template v-if="mensaje.video">
                                    <video width="1920" height="240" controls>
                                        <source :src="'http://localhost:8000/storage/video/' + mensaje.video"
                                            type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <p v-if="mensaje.mensaje">{{ mensaje.mensaje }}</p>

                                    <div class="hora-container">
                                        <span id="hora-missatge">{{ formatDate(mensaje.created_at) }}</span>

                                    </div>
                                </template>
                                <div v-if="mensaje.idRutina">
                                    <h3 v-if="mensaje.idRutina">Rutina</h3>
                                    <div class="rutina-container">
                                        <div id="taula-rutina" v-for="(ejercicio, index) in rutinas2" :key="index">
                                            <h4 id="exercici">{{ ejercicio.nom_exercici }}</h4>
                                            <p id="series">Series: {{ ejercicio.series }}</p>
                                            <p id="reps">Reps: {{ ejercicio.repeticions }}</p>
                                        </div>
                                    </div>
                                    <button id="guardar-rutina" @click="GuardarRutina(usuarioActual, rutinas2)">Guardar Rutina</button>
                                    <p id="hora-missatge">{{ formatDate(mensaje.created_at) }}</p>
                                </div>
                                <div v-if="mensaje.idDieta">
                                    <p v-if="mensaje.idDieta">Dieta</p>
                                    <div>
                                        <div v-for="(plat, index) in dietas2" :key="index">
                                            <p>{{ plat.nom_plat }}</p>
                                        </div>
                                        <p id="hora-missatge">{{ formatDate(mensaje.created_at) }}</p>

                                    </div>
                                </div>

                                <div class="mensaje-recibido-container"
                                    v-if="mensaje.usuario_envia_mensaje === usuario.id && !mensaje.idRutina && !mensaje.idDieta && !mensaje.video && !mensaje.imagen">

                                    <div id="mensaje-texto"> {{ mensaje.mensaje }}</div>
                                    <div class="hora-container">
                                        <span id="hora-missatge">{{ formatDate(mensaje.created_at) }}</span>

                                    </div>
                                </div>
                                <div class="mensaje-texto-container"
                                    v-if="mensaje.usuario_envia_mensaje !== usuario.id && !mensaje.idRutina && !mensaje.idDieta && !mensaje.video && !mensaje.imagen">
                                    <div id="mensaje-texto">

                                        {{ mensaje.mensaje }}

                                    </div>
                                    <div class="hora-container">
                                        <span id="hora-missatge-enviat">{{ formatDate(mensaje.created_at) }}</span>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Controles inferiores -->
            </div>
            <div class="controles-inferiores">
                <!-- Área de texto con el botón "+" -->
                <div v-if="imagenSeleccionada" class="imagen-seleccionada">
                    <div>
                        <img :src="imagenSeleccionada" alt="Imagen seleccionada">
                    </div>
                    <div>
                        <Icon id="close" name="i-ic-round-close" @click="imagenSeleccionada = null"></Icon>
                    </div>
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
                    <button @click="toggleModal" class="boton-agregar">
                        <Icon id="attach" name="i-ic:round-attach-file"></Icon>
                    </button>
                    <button @click="enviarMensaje" :disabled="isSaving" class="boton-enviar">
                        <Icon id="send" name="i-ic:round-send"></Icon>
                    </button>
                </div>

                <!-- Modal -->
                <div class="modal" v-if="mostrar" @click="toggleModal">
                    <div class="modal-contenido" ref="modalContenido">
                        <!-- Opciones del modal -->
                        <div>
                            <Icon id="image" @click="openFileInput" name="i-material-symbols-image"></Icon><span
                                class="compartir">Imatge</span>
                        </div>
                        <div>
                            <Icon id="video" @click="openVideo" name="i-ic:baseline-video-camera-back"></Icon><span
                                class="compartir">Vídeo</span>
                        </div>
                        <div>
                            <Icon id="routine" @click="enviarRutina" name="i-ic:round-fitness-center"></Icon>
                            <p class="compartir">Rutina</p>
                        </div>
                        <div>
                            <Icon id="diet" @click="enviarDieta" name="i-mdi:food-apple"></Icon>
                            <p class="compartir">Dieta</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Navbar -->
            <navBar />
        </div>
    </body>
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
            usuarioActual: null,
            rutinas: [], // Array para almacenar los datos de las rutinas
            rutinas2: [],
            diaSeleccionado: null, // Almacena el día seleccionado por el usuario
            dietas: [],
            dietas2: [],

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
                console.log(data);
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
                console.log(responseData);
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
                const idDieta = useUsuariPerfilStore().id_usuari;

                const id_usuario = useUsuariPerfilStore().id_usuari;
                const id_amic = useUsuariPerfilStore().amic;

                // Obtener todos los IDs de rutina mostrados
                console.log(idDieta);

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
                console.log(responseData);
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
    overflow-x: hidden;
}

body {

    height: 100vh;
}

.main-content {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    height: 100vh;
    width: 100%;
}

.cabecera {
    display: flex;
    /* Para que los elementos estén en línea */
    align-items: center;
    /* Para centrar verticalmente */
    justify-content: left;
    /* Para centrar horizontalmente */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    color: #333;
    padding: 20px 20px;
    margin-left: 40px;
    border-radius: 10px;
    width: 100%;
    margin-bottom: 10px;
}

.cabecera p {
    margin-left: 10px;

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
    width: 50px;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    color: #333;
    border: none;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    margin-left: 10px;

}


.rutina-container {
    max-width: fit-content;
    justify-content: flex-end;
    align-self: flex-end;
    display: grid;
    grid-template-columns: 1fr;
    border-radius: 10px;

}


.controles-inferiores {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-bottom: 20px;
    background-color: #f0f0f034;
}

.entrada-mensaje-container {
    display: flex;
    align-items: center;
    display: grid;
    grid-template-columns: 5fr .1fr .1fr;
    width: 90%;
    padding: 10px;
    border-radius: 30px;
    background-color: #ccc;
    margin-top: 10px;
}

.entrada-mensaje {
    margin-left: 2px;
    width: 95%;
    padding-left: 10px;
    padding-top: 10px;
    box-sizing: border-box;
    background-color: #f0f0f0;
    border: none;
    border-radius: 20px;
    height: 35px;
    overflow-y: hidden;
}

.boton-enviar {
    width: 35px;
    height: 35px;
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

.modal {
    width: 70%;
    margin-top: 10px;
    background-color: #a3a3a3;
    border-radius: 15px;

}

.modal-contenido {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    margin: auto;
    width: 80%;
    text-align: center;
    padding: 10px;

}

.modal-contenido img {
    width: 50px;
    height: 50px;
    margin: 10px;
    border-radius: 20%;
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
    padding-left: 15px;
    border-radius: 8px;
    word-wrap: break-word;
    /* Agrega esta línea */
}

.mensaje-recibido {
    text-align: left;
    justify-content: flex-start;
    align-self: flex-start;
    background-color: #E2E2E2;
    display: grid;
    grid-template-columns: 1fr;
    padding-right: 10px;
    padding-left: 10px;
    padding-top: 5px;
    padding-bottom: 5px;
    max-width: 60%;
    vertical-align: baseline;
    
    

}

.mensaje-enviado {
    justify-content: flex-end;
    background-color: #FFA500;
    align-self: flex-end;
    display: grid;
    grid-template-columns: 1fr;
    padding-right: 10px;
    padding-left: 10px;
    padding-top: 5px;
    padding-bottom: 5px;
    max-width: 60%;
    vertical-align: baseline;

}

.mensaje-imagen {
    max-width: fit-content;
    justify-content: flex-end;
    align-self: flex-end;
    display: grid;
    grid-template-columns: 1fr;


}

.mensaje-texto-container {
    display: grid;
    grid-template-columns: 1fr;
    gap: 10px;
    margin: auto;
    max-width: fit-content;
    justify-content: flex-end;
}


.mensaje-recibido-container {
    display: grid;
    grid-template-columns: 1fr;
    gap: 10px;
    word-wrap: break-word;
    text-align: left;
    /* Agrega esta línea */

}


#mensaje-texto {
    max-width: fit-content;
    word-break: break-all;
    padding-left: 5px;


}

.imagen-chat {
    width: 100%;
    height: auto;
    border-radius: 8px;
    display: block;
    margin: auto;

}

.imagen-seleccionada {
    display: grid;
    grid-template-columns: 1fr .1fr;
    gap: 10px;
    margin-bottom: 10px;
    width: 100%;
    margin: auto;
    box-shadow: rgba(0, 0, 0, 0.2) 0px -25px 20px 0px;

}

#close {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: #333;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    margin-right: 10px;
    margin-top: 10px;
    padding: 2px;
}

.imagen-seleccionada img {
    width: 80%;
    display: block;
    margin: auto;
    margin-top: 20px;


}

.compartir {
    font-size: .75em;
    line-height: 1;
    font-weight: 600;
    font-style: italic;
    color: #333;
}

h3 {
    text-align: center;
    font-size: .7em;
    color: #9c9c9c;
}

h4 {
    font-weight: bolder;
}

video {
    width: 100%;
    height: auto;
    border-radius: 8px;

}

#hora-missatge {
    font-size: .60em;
    font-style: italic;
    color: #333;
    text-align: right;
    margin-right: 5px;
    margin-top: 20px;
    

}

#hora-missatge-enviat {
    font-size: .60em;
    font-style: italic;
    color: #333;
    
    margin-top: 20px;
    word-wrap: normal;
    
}

#taula-rutina {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    border-bottom: 1px solid #ffffff49;

}


#exercici {
    font-size: .7em;
    font-weight: 600;
    text-align: center;
    padding: 15px;
    font-style: italic;
    width: 70%;
    margin: auto;
    border-right: 1px solid #ffffff49;
}

#series {
    font-size: .7em;
    font-weight: 600;
    text-align: center;
    padding: 15px;
    font-style: italic;
    width: 70%;
    margin: auto;
    border-radius: 10px;

}

#reps {
    font-size: .7em;
    font-weight: 600;
    text-align: center;
    padding: 15px;
    font-style: italic;
    width: 70%;
    margin: auto;
    border-radius: 10px;
}

#send {
    width: 100%;
    height: 100%;
    margin-left: 2px;
}

#attach {
    width: 100%;
    height: 100%;
    margin-left: 2px;
}

#image {
    width: 65%;
    height: 65%;
    color: #1a1a1a8c;
}

#video {
    width: 65%;
    height: 65%;
    color: #1a1a1a8c;

}

#routine {
    width: 60%;
    height: 60%;
    color: #1a1a1a8c;

}

#diet {
    width: 60%;
    height: 60%;
    color: #1a1a1a8c;

}
</style>
