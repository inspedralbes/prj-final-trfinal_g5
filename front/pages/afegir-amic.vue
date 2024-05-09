<template>
  <div>
    <ul>
      <li v-for="usuario in usuarios" :key="usuario.id">
        {{ usuario.nom }}
        <button @click="enviarSolicitud(usuario.id)">Enviar solicitud</button>
      </li>
    </ul>
  </div>
  <navBar />
</template>

<script>
import { getUsers, enviarSolicitudAmistad } from '@/stores/communicationManager';
import { useUsuariPerfilStore } from '@/stores/index';


export default {
  data() {
    return {
      usuarios: []
    };
  },
  mounted() {
    this.getUsuarios();
  },
  methods: {
    async getUsuarios() {
      getUsers().then(response => {
        this.usuarios = response;
      });
    },

    async enviarSolicitud(usuarioRecibeId) {
      try {
        const store = useUsuariPerfilStore();
        const usuarioEnviaId = store.id_usuari;

        // Verificar si el usuario está intentando enviar una solicitud a sí mismo
        if (usuarioEnviaId === usuarioRecibeId) {
          console.error('No puedes enviar una solicitud de amistad a ti mismo.');
          return; // Salir de la función sin hacer nada más
        }

        // Enviar solicitud de amistad
        await enviarSolicitudAmistad(usuarioEnviaId, usuarioRecibeId);
        
        // Actualizar la lista de usuarios después de enviar la solicitud
        this.getUsuarios();
      } catch (error) {
        console.error('Error al enviar la solicitud de amistad:', error);
      }
    }
  }
};
</script>

<style scoped>
/* Estilos CSS para la página */
</style>
