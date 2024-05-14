<template>
    <body>
        <div class="flex-container">
            <capçalera />
            <h1>Dieta</h1>            

            <!-- Mostrar spinner de carga mientras se cargan los datos -->
            <div v-if="loading" class="loading">
                <img src="@/public/dumbbell_white.png" alt="Loading..." class="loading-image" />
            </div>

            <div class="dieta" v-if="dietas.length === 0 && !loading">
                <p>No hi han dades de dieta disponibles. Clica el botó per generar una dieta.</p>
                <button class="dieta-button" @click="redirectTo('/chatDieta')">Crear Dieta</button>
            </div>

            <div class="main-content" v-if="dietas.length != 0 && !loading">
                <button class="historial-button" @click="redirectTo('/totesDietes')">Historial Dietes</button>

                <div id="data-dieta" v-if="dietas.length > 0">
                    <p>Desde {{ dietas[0].platos[0].data_inici }} hasta {{ dietas[0].platos[0].data_fi }}</p>
                </div>
                <div v-for="(comida, index) in dietas" :key="index">
                    <h2 id="apat">{{ comida.apat }}</h2>
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
                <button class="dieta-button" @click="redirectToPage('/chatDieta')">Nova Dieta</button>
            </div>

            <navBar />
        </div>
    </body>
</template>

<script>
import { useUsuariPerfilStore } from '@/stores/index';
import { getDieta, borrarDieta, borrarDietaHoy } from '@/stores/communicationManager';

export default {
    data() {
        return {
            dietas: [],
            loading: true, // Variable para controlar la carga de datos
            idUsuari: '' // Agregado para almacenar el id del usuario
        };
    },
    methods: {
        obtenirDieta(idUsuari) {
            getDieta(idUsuari)
                .then(response => {
                    console.log('Dieta:', response);
                    // Encontrar la dieta más reciente
                    const recentDate = Math.max(...response.map(plato => new Date(plato.data_inici).getTime()));
                    const recentDiet = response.filter(plato => new Date(plato.data_inici).getTime() === recentDate);

                    // Organizar los platos por tipo de comida
                    const comidas = {};
                    recentDiet.forEach(plato => {
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
        },
        async redirectToPage(page) {
            this.idUsuari = useUsuariPerfilStore().id_usuari;
            const existeDietaHoy = await this.obtenirDietaDeHoy(this.idUsuari);

            if (confirm("Si creas una nova dieta, la dieta actual s'eliminarà. ¿Estàs segur?")) {
                if (existeDietaHoy) {
                    await this.borrarDietaDeHoy(this.idUsuari);
                }
                this.$router.push(page);
            }
        },
        // async obtenirDietaDeHoy(idUsuari) {
        //     try {
        //         const response = await getDieta(idUsuari);
        //         const today = new Date().toISOString().split('T')[0]; // Obtener la fecha de hoy en formato YYYY-MM-DD
        //         return response.some(plato => new Date(plato.data_inici).toISOString().split('T')[0] === today);
        //     } catch (error) {
        //         console.error(error);
        //         return false;
        //     }
        // },
        // async borrarDietaDeHoy(idUsuari) {
        //     try {
        //         const response = await borrarDietaHoy(idUsuari);
        //         console.log('Dietas de hoy eliminadas:', response);
        //     } catch (error) {
        //         console.error('Error al eliminar las dietas de hoy:', error);
        //     }
        // },
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
    height: 100vh;
    overflow-x: hidden;
    /* Evita el desplazamiento horizontal */
}

.flex-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100vh;
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
    text-align: center;
}

.meal-item {
    width: 85%;
    background-color: #f0f0f0;
    border-radius: 10px;
    padding: 10px;
    margin-top: 10px;
    margin: auto;
}

.meal-name {
    font-size: 20px;
    margin-bottom: 5px;
}

.dieta {
    text-align: center;
    margin: auto;
}

.dieta-button {
    position: relative;
    width: 120%;
    /* Ancho del 80% del contenedor padre */
    max-width: 200px;
    height: 60px;
    margin-top: 50px;
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
}

.historial-button {
    position: relative;
    width: 100%;
    /* Ancho del 80% del contenedor padre */
    max-width: 240px;
    height: 60px;
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

#data-dieta {
    margin: auto;
    text-align: center;
}

#apat {
    margin: auto;
    text-align: center;
    margin-top: 40px;
    margin-bottom: 20px;
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
