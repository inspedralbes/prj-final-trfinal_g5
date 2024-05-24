<template>
    <body>
      <div class="flex-container">
        <capçalera />
        <h1>Administració</h1>
        <div class="button-container">
          <button class="large-button usuarios-button" @click="redirectTo('/admin/usuaris')">
            Usuaris
          </button>
        </div>
        <navBar />
      </div>
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
  
  .page-enter-active,
  .page-leave-active {
    transition: all 0.4s;
  }
  
  .page-enter-from,
  .page-leave-to {
    opacity: 0;
    filter: blur(1rem);
  }
  
  .flex-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100vh;
    /* Mínimo 100% de la altura de la ventana */
    background-color: #FFF;
    position: relative;
  }
  
  .button-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 80%;
    /* Empuja hacia abajo los botones */
  }
  
  .large-button {
    position: relative;
    /* Añade posición relativa al botón */
    width: 100%;
    /* Ancho del 80% del contenedor padre */
    max-width: 400px;
    height: 100px;
    margin-bottom: 50px;
    /* Espacio entre los botones */
    font-size: 24px;
    font-weight: bold;
    color: #fff;
    cursor: pointer;
    border: none;
    outline: none;
    background-size: cover;
    border-radius: 10px;
    display: flex;
    /* Añadido */
    align-items: center;
    /* Añadido */
    justify-content: center;
    /* Añadido */
    text-decoration: none;
    /* Añadido */
  }
  
  .dietas-button {
    margin-top: 2.6em;
    background-image: linear-gradient(to right, #ff7300, #FFA500);
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    background-position: center;
    font-size: 2.2em;
    color: #474747;
  }
  
  .rutinas-button {
    background-image: linear-gradient(to right, #ff7300, #FFA500);
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    background-position: center;
    font-size: 2.2em;
    color: #474747;
  }
  
  .usuarios-button {
    background-image: linear-gradient(to right, #ff7300, #FFA500);
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    background-position: center;
    font-size: 2.2em;
    color: #474747;
    text-align: center;
    /* Añadido */
    display: flex;
    /* Añadido */
    align-items: center;
    /* Añadido */
    justify-content: center;
    /* Añadido */
    text-decoration: none;
    /* Añadido */
  }
  
  navBar {
    position: fixed;
    width: 100%;
  }
  </style>
  