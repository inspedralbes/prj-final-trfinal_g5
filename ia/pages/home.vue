<template>
  <body>
      <div class="flex-container">
          <div class="header-container">
              <img src="../public/usuario.png" alt="Usuario" class="user-icon" />
              <h1 class="title">Benvingut {{ usuario }}</h1>
          </div>
          <div class="button-container">
              <button class="large-button rutina-button" @click="redirectTo('rutina')">
                  Rutina
              </button>
              <button class="large-button dieta-button" @click="redirectTo('dieta')">
                  Dieta
              </button>
              <button class="large-button asesoramiento-button" @click="redirectTo('/chatia')">
                  Assesorament
              </button>
          </div>
      </div>
      <navBar />
  </body>
</template>
        

     
<script>
export default {
    data() {
        return {
            usuario: '' // Inicializamos usuario como una cadena vacía
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

.button-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    /* Empuja hacia abajo los botones */
}

.large-button {
    width: 160%;
    /* Ancho del 80% del contenedor padre */
    max-width: 400px;
    height: 100px;
    margin-bottom: 50px;
    /* Espacio entre los botones */
    font-size: 24px;
    font-weight: bold;
    color: #FFF;
    cursor: pointer;
    border: none;
    outline: none;
    background-size: cover;
    border-radius: 10px;
}

.rutina-button {
    margin-top: 2.6em;
    background-image: url('../public/rutina.jpg');
    background-position: center;
    font-size: 50px;
}

.dieta-button {
    background-image: url('../public/dieta.jpg');
    background-position: center;
    font-size: 50px;
    color: #000;
}

.asesoramiento-button {
    background-image: url('../public/asesorament.jpg');
    background-position: center;
    color: black;
    font-size: 30px;
    margin-bottom: 100%;
}

navBar {
    position: fixed;
    width: 100%;
}
</style>
