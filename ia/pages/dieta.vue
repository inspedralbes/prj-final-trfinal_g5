<template>

    <body>
        <div class="flex-container">
            <capçalera />
            <div class="meal-container">
                <h2 class="meal-type">Desayuno</h2>
                <div class="meal-item">
                    <h3 class="meal-name">Avena con frutas</h3>
                    <p class="calories">300 calorías</p>
                </div>
                <div class="meal-item">
                    <h3 class="meal-name">Tostadas integrales con aguacate</h3>
                    <p class="calories">250 calorías</p>
                </div>
                <!-- Agrega más opciones de desayuno saludable aquí -->

                <h2 class="meal-type">Comida</h2>
                <div class="meal-item">
                    <h3 class="meal-name">Ensalada de quinoa</h3>
                    <p class="calories">350 calorías</p>
                </div>
                <div class="meal-item">
                    <h3 class="meal-name">Pechuga de pollo a la plancha con verduras</h3>
                    <p class="calories">400 calorías</p>
                </div>
                <h2 class="meal-type">Merienda</h2>
                <!-- Contenido de la merienda -->
                <div class="meal-item">
                    <h3 class="meal-name">Yogur con frutas</h3>
                    <p class="calories">200 calorías</p>
                </div>
                <div class="meal-item">
                    <h3 class="meal-name">Avena con leche</h3>
                    <p class="calories">105 calorías</p>
                </div>
                <!-- Agrega más opciones de merienda aquí -->

                <h2 class="meal-type">Cena</h2>
                <!-- Contenido de la cena -->
                <div class="meal-item">
                    <h3 class="meal-name">Salmón al horno con verduras</h3>
                    <p class="calories">400 calorías</p>
                </div>
                <div class="meal-item">
                    <h3 class="meal-name">Arroz con pollo</h3>
                    <p class="calories">360 calorías</p>
                </div>
            </div>
            <button class="dieta-button" @click="redirectTo('chatDieta')">Crear Dieta</button>
        </div>
        <navBar />
    </body>
</template>

<script>
export default {
    data() {
        return {
            usuario: '' // Cambia esto por el nombre de usuario real o hazlo dinámico si es necesario
        };
    },
    mounted() {
        // Recuperar el nombre de usuario del almacenamiento local y asignarlo a la variable usuario
        this.usuario = localStorage.getItem('username');


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
}

.flex-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100%;
    /* Mínimo 100% de la altura de la ventana */
    background-color: #FFF;
}

.meal-container {
    width: 80%;
    max-width: 600px;
    margin-top: 20px;
    overflow-y: auto; /* Agrega barra de desplazamiento vertical si el contenido es más largo que la pantalla */
}

.meal-type {
    font-size: 28px;
    font-weight: bold;
    margin-top: 20px;
}

.meal-item {
    background-color: #f0f0f0;
    border-radius: 10px;
    padding: 10px;
    margin-top: 10px;
}

.meal-name {
    font-size: 20px;
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
.calories {
    font-size: 16px;
    color: #666;
}

navBar {
    width: 100%;
    position: fixed;
    bottom: 0; /* Fija la barra de navegación en la parte inferior */
    background-color: #333;
    color: white;
    padding: 10px;
    text-align: center;
}
</style>

