<template>
    <body>
        <div class="flex-container">
            <div class="header-container">
                <img src="../public/usuario.png" alt="Usuario" class="user-icon" />
                <h1 class="title">Benvingut {{ usuario }}</h1>
            </div>
            <div class="main-content">
                <div class="exercise-list">
                    <h1>Dia de pecho</h1>
                    <div v-for="exercise in selectedDayExercises" :key="exercise.id" class="exercise-item">
                        <img :src="exercise.image" :alt="exercise.name" class="exercise-image" />
                        <div class="exercise-details">
                            <h2 class="exercise-name">{{ exercise.name }}</h2>
                            <p class="exercise-info">Series: {{ exercise.series }}</p>
                            <p class="exercise-info">Repeticiones: {{ exercise.reps }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <navBar />
    </body>
</template>

<script>
export default {
    data() {
        return {
            selectedDay: 'pecho', // Aquí puedes establecer el día inicial seleccionado
            exercises: {
                pecho: [
                    { id: 1, name: 'Press de banca', series: 4, reps: 10, image: '/rutina/press_banca.jpg' },
                    { id: 1, name: 'Press inclinado', series: 4, reps: 10, image: '/rutina/press_inclinado.jpg' },
                    { id: 1, name: 'Peck Deck', series: 4, reps: 10, image: '/rutina/peck_deck.jpg' },
                    { id: 2, name: 'Fondos en paralelas', series: 3, reps: 12, image: '/rutina/fondos_paralelas.jpg' },
                    { id: 1, name: 'Hex press', series: 4, reps: 12, image: '/rutina/hex_press.jpg' },
                    { id: 2, name: 'Pull-over', series: 3, reps: 15, image: '/rutina/pull_over.jpg' },
                    // Añade más ejercicios de pecho si es necesario
                ],
                espalda: [
                    { id: 1, name: 'Dominadas', series: 4, reps: 8, rest: '90s', image: '../public/dominadas.jpg' },
                    { id: 2, name: 'Remo con barra', series: 3, reps: 10, rest: '60s', image: '../public/remo_barra.jpg' },
                    // Añade más ejercicios de espalda si es necesario
                ],
                // Añade más días y ejercicios según sea necesario
            }
        }
    },
    computed: {
        selectedDayExercises() {
            return this.exercises[this.selectedDay] || [];
        }
    },
    methods: {
        redirectTo(page) {
            this.$router.push(page);
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
    font-family: Arial, sans-serif;
    /* Establecer la fuente predeterminada */
    padding-bottom: 50px;
    /* Altura del navBar */
}

.flex-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100%;
    /* Mínimo 100% de la altura de la ventana */
    background-color: #FFF;
}

.header-container {
    background-color: #FFA500;
    display: flex;
    align-items: center;
    padding: 1rem;
    width: 100%;
    padding-left: 12%;
    padding-top: 25px;
    padding-bottom: 25px;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
    position: fixed;
    top: 0;
    z-index: 1;
}

.user-icon {
    width: 40px;
    height: 40px;
    margin-right: 10px;
}

.title {
    font-weight: bold;
    font-size: 24px;
}

.main-content {
    flex-grow: 1;
    overflow-y: auto;
    /* Habilita el scroll si el contenido es más grande que la ventana */
    padding-top: 120px;
    /* Altura del header */
    padding-bottom: 50px;
    /* Altura del navBar */
}

.exercise-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    padding: 20px;
}

.exercise-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: #e6e6e6;
    border-radius: 10px;
    padding: 20px;
    width: calc(50% - 20px);
    /* Ajuste para dos columnas */
    box-sizing: border-box;
}

.exercise-image {
    width: 130px;
    height: 130px;
    object-fit: cover;
    border-radius: 10px;
}

.exercise-details {
    text-align: center;
}

.exercise-name {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
}

.exercise-info {
    font-size: 16px;
    margin-bottom: 5px;
}

navBar {
    position: fixed;
    bottom: 0;
    width: 100%;
    z-index: 1;
}

/* Media query para pantallas más pequeñas */
@media screen and (max-width: 790px) {
    .exercise-item {
        width: calc(50% - 20px);
        /* Ajuste para dos columnas en pantallas más pequeñas */
    }
}</style>