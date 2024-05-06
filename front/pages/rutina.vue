<template>

    <body>
        <div class="flex-container">
            <capçalera />
            <h1>Rutina</h1>

            <div id="crearRutina" v-if="exercises.length === 0">
                <button class="dieta-button" @click="redirectTo('/chatRutina')">Crear Rutina</button>

            </div>

            <div v-else class="main-content">
                <div class="exercise-list">


                    <div class="botons-superior">
                        <Icon class="arrow" @click="decrementSelectedDay" name="ic:baseline-arrow-circle-left" />

                        <div class="day-selector">

                            <select v-model="selectedDay" @change="obtenirRutina(idUsuari)">
                                <option v-for="day in dies" :value="day">{{ 'Día ' + day }}</option>
                            </select>
                        </div>
                        <Icon class="arrow" @click="incrementSelectedDay" name="ic:baseline-arrow-circle-right" />


                    </div>




                    <div v-for="exercise in exercises" :key="exercise.id">
                        <div class="exercise-item">
                            <img :src="exercise.image" :alt="exercise.nom_exercici" class="exercise-image" />

                            <h2>{{ exercise.nom_exercici }}</h2>

                            <div class="exercise-details">
                                <Icon class="" @click="incrementSelectedDay" name="ic:baseline-insert-invitation" />
                                Día: {{ exercise.dia }} <br> <br>
                                <Icon class="" @click="incrementSelectedDay" name="ic:baseline-fitness-center" />Series:
                                {{ exercise.series }} <br> <br>
                                <Icon class="" @click="incrementSelectedDay" name="ic:baseline-cached" />Repeticiones:
                                {{ exercise.repeticions }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="dieta-button" @click="redirectTo('/chatRutina')">Crear nova Rutina</button>

        </div>
        <navBar />
    </body>
</template>

<script>
import { useUsuariPerfilStore } from '@/stores/index';
import { getRutina } from '@/stores/communicationManager';
import { faGithub } from '@fortawesome/free-brands-svg-icons';
import { faCircle, faAddressBook } from '@fortawesome/free-solid-svg-icons'


export default {
    data() {
        return {
            usuario: '',
            idUsuari: '',
            selectedDay: '1',
            exercises: [],
            dies: []
        }
    },
    computed: {
        availableDays() {
            // Obtener una lista de días disponibles en la rutina actual
            return [...new Set(this.exercises.map(exercise => exercise.dia))];
        }
    },
    mounted() {
        // Recuperar el nombre de usuario del almacenamiento local y asignarlo a la variable usuario
        this.usuario = localStorage.getItem('username');
        this.idUsuari = useUsuariPerfilStore().id_usuari;
        console.log(this.idUsuari);
        this.obtenirRutina(this.idUsuari);
        this.obtenirDies(this.idUsuari);
    },
    methods: {
        redirectTo(page) {
            this.$router.push(page);
        },
        obtenirRutina(idUsuari) {
            getRutina(idUsuari)
                .then((response) => {
                    console.log(response);
                    // Filtrar los ejercicios para mostrar solo los del día seleccionado
                    this.exercises = response.filter(exercise => exercise.dia === this.selectedDay);
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        obtenirDies(idUsuari) {
            getRutina(idUsuari)
                .then((response) => {
                    //console.log(response);
                    this.dies = [...new Set(response.map(exercise => exercise.dia))];
                    console.log(this.dies);
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        incrementSelectedDay() {
            // Sumar 1 al día seleccionado
            if (this.selectedDay < '5') {
                this.selectedDay = String(parseInt(this.selectedDay) + 1);
                // Volver a obtener la rutina para mostrar los ejercicios del nuevo día seleccionado
                this.obtenirRutina(this.idUsuari);
            } else {
                this.selectedDay = '1';
                this.obtenirRutina(this.idUsuari);
            }

        },

        decrementSelectedDay() {
            // Restar 1 al día seleccionado
            if (this.selectedDay > '1') {
                this.selectedDay = String(parseInt(this.selectedDay) - 1);
                // Volver a obtener la rutina para mostrar los ejercicios del nuevo día seleccionado
                this.obtenirRutina(this.idUsuari);
            } else {
                this.selectedDay = '5';
                this.obtenirRutina(this.idUsuari);
            }
        }
    }
}
</script>

<style scoped>
/* Estilos de los divs en el componente */
html,
body {
    margin: 0;
    padding: 0;
    height: 100%;
    overflow-x: hidden;
    /* Evita el desplazamiento horizontal */
}

body {
    /* Establecer la fuente predeterminada */
    padding-bottom: 50px;
    /* Altura del navBar */
}

.arrow {
    width: 50px;
    height: 50px;
    margin: auto;
    color: #000;
}

.flex-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100%;
    /* Mínimo 100% de la altura de la ventana */
    background-color: #FFF;
}

.flex-container h1 {
    margin-top: 20px;
    margin-bottom: 20px;
    font-size: 36px;
    font-weight: bold;
}


.main-content {
    flex-grow: 1;
    overflow-y: auto;
    /* Habilita el scroll si el contenido es más grande que la ventana */
    padding-top: 10px;
    /* Altura del header */
    padding-bottom: 50px;
    /* Altura del navBar */

}

.exercise-list {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
    padding: 20px;
    margin: auto;
    text-align: center;
    border-radius: 15px;
    width: 80%;
}

.exercise-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: #e6e6e6;
    border-radius: 10px;
    padding: 20px;
    width: 60%;
    box-sizing: border-box;
    margin: auto;
}

.exercise-image {
    width: 100%;
    height: 70%;
    object-fit: cover;
    border-radius: 10px;
}

.exercise-details {
    text-align: center;
}

.exercise-info {
    font-size: 16px;
    margin-bottom: 5px;
}

.botons-superior {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 20px;
    margin: auto;
    border-radius: 15px;
}

.dieta-button {
    position: relative;
    width: 60%;
    height: 60px;
    margin-bottom: 50px;
    font-size: 1.5em;
    font-weight: bold;
    color: #fff;
    cursor: pointer;
    border: none;
    outline: none;
    background-size: cover;
    border-radius: 10px;
    background-image: linear-gradient(to right, #ff7300, #FFA500);
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    background-position: center;
    color: #474747;

}

.dia-button {
    width: 50px;
    height: 50px;
    margin-top: 10px;
    margin-bottom: 10px;
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
    border: none;
    outline: none;
    background-size: cover;
    border-radius: 10px;
    background-position: center;
    font-size: 30px;
    color: #000;
    background-color: #666;
    margin: auto;

}

navBar {
    position: fixed;
    bottom: 0;
    width: 100%;
    z-index: 1;
}

.day-selector {
    display: flex;
    align-items: center;
    margin: auto;

}

.day-selector select {
    padding: 10px;
    font-size: 16px;
    border-radius: 5px;
}

#crearRutina {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin-top: 20px;
}

/* Media query para pantallas más pequeñas */
@media screen and (max-width: 790px) {
    .exercise-item {
        width: 70%;
        /* Ajuste para dos columnas en pantallas más pequeñas */
    }
}
</style>
