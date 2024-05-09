<template>

    <body>
        <capçalera />
        <div>


            <!-- Barra de búsqueda -->
            <input type="text" v-model="busqueda" placeholder="Buscar...">
            <button @click="buscar">Buscar</button>

            <!-- Botón de añadir -->
            <button @click="toggleMenu">+</button>

            <!-- Menú desplegable -->
            <div v-if="mostrarMenu" class="menu-desplegable">
                <button><nuxt-link  href="/solicitudes">Solicitudes</nuxt-link></button>
                <button><nuxt-link  href="/afegir-amic">Añadir Amigos</nuxt-link></button>
            </div>

            <!-- Lista de elementos filtrada -->
            <div v-for="(item, index) in itemsFiltrados" :key="index" class="item">
                <img :src="item.imagen" alt="Imagen">
                <div>
                    <h3>{{ item.nombre }}</h3>
                    <p>{{ item.texto }}</p>
                </div>
                <div class="hora">{{ item.hora }}</div>
                <!-- Botón para redirigir a la conversación con esta persona -->
                <button @click="redireccionarConversacion(item.nombre)">Ir a la conversación</button>
            </div>
        </div>
        <navBar />
    </body>

</template>

<script>
import { useUsuariPerfilStore } from '@/stores/index';
import { getUsuariosChat } from '@/stores/communicationManager';

export default {
    data() {
        return {
            busqueda: '',
            items: [
                { imagen: 'icono_grupo.png', nombre: 'Fithub', texto: 'IPOP 10 NOIS', hora: '10:00 am' },
                { imagen: 'icono_Arturo.jpg', nombre: 'Nombre 2', texto: 'Texto 2', hora: '11:00' },
                { imagen: 'icono_Arturo.jpg', nombre: 'Nombre 3', texto: 'Texto 3', hora: '12:00' },
                { imagen: 'icono_Arturo.jpg', nombre: 'Nombre 4', texto: 'Texto 4', hora: '13:00' },
                { imagen: 'icono_Arturo.jpg', nombre: 'Nombre 5', texto: 'Texto 5', hora: '14:00' },
                { imagen: 'icono_Arturo.jpg', nombre: 'Nombre 6', texto: 'Texto 6', hora: '15:00' }
                // Agrega más elementos según sea necesario
            ],
            amics:[],
            mostrarMenu: false
        };
    },
    mounted() {
        // Obtiene los usuarios del chat
        this.obtenerAmigos();
    },
    computed: {
        itemsFiltrados() {
            return this.items.filter(item => {
                return item.nombre.toLowerCase().includes(this.busqueda.toLowerCase()) ||
                    item.texto.toLowerCase().includes(this.busqueda.toLowerCase()) ||
                    item.hora.toLowerCase().includes(this.busqueda.toLowerCase());
            });
        }
    },
    methods: {
        obtenerAmigos() {
            const store = useUsuariPerfilStore();
            const idUsuario = store.id_usuari;
            console.log(idUsuario);
            
            getUsuariosChat(idUsuario).then(response => {
                this.amics = response;
                console.log(this.amics);
            });
        },

        buscar() {
            // Realiza la búsqueda
            console.log('Buscando:', this.busqueda);
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
</style>