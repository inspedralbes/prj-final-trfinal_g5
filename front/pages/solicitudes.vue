<template>
    <div class="main-content">
        <HeaderChat />
        <div class="opcion-container">
            <div @click="mostrarSolicitudes" :class="{ 'selected': mostrarContenido }" class="opcion">Sol·licituds</div>
            <div @click="mostrarAdios" :class="{ 'selected': !mostrarContenido }" class="opcion">Les meves Sol·licituds</div>
        </div>
        <div class="llista-solicituds" v-if="mostrarContenido">
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
                            <p class="user-name">{{ solicitud.usuario.usuario.nom }} {{ solicitud.usuario.usuario.cognoms }}</p>
                            <p class="username">{{ solicitud.usuario.usuario.nom_usuari }}</p>
                        </div>
                    </div>
                    <div class="botons-acceptar-rebutjar">
                        <button @click="AceptarAmigo(solicitud.id)" class="add-friend-button">Acceptar</button>
                        <button @click="rechazarAmigo(solicitud.id)" class="delete-friend-button">Rebutjar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="solicituds-enviades" v-else>
            <div v-if="enviadas.length === 0">
                <div class="vacio">
                    <p>No tens sol·licituds enviades</p>
                </div>
            </div>
            <div  v-else>
                <div v-for="envia in enviadas" :key="envia.id" class="usuario-container">
                    <div class="info-usuario">
                        <img :src="'http://127.0.0.1:8000/storage/imagenes_perfil/' + envia.usuario.usuario.foto_perfil"
                            alt="Usuario" class="user-icon" />
                        <div class="user-details">
                            <div class="user-name">{{ envia.usuario.usuario.nom }} {{ envia.usuario.usuario.cognoms }}</div>
                            <div class="username">{{ envia.usuario.usuario.nom_usuari }}</div>
                        </div>
                    </div>
                    <div class="estado-solicitud">
                        <p>Pendent d'aceptar</p>
                    </div>
                </div>
            </div>
        </div>
        <navBar />
    </div>
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
                    this.$router.push('/chatusuaris');
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
                    this.$router.push('/chatusuaris');
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

<style scoped>
body {
    height: 100%;
    overflow-x: hidden;

}

.main-content {
    margin: 0;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100vh;

}

.llista-solicituds {
    width: 90%;

}

.solicituds-enviades{
    width: 90%;

}

.estado-solicitud{
    color: #919191;
    font-size: .9em;
}


.user-list-container {
    max-width: 800px;
    margin: 0 auto;
}

.usuario-container {
    display: grid;
    grid-template-columns: 1fr .2fr;
    padding-right: 20px;
    padding-left: 20px;
    border: 1px solid #ccc;
    border-radius: 20px;
    margin-bottom: 10px;

}

.botons-acceptar-rebutjar{
    display: grid;
    grid-template-columns: 1fr ;
    margin-left: 20%;
    border-left: 1px solid #ccc;

}

.info-usuario {
    display: flex;
    align-items: center;
    width: 100%;
}

.user-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
}

.user-details {
    display: grid;
    grid-template-rows: 1fr;
}

.user-name {
    font-weight: bold;
}

.username {
    margin-top: 0;
    font-style: italic;
}

.add-friend-button {
    width: 100%;
    color: #4CAF50;
    background-color: transparent;
    border: none;
    padding: 8px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    transition-duration: 0.4s;
    cursor: pointer;
    border-bottom: 1px solid #ccc;

}

.add-friend-button img {
    width: 20px;
    height: 20px;
}

.delete-friend-button {
    width: 100%;
    color: #f45b50;
    background-color: transparent;
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
    position: relative;
    /* Para poder posicionar el indicador */
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

.selected {
    background-image: linear-gradient(to right, #ff7300, #FFA500);
    color: white;
    /* Cambiar el color del texto cuando esté seleccionado */
}

.toggle-indicator {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50%;
    height: 4px;
    /* Ajustar el grosor del indicador */
    background-color: #FFA500;
    border-radius: 2px;
    transition: left 0.3s ease;
    /* Transición suave */
}

.opcion.selected {
    background-image: linear-gradient(to right, #ff7300, #FFA500);
}

.opcion:hover {
    background-color: #f0f0f0;
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
