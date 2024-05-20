<template>
  <body>
    <div class="flex-container">
      <capçalera />
      <div class="logo">
        <img src="../public/logo_fithub_black_orange.png" alt="">

      </div>
      <div class="button-container">
        <div>
          <button class="large-button rutina-button" @click="redirectTo('rutina')">
            <div class="button-content">
              <div class="img-container">
                <img src="../public/rutina_full_orange.png" alt="">
              </div>
              <h1>Rutina</h1>
            </div>
          </button>
        </div>
        <div>
          <button class="large-button dieta-button" @click="redirectTo('dieta')">
            <div class="button-content">
              <div class="img-container">
                <img src="../public/diet_full_orange.png" alt="">
              </div>
              <h1>Dieta</h1>
            </div>
          </button>
        </div>
        <div>
          <button class="large-button asesoramiento-button" @click="redirectTo('/chatia')">
            <div class="button-content">
              <div class="img-container">
                <img src="../public/chatgpt_full_orange.png" alt="">
              </div>
              <h1>Asesoramiento</h1>
            </div>
          </button>
        </div>
        <div>
          <button v-if="tipus_usuari === 'admin'" class="large-button admin-button"
            @click="redirectTo(`/admin/${nom_usuari}`)">
            <div class="button-content">
              <div class="img-container">
                <img src="../public/settings_orange.png" alt="">
              </div>
              <h1>Admin</h1>
            </div>
          </button>
        </div>
      </div>
      <navBar />
    </div>
  </body>
</template>

<script>
import { useUsuariPerfilStore } from '@/stores/index';
export default {
  methods: {
    redirectTo(page) {
      this.$router.push(page);
    }
  },
  setup() {
    const store = useUsuariPerfilStore();
    return {
      tipus_usuari: store.tipus_usuari,
      nom_usuari: store.nom_usuari
    };
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
  width: 100%;
  margin: auto;
  /* Mínimo 100% de la altura de la ventana */
  background-color: #FFF;
  position: relative;
}


.logo {
  margin-top: 20px;
  width: 50%;
  display: flex;
  justify-content: center;
}

.logo img {
  width: 100%;
}
.button-container {
  display: grid;
  grid-template-columns: 1fr;
  grid-gap: 20px;
  width: 85%;
  margin: auto;
  /* Empuja hacia abajo los botones */
}

.large-button {
  background-image: linear-gradient(to right, #ff7300, #FFA500);
  color: #f0f0f0;
  border: none;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 1em;
  font-weight: bold;
  cursor: pointer;
  border-radius: 10px;
  width: 100%;
  margin: auto;
  padding: 20px;
  display: flex;
  align-items: center;
}

.button-content {
  display: grid;
  grid-template-columns: 1fr 3fr;
  align-items: center;
  width: 100%;
}

.img-container {
  width: 70px;
  height: 70px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: white;
  border-radius: 50%;
  box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);
  margin-right: 20px;
}

.img-container img {
  width: 50%;
}

.large-button h1 {
  font-size: 1.5em;
  margin: 0;
  word-wrap: break-word;
  text-align: left;
}

navBar {
  position: fixed;
  width: 100%;
}
</style>
