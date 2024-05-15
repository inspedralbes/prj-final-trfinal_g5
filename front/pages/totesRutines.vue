<template>
    <body>
        <div class="flex-container">
            <capçalera />
            <h1>Rutina</h1>
            <div class="sidebar">
                <ul>
                    <li v-for="(value, key) in rutinasPorFecha" :key="key">
                        <button @click="toggleFechaSeleccionada(key)">{{ key }}</button>
                    </li>
                </ul>
            </div>
            <div class="main-content">
                <h2 v-if="fechaSeleccionada">{{ fechaSeleccionada }}</h2>
                <div class="day-selector">
                    <button @click="decrementSelectedDay">Día Anterior</button>
                    <select v-model="selectedDay" @change="filtrarRutinasPorDia">
                        <option v-for="day in availableDays" :value="day">{{ 'Día ' + day }}</option>
                    </select>
                    <button @click="incrementSelectedDay">Día Siguiente</button>
                </div>
                <div v-for="rutina in exercises" :key="rutina.id" v-if="fechaSeleccionada">
                    <div class="exercise-item">
                        <img :src="rutina.image" alt="Imagen del ejercicio" class="exercise-image" />
                        <h3>{{ rutina.nom_exercici }}</h3>
                        <p>Día: {{ rutina.dia }}</p>
                        <p>Series: {{ rutina.series }}</p>
                        <p>Repeticiones: {{ rutina.repeticions }}</p>
                    </div>
                </div>
                <button class="borrar-button" v-if="fechaSeleccionada && exercises.length > 0" @click="borrarRutinaSeleccionada">Borrar Rutina</button>
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
            rutinasPorFecha: {},
            exercises: [],
            loading: true,
            fechaSeleccionada: null,
            selectedDay: 1,
            availableDays: []
        }
    },
    async mounted() {
        const store = useUsuariPerfilStore();
        const idUsuario = store.id_usuari;
        this.obtenirRutina(idUsuario);
    },
    computed: {
        availableDays() {
            if (this.fechaSeleccionada && Array.isArray(this.rutinasPorFecha[this.fechaSeleccionada])) {
                return [...new Set(this.rutinasPorFecha[this.fechaSeleccionada].map(rutina => rutina.dia))];
            }
            return [];
        }
    },
    methods: {
        obtenirRutina(idUsuario) {
            getRutina(idUsuario)
                .then((rutinas) => {
                    this.rutinasPorFecha = this.agruparPorFecha(rutinas);
                    this.loading = false;
                    this.filtrarRutinasPorDia();
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        agruparPorFecha(rutinas) {
            return rutinas.reduce((acc, rutina) => {
                let fecha = rutina.data;
                if (!acc[fecha]) {
                    acc[fecha] = [];
                }
                acc[fecha].push(rutina);
                return acc;
            }, {});
        },
        toggleFechaSeleccionada(key) {
            this.fechaSeleccionada = this.fechaSeleccionada === key ? null : key;
            this.filtrarRutinasPorDia();
        },
        filtrarRutinasPorDia() {
            if (this.fechaSeleccionada) {
                this.exercises = this.rutinasPorFecha[this.fechaSeleccionada].filter(rutina => rutina.dia === this.selectedDay.toString());
            }
        },
        incrementSelectedDay() {
            const maxDay = Math.max(...this.availableDays);
            if (this.selectedDay < maxDay) {
                this.selectedDay += 1;
            } else {
                this.selectedDay = Math.min(...this.availableDays);
            }
            this.filtrarRutinasPorDia();
        },
        decrementSelectedDay() {
            const minDay = Math.min(...this.availableDays);
            if (this.selectedDay > minDay) {
                this.selectedDay -= 1;
            } else {
                this.selectedDay = Math.max(...this.availableDays);
            }
            this.filtrarRutinasPorDia();
        },
        async borrarRutinaSeleccionada() {
            try {
                const store = useUsuariPerfilStore();
                const idUsuario = store.id_usuari;
                const fecha = this.fechaSeleccionada;
                if (idUsuario && fecha) {
                    await deleteRutinaByDate(idUsuario, fecha);
                    this.$router.push('/rutina'); 
                } else {
                    console.error('No hay fecha o usuario seleccionados para borrar');
                }
            } catch (error) {
                console.error('Error al borrar la rutina:', error);
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

    &:hover {
        background-color: #d1d1d1;
    }
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
