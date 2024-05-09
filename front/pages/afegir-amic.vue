<template>
  <Capçalera />
  <div class="user-list-container">
    <h1>Lista de Usuarios</h1>
    <input type="text" v-model="busqueda" placeholder="Buscar por nombre, apellido o nombre de usuario">
    <div v-if="usuariosFiltrados.length === 0 && busqueda.length > 0">
      <p>No se encontraron usuarios</p>
    </div>
    <div v-else>
      <div v-for="usuario in usuariosFiltrados" :key="usuario.id" class="usuario-container">
        <div class="info-usuario">
          <img :src="'http://127.0.0.1:8000/storage/imagenes_perfil/' + usuario.foto_perfil" alt="Usuario"
            class="user-icon" />
          <div class="user-details">
            <p class="user-name">{{ usuario.nom }} {{ usuario.cognoms }}</p>
            <p class="username">{{ usuario.nom_usuari }}</p>
          </div>
        </div>
        <button @click="agregarAmigo(usuario.id)" class="add-friend-button">Añadir amigo</button>
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
        this.usuarios = data.usuarios;
      } catch (error) {
        console.error(error);
      }
    },
    async agregarAmigo(idUsuario) {
      try {
        const response = await fetch('http://localhost:8000/api/agregar-amigo', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ idUsuario })
        });
        if (!response.ok) {
          throw new Error('Error al agregar amigo');
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

.add-friend-button:hover {
  background-color: #45a049;
}

input[type="text"] {
  width: 50%;
  padding: 8px 10px;
  margin: 10px 0;
  box-sizing: border-box;
}
</style>
