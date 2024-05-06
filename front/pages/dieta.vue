<template>
    <body>
        <div>
            <div v-for="(apat, index) in dietas" :key="index">
                <h2 class="meal-type">{{ apat.apat }}</h2>
                <div class="meal-container">
                    <div v-for="(comida, comidaIndex) in apat.comidas" :key="comidaIndex" class="meal-item">
                        <h3 class="meal-name">{{ comida.nom_plat }}</h3>
                        <p class="calories">Calorías: {{ comida.calories }}</p>
                        <!-- Aquí puedes mostrar otros detalles de la comida si lo deseas -->
                    </div>
                </div>
            </div>
        </div>
    </body>
</template>

<script>
import { useUsuariPerfilStore } from '@/stores/index';
import { getDieta } from '@/stores/communicationManager';

export default {
    data() {
        return {
            dietas: []
        };
    },
    methods: {
        
        async obtenirDieta(idUsuari) {
            // Obtener la dieta del usuario actual
            const dieta = await getDieta(idUsuari);
            this.dietas = dieta;
        },
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
    overflow-y: auto;
    /* Agrega barra de desplazamiento vertical si el contenido es más largo que la pantalla */
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
    bottom: 0;
    /* Fija la barra de navegación en la parte inferior */
    background-color: #333;
    color: white;
    padding: 10px;
    text-align: center;
}
</style>
