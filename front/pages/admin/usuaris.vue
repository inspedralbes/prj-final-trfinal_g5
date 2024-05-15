<template>
    <body>
        <div class="flex-container">
            <capçalera />
            <h1>Listado de Usuarios</h1>
            <ul>
                <li v-for="usuari in usuaris" :key="usuari.id">
                    <button @click="verDetalleUsuari(usuari.id)">
                        {{ usuari.nom }} {{ usuari.cognoms }}
                    </button>
                </li>
            </ul>
            <navBar />
        </div>
    </body>
</template>

<script>

export default {
    data() {
        return {
            usuaris: []
        };
    },
    mounted() {
        this.cargarUsuaris();
    },
    methods: {
        cargarUsuaris() {
            getTotosUsuaris()
                .then(data => {
                    this.usuaris = data.usuaris;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        verDetalleUsuari(idUsuari) {
            this.$router.push(`/usuaris/${idUsuari}`);
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

.button-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 80%;
    /* Empuja hacia abajo los botones */
}

ul {
    list-style-type: none;
    padding: 0;
}

large-button {
    position: relative;
    /* Añade posición relativa al botón */
    width: 100%;
    /* Ancho del 80% del contenedor padre */
    max-width: 400px;
    height: 100px;
    margin-bottom: 50px;
    /* Espacio entre los botones */
    font-size: 24px;
    font-weight: bold;
    color: #fff;
    cursor: pointer;
    border: none;
    outline: none;
    background-size: cover;
    border-radius: 10px;
    display: flex;
    /* Añadido */
    align-items: center;
    /* Añadido */
    justify-content: center;
    /* Añadido */
    text-decoration: none;
    /* Añadido */
}

dietas-button {
    margin-top: 2.6em;
    background-image: linear-gradient(to right, #ff7300, #FFA500);
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    background-position: center;
    font-size: 2.2em;
    color: #474747;
}

rutinas-button {
    background-image: linear-gradient(to right, #ff7300, #FFA500);
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    background-position: center;
    font-size: 2.2em;
    color: #474747;
}

usuarios-button {
    background-image: linear-gradient(to right, #ff7300, #FFA500);
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    background-position: center;
    font-size: 2.2em;
    color: #474747;
    text-align: center;
    /* Añadido */
    display: flex;
    /* Añadido */
    align-items: center;
    /* Añadido */
    justify-content: center;
    /* Añadido */
    text-decoration: none;
    /* Añadido */
}

navBar {
    position: fixed;
    width: 100%;
}

button {
    margin: 5px;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}
</style>
