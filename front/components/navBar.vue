<template>
  <nav class="navbar">
    <div class="navbar-container">
      <div class="navbar-links">
        <nuxt-link class="navbar-link" href="/dieta"><img src="../public/diet_white.png" alt="Dieta"></nuxt-link>
        <nuxt-link class="navbar-link" href="/rutina"><img src="../public/rutina_white.png" alt="Dieta"></nuxt-link>
        <nuxt-link class="navbar-link" href="/home"><img src="../public/dumbbell_white.png" alt="Dieta"></nuxt-link>
        <nuxt-link class="navbar-link" href="/joc"><img src="../public/actividad.png" alt="Dieta"></nuxt-link>
        <nuxt-link class="navbar-link" href="/chatia"><img src="../public/chatgpt.png" alt="Dieta"></nuxt-link>
      </div>
    </div>
  </nav>
</template>

<style scoped>
.navbar {
  background-color: #333;
  color: white;
  width: 100%;
  padding: 10px 0; /* Modificado para ajustar el espacio vertical */
  margin: auto;
  display: flex;
  justify-content: center; /* Centra los elementos horizontalmente */
  position: sticky;
  top: 0;
}

.navbar-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.navbar-brand {
  font-size: 1.5rem;
  margin-left: 25px;
}

.navbar-links {
  display: flex;
  justify-content: center; /* Centra los enlaces horizontalmente */
}

.navbar-link {
  color: white;
  text-decoration: none;
  margin: 0 15px; /* Añade espacio entre los enlaces */
  
}

.navbar-link:hover {
  text-decoration: underline;
}

img{
  height: 50px;
  width: 50px;
}
</style>
