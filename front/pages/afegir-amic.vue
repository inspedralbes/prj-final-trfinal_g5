<template>
  <Capçalera />
  <div class="user-list-container">
    <div v-if="status === 0">
      <div class="vacio">
        <p>No es poden afegir més amics</p>
      </div>
    </div>
    <div v-else>
      <input type="text" v-model="busqueda" placeholder="Buscar usuari">
      <div v-if="usuariosFiltrados.length === 0 && busqueda.length > 0">
        <div class="vacio">
          <p>No s'han trobat usuaris</p>
        </div>
      </div>
      <div v-for="usuario in usuariosFiltrados" :key="usuario.id" class="usuario-container">
        <div class="info-usuario">
          <img :src="'http://127.0.0.1:8000/storage/imagenes_perfil/' + usuario.foto_perfil" alt="Usuario"
            class="user-icon" />
          <div class="user-details">
            <p class="user-name">{{ usuario.nom }} {{ usuario.cognoms }}</p>
            <p class="username">{{ usuario.nom_usuari }}</p>
          </div>
        </div>
        <button @click="agregarAmigo(usuario.id)" class="add-friend-button">Afegir amic</button>
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
      usuarios: [],
      busqueda: '',
      status: null
    };
  },
  computed: {
    id_usuari() {
      return useUsuariPerfilStore().id_usuari;
    },
    usuariosFiltrados() {
      return this.usuarios.filter(usuario => {
        const terminoBusqueda = this.busqueda.toLowerCase();
        return (
          usuario.nom.toLowerCase().includes(terminoBusqueda) ||
          usuario.cognoms.toLowerCase().includes(terminoBusqueda) ||
          usuario.nom_usuari.toLowerCase().includes(terminoBusqueda)
        );
      });
    }
  },
  async mounted() {
    await this.fetchUsuarios();
  },
  methods: {
    async fetchUsuarios() {
      try {
        const response = await fetch(`http://localhost:8000/api/usuarios-excepto/${this.id_usuari}`);
        if (!response.ok) {
          throw new Error('Error al obtener la lista de usuarios');
        }
        const data = await response.json();
        this.status = data.status;
        if (data.status === 1) {
          this.usuarios = data.usuarios;
        }
      } catch (error) {
        console.error(error);
      }
    },
    async agregarAmigo(idUsuario) {
      try {
        const usuario_envia_id = this.id_usuari; // Obtener el ID del usuario que envía desde la variable de datos
        const usuario_recibe_id = idUsuario; // El ID del usuario que recibe es el ID del usuario seleccionado

        const response = await fetch('http://127.0.0.1:8000/api/enviar-solicitud', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ usuario_envia_id, usuario_recibe_id }) // Incluir ambos IDs en el cuerpo de la solicitud

        });

        if (!response.ok) {
          throw new Error('Error al agregar amigo');
        }
        else {
      

        }
        // Aquí podrías mostrar un mensaje o realizar alguna acción adicional
      } catch (error) {
        console.error(error);
      }
    }

  }
}
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
  background-image: linear-gradient(to right, #ff7300, #FFA500);

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
  margin-left: 15px;
  border-radius: 5px;}

.vacio{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 200px;
    font-size: 20px;
    color: #474747;
}
</style>
