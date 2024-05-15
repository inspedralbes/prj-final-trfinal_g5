<template>
    <body>
        <div class="flex-container">
            <capçalera />
            <h1>Detalles del Usuario</h1>
            <div v-if="usuario">
                <p><strong>Nom:</strong> {{ usuario.nom }}</p>
                <p><strong>Congons:</strong> {{ usuario.cognoms }}</p>
                <p><strong>Email:</strong> {{ usuario.email }}</p>
                <p><strong>Data de Nacimiento:</strong> {{ usuario.data_naixement }}</p>
                <p><strong>Génere:</strong> {{ usuario.genere }}</p>
                <p><strong>Pes:</strong> {{ usuario.pes }}</p>
                <p><strong>Altura:</strong> {{ usuario.altura }}</p>
                <p><strong>Teléfon:</strong> {{ usuario.telefon }}</p>

                <button @click="borrarUsuari(usuario.id)">Borrar Usuari</button>
                <button>Rutines Usuari</button>
                <button>Dietes Usuari</button>
            </div>
            <div v-else>
                <p>Carregant dades de l'usuari...</p>
            </div>
            <navBar />
        </div>
    </body>
</template>

<script>
import { useUsuariPerfilStore } from '@/stores/index';

export default {
    data() {
        return {
            usuario: null
        };
    },
    mounted() {
        this.cargarUsuario();
    },
    methods: {
        cargarUsuario() {
            const store = useUsuariPerfilStore();
            const idUsuario = store.id_usuari;
            getDatosUsuario2(idUsuario)
                .then(response => {
                    if (response.status === 1) {
                        this.usuario = response.usuario;
                    } else {
                        console.error('Error al obtener los datos del usuario');
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        }
    }
};
</script>

<style scoped>
html,
body {
    margin: 0;
    padding: 0;
    height: 100%;
    overflow-x: hidden;
    /* Evita el desplazamiento horizontal */
}

.flex-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100vh;
    /* Mínimo 100% de la altura de la ventana */
    background-color: #FFF;
    position: relative;
}

h1 {
    margin-bottom: 20px;
}

p {
    margin: 5px 0;
}
</style>