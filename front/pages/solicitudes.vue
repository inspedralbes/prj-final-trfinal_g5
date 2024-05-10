<template>
    <Capçalera />
    <div class="opcion-container">
        <div @click="mostrarSolicitudes" :class="{ 'selected': mostrarContenido }" class="opcion">Solicitudes</div>
        <div @click="mostrarAdios" :class="{ 'selected': !mostrarContenido }" class="opcion">Mis solicitudes</div>
    </div>
    <div v-if="mostrarContenido">
        <h1>{{ titulo }}</h1>
        <div v-if="solicitudes.length === 0">
            <div class="vacio">
                <p>No tens sol·licituds pendents</p>
            </div>

        </div>
        <div v-else>
            <div v-for="solicitud in solicitudes" :key="solicitud.id" class="usuario-container">
                <div class="info-usuario">
                    <img :src="'http://127.0.0.1:8000/storage/imagenes_perfil/' + solicitud.usuario.usuario.foto_perfil"
                        alt="Usuario" class="user-icon" />
                    <div class="user-details">
                        <p class="user-name">{{ solicitud.usuario.usuario.nom }} {{ solicitud.usuario.usuario.cognoms }}
                        </p>
                        <p class="username">{{ solicitud.usuario.usuario.nom_usuari }}</p>
                    </div>
                </div>
                <button @click="AceptarAmigo(solicitud.id)" class="add-friend-button"><img src="../public/tick.png">
                </button>
                <button @click="rechazarAmigo(solicitud.id)" class="delete-friend-button"><img
                        src="../public/cruz.png"></button>
            </div>
        </div>
    </div>
    <div v-else>
        <div v-if="enviadas.length === 0">
            <div class="vacio">
                <p>No tens sol·licituds enviades</p>
            </div>
        </div>
        <div v-else>
            <div v-for="envia in enviadas" :key="envia.id" class="usuario-container">
                <div class="info-usuario">
                    <img :src="'http://127.0.0.1:8000/storage/imagenes_perfil/' + envia.usuario.usuario.foto_perfil"
                        alt="Usuario" class="user-icon" />
                    <div class="user-details">
                        <p class="user-name">{{ envia.usuario.usuario.nom }} {{ envia.usuario.usuario.cognoms }}</p>
                        <p class="username">{{ envia.usuario.usuario.nom_usuari }}</p>
                    </div>
                </div>
                <div class="estado-solicitud">
                    <p>Pendent d'aceptació</p>
                </div>
            </div>
        </div>
    </div>
    <NavBar />
</template>
<script>
import { useUsuariPerfilStore } from '@/stores/index';

export default {
    data() {
        return {
            solicitudes: [],
            enviadas: [],
            mostrarContenido: true,

        };
    },
    async created() {
        try {
            const id_usuario = useUsuariPerfilStore().id_usuari;
            const response = await fetch(`http://localhost:8000/api/mostrar-solicitudes/${id_usuario}`);
            const responseData = await response.json();
            // console.log(responseData);
            if (responseData.status === 1) {
                // Recorremos las solicitudes y hacemos un fetch para obtener información del usuario
                for (const solicitud of responseData.solicitudes) {
                    try {
                        const usuarioResponse = await fetch(`http://localhost:8000/api/usuari/${solicitud.usuario_envia_id}`);
                        const usuarioData = await usuarioResponse.json();
                        // Guardamos la información del usuario en cada solicitud
                        solicitud.usuario = usuarioData;
                        // console.log(solicitud.usuario.usuario.nom)
                    } catch (error) {
                        // console.error('Error al obtener información del usuario:', error);
                    }
                }
                // Actualizamos la lista de solicitudes con la información del usuario
                this.solicitudes = responseData.solicitudes;
            } else {
                // console.log(responseData.message);
            }
        } catch (error) {
            console.error('Error al obtener las solicitudes:', error);
        }
    },
    async mounted() {
        try {
            const id_usuario = useUsuariPerfilStore().id_usuari;
            const response = await fetch(`http://localhost:8000/api/mostrar-solicitudes-enviades/${id_usuario}`);
            const responseData = await response.json();
            console.log(responseData);
            if (responseData.status === 1) {
                this.enviadas = responseData.enviadas; // Almacenar las solicitudes enviadas
                for (const envia of this.enviadas) {
                    try {
                        const usuarioResponse = await fetch(`http://localhost:8000/api/usuari/${envia.usuario_recibe_id}`);
                        const usuarioData = await usuarioResponse.json();
                        envia.usuario = usuarioData;
                        console.log(envia.usuario.usuario.nom);
                    } catch (error) {
                        console.error('Error al obtener información del usuario:', error);
                    }
                }
            } else {
                console.log(responseData.message);
            }
        } catch (error) {
            console.error('Error al obtener las solicitudes:', error);
        }
    },

    methods: {
        async AceptarAmigo(solicitudId) {
            try {
                const response = await fetch(`http://localhost:8000/api/aceptar-solicitud/${solicitudId}`, {
                    method: 'POST'
                });
                const responseData = await response.json();
                if (responseData.status === 1) {
                    console.log(responseData.message);
                    // Actualizamos la lista de solicitudes eliminando la solicitud aceptada
                    this.solicitudes = this.solicitudes.filter(solicitud => solicitud.id !== solicitudId);
                } else {
                    console.log(responseData.message);
                }
            } catch (error) {
                console.error('Error al aceptar la solicitud:', error);
            }
        },

        async rechazarAmigo(solicitudId) {
            try {
                const response = await fetch(`http://localhost:8000/api/eliminar-solicitud/${solicitudId}`, {
                    method: 'DELETE'
                });
                const responseData = await response.json();
                if (responseData.status === 1) {
                    console.log(responseData.message);
                    // Actualizamos la lista de solicitudes eliminando la solicitud rechazada
                    this.solicitudes = this.solicitudes.filter(solicitud => solicitud.id !== solicitudId);
                } else {
                    console.log(responseData.message);
                }
            } catch (error) {
                console.error('Error al rechazar la solicitud:', error);
            }
        },
        mostrarSolicitudes() {
            this.mostrarContenido = true;
        },
        mostrarAdios() {
            this.mostrarContenido = false;
        }

    }

};
</script>

<style>
.user-list-container {
    max-width: 800px;
    margin: 0 auto;
}

.usuario-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #ccc;
}

.info-usuario {
    display: flex;
    align-items: center;
}

.user-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
}

.user-details {
    flex-grow: 1;
}

.user-name {
    font-weight: bold;
}

.add-friend-button {
    width: 15%;
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 8px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    transition-duration: 0.4s;
    cursor: pointer;
    border-radius: 5px;
}

.add-friend-button img {
    width: 20px;
    height: 20px;
}

.delete-friend-button {
    width: 15%;
    background-color: #f45b50;
    border: none;
    padding: 8px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    transition-duration: 0.4s;
    cursor: pointer;
    border-radius: 5px;
}

.delete-friend-button img {
    width: 20px;
    height: 20px;
}



input[type="text"] {
    width: 50%;
    padding: 8px 10px;
    margin: 10px 0;
    box-sizing: border-box;
}

.opcion-container {
    display: flex;
    justify-content: center;
    margin-top: 30px;
    margin-bottom: 20px;
}

.opcion {
    cursor: pointer;
    margin: 0 20px;
    padding: 10px 20px;
    border-radius: 5px;
}

.opcion.selected {
    background-image: linear-gradient(to right, #ff7300, #FFA500);
}

.opcion:hover {
    background-color: #f0f0f0;
}
.vacio{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 200px;
    font-size: 20px;
    color: #474747;
}
</style>
