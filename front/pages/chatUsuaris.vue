<template>
    <div>
        <HeaderChat />
        <div v-if="amics.length > 0">
            <input type="text" v-model="busqueda" placeholder="Buscar...">
        </div>
        <ul class="lista-amigos">
            <li v-if="amics.length === 0">
                <div class="vacio">
                    <p>No tens amics, però pots mirar les sol·licituds o afegir amics</p>
                </div>
            </li>
            <li v-for="amigo in amicsFiltrados" :key="amigo.id" class="amigo">
                <nuxt-link to="/pantallaChat">
                    <div class="chat-element">
                        <img :src="'http://127.0.0.1:8000/storage/imagenes_perfil/' + amigo.foto_perfil" alt="Imagen de perfil de {{ amigo.nom }}">
                        <div>
                            <span>{{ amigo.nom }}</span>  <span>12:30</span> <br>
                            <span id="ultim-missatge">IPOP 11 - Aquest és més fàcil que l'anterior</span>
                        </div>
                    </div>
                </nuxt-link>
            </li>
            <li v-if="amics.length > 0 && amicsFiltrados.length === 0">
                <div class="vacio">
                    <p>No s'ha trobat cap usuari amb aquest nom.</p>
                </div>
            </li>
        </ul>
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

            getUsuariosChat(idUsuario).then(response => {
                this.amics = response.amigos;
                console.log(this.amics);
            });
        },
        toggleMenu() {
            this.mostrarMenu = !this.mostrarMenu;
        },
        redireccionarConversacion(nombrePersona) {
            // Redirige a la página de conversación con el nombre de la persona
            this.$router.push(`/conversacion/${nombrePersona}`);
        }
    }
};
</script>
<style scoped>
a {
    text-decoration: none;
    color: black;
}

/* Estilos para el menú desplegable */
.menu-desplegable {
    position: absolute;
    top: 40px;
    /* Ajusta la posición según sea necesario */
    right: 10px;
    /* Ajusta la posición según sea necesario */
    background-color: white;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 5px;
    z-index: 999;
    /* Asegura que esté por encima de otros elementos */
}

/* Otros estilos */
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

.lista-amigos {
    list-style-type: none;
    padding: 20px;
    width: 80%;

}

.amigo {
    
    margin-bottom: 20px;
    width: 100%;
}


.amigo span {
    font-size: 1.2em;

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

.amigo img {
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
  margin-left: 25px;
  border-radius: 5px;
}

#ultim-missatge {
    font-size: 0.8em;
    color: #777;
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