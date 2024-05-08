<template>

    <body>
        <div class="flex-container">
            <capçalera />
            <h1>Dieta</h1>

            <!-- Mostrar mensaje para crear dieta si la base de datos está vacía -->
            <div v-if="dietas.length === 0 && !loading">
                <p>No hi han dades de dieta dispoibles. Clica el boto per generar una dieta.</p>
            </div>

            <!-- Mostrar spinner de carga mientras se cargan los datos -->
            <div v-if="loading" class="loading">
                <img src="@/public/dumbbell_white.png" alt="Loading..." class="loading-image" />
            </div>

            <dir v-else>
                <div v-if="dietas.length > 0">
                    <p>Desde {{ dietas[0].platos[0].data_inici }} hasta {{ dietas[0].platos[0].data_fi }}</p>
                </div>
                <div v-for="(comida, index) in dietas" :key="index">
                    <h2>{{ comida.apat }}</h2>
                    <div v-for="(plato, index) in comida.platos" :key="index" class="meal-item">
                        <h3 class="meal-name">{{ plato.nom_plat }}</h3>
                        <p class="calories">Calories: {{ plato.calories }}</p>
                        <p>Proteïnes: {{ plato.proteines }}</p>
                        <p>Carbohidrats: {{ plato.carbohidrats }}</p>
                        <p>Graixos: {{ plato.grases }}</p>
                        <p>Ingredients:</p>
                        <ul>
                            <li v-for="(ingredient, index) in plato.ingredients" :key="index">
                                {{ ingredient.quantitat }} {{ ingredient.unitat }} de {{ ingredient.nom_ingredient }}
                            </li>
                        </ul>
                    </div>
                </div>
            </dir>

            <button class="dieta-button" @click="redirectTo('/chatDieta')">Crear Dieta</button>
        </div>
        <navBar />
    </body>
</template>


<script>
import { useUsuariPerfilStore } from '@/stores/index';
import { getDieta } from '@/stores/communicationManager';

export default {
    data() {
        return {
            dietas: [],
            loading: true // Variable para controlar la carga de datos
        };
    },
    methods: {
        obtenirDieta(idUsuari) {
            getDieta(idUsuari)
                .then(response => {
                    console.log('Dieta:', response);
                    // Organizar los platos por tipo de comida
                    const comidas = {};
                    response.forEach(plato => {
                        if (!comidas.hasOwnProperty(plato.apat)) {
                            comidas[plato.apat] = [];
                        }
                        comidas[plato.apat].push(plato);
                    });
                    // Convertir el objeto en un array
                    this.dietas = Object.keys(comidas).map(apat => ({
                        apat: apat,
                        platos: comidas[apat].map(plato => ({
                            ...plato,
                            ingredients: JSON.parse(plato.ingredients)
                        }))
                    }));
                })
                .catch(error => {
                    console.error('Error al obtener la dieta:', error);
                })
                .finally(() => {
                    this.loading = false; // Marcar la carga de datos como completa
                });
        },
        redirectTo(page) {
            this.$router.push(page);
        }
    },
    mounted() {
        this.idUsuari = useUsuariPerfilStore().id_usuari;
        this.obtenirDieta(this.idUsuari);
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

.loading {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
}

.loading-image {
    width: 100px;
    /* Tamaño deseado para la imagen */
    height: auto;
    /* Mantener la proporción de aspecto */
    animation: spin 2s linear infinite;
    /* Animación de rotación */
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
