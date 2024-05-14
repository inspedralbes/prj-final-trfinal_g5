<template>
    <body>
      <div class="flex-container">
        <capçalera />
        <h1>Rutina</h1>
        <div v-if="exercises.length != 0" class="botons-superior">
          <Icon
            class="arrow"
            @click="decrementSelectedDay"
            name="ic:baseline-arrow-circle-left"
          />
          <div class="day-selector">
            <select v-model="selectedDay" @change="obtenirRutina(idUsuari)">
              <option v-for="day in dies" :value="day">{{ 'Día ' + day }}</option>
            </select>
          </div>
          <Icon
            class="arrow"
            @click="incrementSelectedDay"
            name="ic:baseline-arrow-circle-right"
          />
        </div>
        <div class="timer-container">
          <div class="timer">
            <span>Temps de descans</span>
            <div class="time-adjust-container">
              <div class="time-adjust">
                <button class="time-adjust-button" @click="adjustTime(10)">+</button>
                <span>{{ formatTime(timerSeconds) }}</span>
                <button class="time-adjust-button" @click="adjustTime(-10)">-</button>
              </div>
            </div>
          </div>
          <div class="timer-buttons">
            <button class="timer-button" @click="startTimer">Iniciar</button>
            <button class="timer-button" @click="pauseTimer" :disabled="!timerRunning">Pausa</button>
            <button class="timer-button" @click="resetTimer">Reiniciar</button>
          </div>
        </div>
        <div v-if="loading" class="loading">
          <img
            src="@/public/dumbbell_white.png"
            alt="Loading..."
            class="loading-image"
          />
        </div>
        <div id="rutinaBuida" v-if="exercises.length == 0 && !loading">
          <p>No hay datos de rutina disponibles. Haz clic en el botón para crear una rutina.</p>
          <button class="dieta-button" @click="redirectTo('/chatRutina')">Crear Rutina</button>
        </div>
        <div v-else class="main-content">
          <div class="exercise-list">
            <div v-for="exercise in exercises" :key="exercise.id">
              <div class="exercise-item">
                <img
                  :src="exercise.image"
                  :alt="exercise.nom_exercici"
                  class="exercise-image"
                />
                <h2>{{ exercise.nom_exercici }}</h2>
                <div class="exercise-details">
                  <Icon class="" name="ic:baseline-insert-invitation" /> Día:
                  {{ exercise.dia }} <br /> <br />
                  <Icon class="" name="ic:baseline-fitness-center" />Series:
                  {{ exercise.series }} <br /> <br />
                  <Icon class="" name="ic:baseline-cached" />Repeticiones:
                  {{ exercise.repeticions }}
                </div>
                <div class="exercise-controls">
                  <div class="series-buttons">
                    <button
                      v-for="serie in [1, 2, 3, 4]"
                      :key="serie"
                      @click="setSerieBase(exercise.id, serie)"
                      :class="['series-button', { 'selected': isSerieSelected(exercise.id, serie) }]"
                    >
                      {{ serie }}
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <navBar />
      </div>
    </body>
  </template>  

<script>
import { useUsuariPerfilStore } from '@/stores/index';
import { getRutina } from '@/stores/communicationManager';

export default {
    data() {
        return {
            usuario: '',
            idUsuari: '',
            selectedDay: '1',
            exercises: [],
            dies: [],
            loading: true,
            timerSeconds: 120, // 2 minutos
            timerRunning: false,
            timerInterval: null,
            selectedSeries: {} // Para almacenar las series seleccionadas
        }
    },
    computed: {
        availableDays() {
            return [...new Set(this.exercises.map(exercise => exercise.dia))];
        }
    },
    mounted() {
        this.idUsuari = useUsuariPerfilStore().id_usuari;
        console.log(this.idUsuari);
        this.obtenirRutina(this.idUsuari);
        this.obtenirDies(this.idUsuari);
    },
    methods: {
        redirectTo(page) {
            this.$router.push(page);
            console.log("Redirecting to:", page);
        },
        adjustTime(seconds) {
            if (!this.timerRunning) {
                this.timerSeconds += seconds;
                if (this.timerSeconds < 0) {
                    this.timerSeconds = 0;
                }
            }
        },
        startTimer() {
            if (!this.timerRunning) {
                this.timerRunning = true;
                this.timerInterval = setInterval(() => {
                    if (this.timerSeconds > 0) {
                        this.timerSeconds--;
                    } else {
                        clearInterval(this.timerInterval);
                        this.timerRunning = false;
                        console.log("¡El temporizador ha finalizado!");
                    }
                }, 1000);
            }
        },
        pauseTimer() {
            clearInterval(this.timerInterval);
            this.timerRunning = false;
        },
        resetTimer() {
            clearInterval(this.timerInterval);
            this.timerSeconds = 120;
            this.timerRunning = false;
        },
        formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const remainingSeconds = seconds % 60;
            return `${minutes}:${remainingSeconds < 10 ? '0' : ''}${remainingSeconds}`;
        },
        setSerieBase(exerciseId, serie) {
            this.selectedSeries[exerciseId] = serie;
            console.log("Serie base seleccionada para ejercicio", exerciseId, ":", serie);
        },
        isSerieSelected(exerciseId, serie) {
            return this.selectedSeries[exerciseId] === serie;
        },
        redirectToPage(page) {
            this.idUsuari = useUsuariPerfilStore().id_usuari;
            if (confirm("Si crees una rutina nova, la rutina actual s'eliminarà. ¿Estàs segur?")) {
                borrarRutina(this.idUsuari)
                    .then((response) => {
                        console.log(response);
                        this.$router.push(page);
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            }
        },
        obtenirRutina(idUsuari) {
            getRutina(idUsuari)
                .then((response) => {
                    console.log("Datos de rutina recibidos:", response);
                    console.log("Día seleccionado:", this.selectedDay);
                    console.log("¿Es response un array?", Array.isArray(response));
                    response.forEach(exercise => console.log("Ejercicio:", exercise));
                    const selectedDayString = this.selectedDay.toString();
                    this.exercises = response.filter(exercise => exercise.dia == selectedDayString);
                    console.log("Ejercicios filtrados:", this.exercises);
                })
                .catch((error) => {
                    console.error(error);
                })
                .finally(() => {
                    this.loading = false;
                    console.log("Loading:", this.loading);
                });
        },
        obtenirDies(idUsuari) {
            getRutina(idUsuari)
                .then((response) => {
                    this.dies = [...new Set(response.map(exercise => exercise.dia))];
                    console.log(this.dies);
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        incrementSelectedDay() {
            if (this.selectedDay < '5') {
                this.selectedDay = String(parseInt(this.selectedDay) + 1);
                this.obtenirRutina(this.idUsuari);
            } else {
                this.selectedDay = '1';
                this.obtenirRutina(this.idUsuari);
            }
        },
        decrementSelectedDay() {
            if (this.selectedDay > '1') {
                this.selectedDay = String(parseInt(this.selectedDay) - 1);
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
html,
body {
  margin: 0;
  padding: 0;
  height: 100vh;
  overflow-x: hidden;
}

/* Timer CSS */
.time-adjust {
  display: flex;
  align-items: center;
}

.time-adjust-button {
  width: 20px;
  height: 20px;
  font-size: 14px;
  margin-left: 5px;
  cursor: pointer;
}

.timer-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 20px;
  margin-bottom: 20px;
}

.timer {
  text-align: center;
}

.timer span {
  font-size: 30px;
}

.time-adjust-container {
  display: flex;
  justify-content: center;
}

.timer-buttons {
  margin-top: 10px;
}

.series-button {
  cursor: pointer;
  background-color: #e6e6e6; /* Color inicial del botón */
  border: none; /* Estilo de borde */
  padding: 10px; /* Relleno interno */
  margin: 5px; /* Margen entre botones */
  border-radius: 5px; /* Bordes redondeados */
}

.series-button.selected {
  background-color: #fa0000;
  color: #fff;
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
  height: 100vh;
  background-color: #fff;
}

.flex-container h1 {
  margin-top: -10px;
  margin-bottom: 20px;
  font-size: 36px;
  font-weight: bold;
}

.main-content {
  flex-grow: 1;
  overflow-y: auto;
  padding-top: 10px;
  padding-bottom: 50px;
  text-align: center;
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
  padding-bottom: 20px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  width: 100%;
}

.dieta-button {
  position: relative;
  width: 120%;
  max-width: 200px;
  height: 80px;
  margin-top: 50px;
  font-size: 1.5em;
  font-weight: bold;
  color: #fff;
  cursor: pointer;
  border: none;
  outline: none;
  background-size: cover;
  border-radius: 10px;
  background-image: linear-gradient(to right, #ff7300, #ffa500);
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
  background-position: center;
}

.loading {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
}

.loading-image {
  width: 100px;
  height: auto;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
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

#rutinaBuida {
  text-align: center;
  margin-top: 20px;
  padding: 20px;
}

@media screen and (max-width: 790px) {
  .exercise-item {
    width: 70%;
  }
}
</style>

