<template>
    <body>
        <div class="flex-container">
            <capçalera />
            <h1>Dietas</h1>
            <div class="sidebar">
                <ul>
                    <li v-for="(value, key) in dietasPorFecha" :key="key">
                        <button @click="toggleFechaSeleccionada(key)">{{ key }}</button>
                    </li>
                </ul>
            </div>
            <div class="main-content">
                <h2 v-if="fechaSeleccionada">{{ fechaSeleccionada }}</h2>
                <div v-for="dieta in dietas" :key="dieta.id" v-if="fechaSeleccionada">
                    <div class="exercise-item">
                        <h3>{{ dieta.nom_plat }}</h3>
                        <p>Calorías: {{ dieta.calories }}</p>
                        <p>Proteínas: {{ dieta.proteines }}</p>
                        <p>Carbohidratos: {{ dieta.carbohidrats }}</p>
                        <p>Greixos: {{ dieta.grases }}</p>
                    </div>
                </div>
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
            dietasPorFecha: {},
            dietas: [],
            loading: true,
            fechaSeleccionada: null
        }
    },
    mounted() {
        this.idUsuari = useUsuariPerfilStore().id_usuari;
        this.obtenirDieta(this.idUsuari);
    },
    filters: {
        dateFormat(value) {
            return new Date(value).toLocaleDateString();
        }
    },
    methods: {
        obtenirDieta(idUsuari) {
            getDieta(idUsuari)
                .then((dietas) => {
                    this.dietasPorFecha = this.agruparPorFecha(dietas);
                    this.loading = false;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        agruparPorFecha(dietas) {
            return dietas.reduce((acc, dieta) => {
                let fecha = new Date(dieta.data_inici).toDateString();
                if (!acc[fecha]) {
                    acc[fecha] = [];
                }
                acc[fecha].push(dieta);
                return acc;
            }, {});
        },
        toggleFechaSeleccionada(key) {
            this.fechaSeleccionada = this.fechaSeleccionada === key ? null : key;
            if (this.fechaSeleccionada) {
                this.dietas = this.dietasPorFecha[this.fechaSeleccionada];
            } else {
                this.dietas = [];
            }
        }
    }
}
</script>



<style scoped>
html,
body {
    margin: 0;
    padding: 0;
    height: 100vh;
    overflow: hidden;
}

h1 {
    margin-left: 170px;
}

.day-selector {
    display: flex;
    justify-content: center;
    margin-top: 10px;
    margin-bottom: 10px;
}

button {
    margin: 0 5px;
}

.flex-container {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.capçalera,
.navBar {
    width: 100%;
    padding: 10px 20px;
    text-align: center;
    background-color: #333;
    color: white;
}

ul {
    list-style-type: none;
    padding: 0;
}

.sidebar {
    background-color: #f4f4f4;
    padding: 10px;
    width: 27%;
    /* más estrecho */
    position: fixed;
    top: 90px;
    bottom: 50px;
    overflow-y: auto;
}

.main-content {
    margin-left: 170px;
    /* ajustado al nuevo ancho de la sidebar */
    flex-grow: 1;
    padding: 20px;
    overflow-y: auto;
    position: relative;
    height: calc(100vh - 100px);
}

.navBar {
    position: fixed;
    bottom: 0;
}

.exercise-item {
    background-color: #fff;
    border-radius: 8px;
    padding: 10px;
    margin-bottom: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.exercise-image {
    width: 100%;
    border-radius: 8px;
}

button {
    width: 100%;
    padding: 10px;
    margin-bottom: 5px;
    cursor: pointer;
    border: none;
    background-color: #e2e2e2;
    transition: background-color 0.3s;
    list-style-type: none;
    /* elimina el punto */

    &:hover {
        background-color: #d1d1d1;
    }
}
</style>
