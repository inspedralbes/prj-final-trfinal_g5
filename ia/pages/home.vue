<template>

  <body>
      <div class="flex-container">
          <capçalera />
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
