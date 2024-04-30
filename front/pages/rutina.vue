<template>

    <body>
        <div class="flex-container">
            <capçalera />
            <div class="main-content">
                <div class="exercise-list">
                    <h1>Rutina</h1>
                    <button class="dieta-button" @click="incrementSelectedDay">-></button>

                    <div v-for="exercise in exercises" :key="exercise.id">
                        <h2>{{ exercise.nom_exercici }}</h2>
                        <div class="exercise-item">
                            <img :src="exercise.image" :alt="exercise.nom_exercici" class="exercise-image" />
                            <div class="exercise-details">
                                <p class="exercise-info">Día: {{ exercise.dia }}</p>
                                <p class="exercise-info">Series: {{ exercise.series }}</p>
                                <p class="exercise-info">Repeticiones: {{ exercise.repeticions }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="dieta-button" @click="redirectTo('/chatRutina')">Crear Rutina</button>
        </div>
        <navBar />
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
            exercises: []
        }
    },
    mounted() {
        // Recuperar el nombre de usuario del almacenamiento local y asignarlo a la variable usuario
        this.usuario = localStorage.getItem('username');
        this.idUsuari = useUsuariPerfilStore().id_usuari;
        console.log(this.idUsuari);
        this.obtenirRutina(this.idUsuari);
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
        incrementSelectedDay() {
            // Sumar 1 al día seleccionado
            if (this.selectedDay < '5') {
                this.selectedDay = String(parseInt(this.selectedDay) + 1);
                // Volver a obtener la rutina para mostrar los ejercicios del nuevo día seleccionado
                this.obtenirRutina(this.idUsuari);
            } else{
                this.selectedDay = '1';
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
    margin: auto;
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

.exercise-info {
    font-size: 16px;
    margin-bottom: 5px;
}

.dieta-button {
    width: 160%;
    /* Ancho del 80% del contenedor padre */
    max-width: 400px;
    height: 100px;
    margin-top: 50px;
    margin-bottom: 50px;
    /* Espacio entre los botones */
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
}
</style>
