<template>
    <Capçalera />
    <div>
        <h1>Listado de Solicitudes</h1>
        <div v-if="solicitudes.length === 0">
            <p>No tienes solicitudes pendientes</p>
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
                <button @click="agregarAmigo(usuario.id)" class="add-friend-button">Aceptar</button>
                <button @click="agregarAmigo(usuario.id)" class="add-friend-button">Rechazar</button>
            </div>
        </div>
    </div>
    <NavBar />
</template>
solicitud.usuario.usuario.nom
<script>
import { useUsuariPerfilStore } from '@/stores/index';

export default {
    data() {
        return {
            solicitudes: []
        };
    },
    async created() {
        try {
            const id_usuario = useUsuariPerfilStore().id_usuari;
            const response = await fetch(`http://localhost:8000/api/mostrar-solicitudes/${id_usuario}`);
            const responseData = await response.json();
            if (responseData.status === 1) {
                // Recorremos las solicitudes y hacemos un fetch para obtener información del usuario
                for (const solicitud of responseData.solicitudes) {
                    try {
                        const usuarioResponse = await fetch(`http://localhost:8000/api/usuari/${solicitud.usuario_envia_id}`);
                        const usuarioData = await usuarioResponse.json();
                        // Guardamos la información del usuario en cada solicitud
                        solicitud.usuario = usuarioData;
                        console.log(solicitud.usuario.usuario.nom)
                    } catch (error) {
                        console.error('Error al obtener información del usuario:', error);
                    }
                }
                // Actualizamos la lista de solicitudes con la información del usuario
                this.solicitudes = responseData.solicitudes;
            } else {
                console.log(responseData.message);
            }
        } catch (error) {
            console.error('Error al obtener las solicitudes:', error);
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
  background-color: #FFA500;
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



input[type="text"] {
  width: 50%;
  padding: 8px 10px;
  margin: 10px 0;
  box-sizing: border-box;
}
</style>
