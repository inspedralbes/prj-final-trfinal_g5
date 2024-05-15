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
                <button class="borrar-button" v-if="fechaSeleccionada && dietas.length > 0" @click="borrarDietaSeleccionada()">Borrar Dieta</button>
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
    async mounted() {
        const store = useUsuariPerfilStore();
        const idUsuario = store.usuariID_consulta;
        this.obtenirDieta(idUsuario);
    },
    methods: {
        obtenirDieta(idUsuario) {
            getDieta(idUsuario)
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
                let fecha = new Date(dieta.data_inici).toISOString().split('T')[0]; // Formato YYYY-MM-DD
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
        },
        async borrarDietaSeleccionada() {
            try {
                const store = useUsuariPerfilStore();
                const idUsuario = store.usuariID_consulta;
                const fecha = this.fechaSeleccionada;
                if (idUsuario && fecha) {
                    await deleteDietaByDate(idUsuario, fecha);
                    this.$router.push('/admin/usuaris'); 
                } else {
                    console.error('No hay fecha o usuario seleccionados para borrar');
                }
            } catch (error) {
                console.error('Error al borrar la dieta:', error);
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
    margin-left: 35%;
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
    width: 25%;
    position: fixed;
    top: 90px;
    bottom: 50px;
    overflow-y: auto;
}

.main-content {
    margin-left: 170px;
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
</style>
