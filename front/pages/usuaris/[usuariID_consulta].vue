<template>

    <body>
        <div class="flex-container">
            <capçalera />
            <h1>Detalls de l'Usuari</h1>
            <div v-if="usuario">
                <p><strong>Nom:</strong> {{ usuario.nom }}</p>
                <p><strong>Congons:</strong> {{ usuario.cognoms }}</p>
                <p><strong>Email:</strong> {{ usuario.email }}</p>
                <p><strong>Data de Naixement:</strong> {{ usuario.data_naixement }}</p>
                <p><strong>Génere:</strong> {{ usuario.genere }}</p>
                <p><strong>Pes:</strong> {{ usuario.pes }}</p>
                <p><strong>Altura:</strong> {{ usuario.altura }}</p>
                <p><strong>Telèfon:</strong> {{ usuario.telefon }}</p>
                <p><strong>Tipus d'usuari:</strong> {{ usuario.tipus }}</p>


                <button class="borrar-button" @click="borrarUsuari(usuario.id)">Esborrar Usuari</button>
                <button class="rutina-button" @click="anarRutina(usuario.id)" >Rutines Usuari</button>
                <button class="dieta-button" @click="anarDieta(usuario.id)" >Dietes Usuari</button>
                <button class="tornar-button" @click="tornar()">Tornar</button>
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
            usuario: null,
        };
    },
    async mounted() {
        const store = useUsuariPerfilStore();
        const idUsuario = store.usuariID_consulta;
        this.cargarUsuario(idUsuario);
    },
    methods: {
        cargarUsuario(idUsuario) {
            getDatosUsuario2(idUsuario)
                .then(response => {
                    if (response && response.status === 1) {
                        this.usuario = response.usuario;
                    } else {
                        console.error('Error al obtener los datos del usuario:', response ? response.message : 'Respuesta no válida');
                    }
                })
                .catch(error => {
                    console.error('Error al obtener los datos del usuario:', error);
                });
        },
        async borrarUsuari(idUsuario) {
            try {
                await borrarUsuari(idUsuario);
                const store = useUsuariPerfilStore();
                store.usuariID_consulta = "";
                this.$router.push('/admin/usuaris');
            } catch (error) {
                console.error('Error al borrar el usuario:', error);
            }
        },
        tornar() {
            const store = useUsuariPerfilStore();
            store.usuariID_consulta = "";
            this.$router.push('/admin/usuaris');
        },
        anarRutina(idUsuario) {
            this.$router.push(`/rutines/${idUsuario}`);
        },
        anarDieta(idUsuario) {
            this.$router.push(`/dietes/${idUsuario}`);
        },
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

.borrar-button {
    background-image: linear-gradient(to right, #ff0000, #ff5e00);
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    background-position: center;
    font-size: 1.2em;
    color: #ffffff;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    position: relative;
    width: 100%;
    max-width: 400px;
    height: 60px;
    margin-top: 30px;
    margin-bottom: 20px;
    font-weight: bold;
    cursor: pointer;
    border: none;
    outline: none;
    background-size: cover;
    border-radius: 10px;
    display: flex;
    justify-content: center;
}

.rutina-button {
    background-image: linear-gradient(to right, #ff7300, #FFA500);
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    background-position: center;
    font-size: 1.2em;
    color: #474747;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    position: relative;
    width: 100%;
    max-width: 400px;
    height: 60px;
    margin-bottom: 20px;
    font-weight: bold;
    cursor: pointer;
    border: none;
    outline: none;
    background-size: cover;
    border-radius: 10px;
    display: flex;
    justify-content: center;
}

.dieta-button {
    background-image: linear-gradient(to right, #ffee00, #7bff00);
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    background-position: center;
    font-size: 1.2em;
    color: #474747;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    position: relative;
    width: 100%;
    max-width: 400px;
    height: 60px;
    margin-bottom: 20px;
    font-weight: bold;
    cursor: pointer;
    border: none;
    outline: none;
    background-size: cover;
    border-radius: 10px;
    display: flex;
    justify-content: center;
}

.tornar-button {
    background-image: linear-gradient(to right, #0077ff, #00c3ff);
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    background-position: center;
    font-size: 1.2em;
    color: #474747;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    position: relative;
    width: 100%;
    max-width: 400px;
    height: 60px;
    margin-bottom: 20px;
    font-weight: bold;
    cursor: pointer;
    border: none;
    outline: none;
    background-size: cover;
    border-radius: 10px;
    display: flex;
    justify-content: center;
}
</style>
