<template>
    
        <capçalera />
        <h1>IPOP 11 NOIS!!</h1>
        <navBar />
        
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
            amics: [],
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
                this.amics = response.amigos;
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
}

#ultim-missatge {
    font-size: 0.8em;
    color: #777;
}
</style>