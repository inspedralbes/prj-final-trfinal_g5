<template>
    <div class="main-content">
        <HeaderChat />
        <div id="barra-busqueda" v-if="amics.length > 0">


            <input type="text" v-model="busqueda" placeholder="Buscar...">
        </div>
        <div class="lista-amigos">
            <div v-if="amics.length === 0">
                <div class="vacio">
                    <p>No tens amics, però pots mirar les sol·licituds o afegir amics</p>
                </div>
            </div>
            <div v-for="amigo in amicsFiltrados" :key="amigo.id" class="amigo">
                <!-- Aquí agregamos el evento @click para redirigir al usuario y guardar el ID del amigo -->
                <nuxt-link :to="`/pantallaChat/${amigo.id}`" @click="seleccionarAmigo(amigo.id)">
                    <div class="chat-element">
                        <img :src="'http://127.0.0.1:8000/storage/imagenes_perfil/' + amigo.foto_perfil"
                            :alt="'Imagen de perfil de ' + amigo.nom">
                        <div class="info-chat">
                            <div>
                                <div class="nombre">{{ amigo.nom }}</div>
                                <div id="ultim-missatge">
                                    <!-- Renderizar el icono de foto solo si hay una imagen -->
                                    <template v-if="amigo.ultimoMensaje && amigo.ultimoMensaje.imagen">
                                        <Icon class="" name="i-ic-round-insert-photo" />
                                    </template>
                                    <template v-if="amigo.ultimoMensaje && amigo.ultimoMensaje.video">
                                        <Icon class="" name="i-ic-round-video-camera-back" />
                                    </template>

                                    <!-- Mostrar el mensaje si existe -->
                                    {{ amigo.ultimoMensaje && amigo.ultimoMensaje.mensaje ? amigo.ultimoMensaje.mensaje
            : ''
                                    }}
                                </div>
                            </div>
                            <div class="ultima-hora">{{ amigo.ultimoMensaje ?
            formatHora(amigo.ultimoMensaje.created_at) : '' }}</div>


                        </div>
                    </div>
                </nuxt-link>
            </div>
            <div v-if="amics.length > 0 && amicsFiltrados.length === 0">
                <div class="vacio">
                    <p>No s'ha trobat cap usuari amb aquest nom.</p>
                </div>
            </div>
        </div>
        <navBar />


    </div>

</template>

<script>
import { useUsuariPerfilStore } from '@/stores/index';
import { getUsuariosChat } from '@/stores/communicationManager';

export default {
    data() {
        return {
            busqueda: '',
            amics: [],
            mostrarMenu: false
        };
    },
    mounted() {
        // Obtiene los usuarios del chat
        this.obtenerAmigos();
    },
    computed: {
        amicsFiltrados() {
            return this.amics.filter(amigo => {
                const terminoBusqueda = this.busqueda.toLowerCase();
                return (
                    amigo.nom.toLowerCase().includes(terminoBusqueda) ||
                    amigo.cognoms.toLowerCase().includes(terminoBusqueda) ||
                    amigo.nom_usuari.toLowerCase().includes(terminoBusqueda)
                );
            });
        }
    },
    methods: {
        obtenerAmigos() {
            const store = useUsuariPerfilStore();
            const idUsuario = store.id_usuari;
            console.log(idUsuario);

            getUsuariosChat(idUsuario).then(async response => { // Agrega async aquí
                this.amics = response.amigos;

                // console.log(this.amics);
                // Usa Promise.all para esperar a que se resuelvan todas las promesas
                await Promise.all(this.amics.map(async amigo => {
                    const ultimoMensaje = await this.mostrarUltimoMensajeEntreEllos(idUsuario, amigo.id); // Cambia a this.mostrarUltimoMensajeEntreEllos
                    amigo.ultimoMensaje = ultimoMensaje;
                }));
            });
        },
        seleccionarAmigo(idAmigo) {
            // Guarda el ID del amigo en el store
            useUsuariPerfilStore().amic = idAmigo;
        },
        async mostrarUltimoMensajeEntreEllos(idUsuario, idAmigo) {
            try {
                const response = await fetch(`http://localhost:8000/api/ultim-missatge/${idUsuario}/${idAmigo}`);
                const responseData = await response.json();
                // console.log(responseData);
                if (responseData.status === 1) {
                    console.log(responseData.message);

                    return responseData.message; // Devuelve el mensaje si se encontró uno
                } else {
                    return ''; // Devuelve una cadena vacía si no se encontró ningún mensaje
                }
            } catch (error) {
                console.error('Error al obtener el último mensaje entre los usuarios:', error);
                return ''; // Devuelve una cadena vacía en caso de error
            }
        },
        formatHora(fecha) {
            if (!fecha) return '';
            const hora = new Date(fecha).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            return hora;
        }
    }
};
</script>
<style scoped>
body {
    height: 100%;
    overflow-x: hidden;
}

a {
    text-decoration: none;
    color: black;
}


.main-content {
    margin: 0;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100vh;
}


.item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.item img {
    width: 100px;
    height: 100px;
    margin-right: 10px;
}

.hora {
    margin-left: auto;
}

.chat-element {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    padding: 10px;
    border-bottom: 1px solid #ccc;
    border-radius: 5px;
    width: 100%;
}

.chat-element .nombre {
    flex-grow: 1;
    /* Hace que el nombre ocupe todo el espacio disponible */
}

.chat-element .hora {
    margin-left: 20px;
    /* Ajusta el margen para separar la hora del nombre */
}

.info-chat {
    width: 100%;
    display: grid;
    grid-template-columns: 1fr 1fr;
}

/* Otros estilos */
.lista-amigos {
    width: 80%;
    margin: 0 auto;
    margin-left: 3%;
    margin-top: 20px;
}

.amigo {
    margin-bottom: 20px;
    width: 100%;
}

.amigo span {
    font-size: 1.2em;
}

.nombre {
    font-weight: bold;
}

.ultima-hora {
    font-size: .7em;
    margin-left: 50%;
    padding: 20px;
    color: #777;
}

.amigo img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
}

.vacio {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 200px;
    font-size: 20px;
    color: #474747;
}

input[type="text"] {
    width: 50%;
    padding: 8px 10px;
    margin: 10px 0;
    box-sizing: border-box;
    margin-left: 25px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

#barra-busqueda {
    width: 100%;
    display: flex;
    justify-content: left;
    border: none;
}


#ultim-missatge {
    font-size: 0.8em;
    color: #777;
}

.vacio {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 200px;
    font-size: 20px;
    color: #474747;
}
</style>