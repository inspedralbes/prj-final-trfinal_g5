<template>
  <nav class="navbar">
    <div class="navbar-container">
      <div class="navbar-links">
        <nuxt-link class="navbar-link" href="/dieta"><img src="../public/diet_full_white.png" alt="Dieta"></nuxt-link>
        <nuxt-link class="navbar-link" href="/rutina"><img src="../public/rutina_full_white.png" alt="Rutina"></nuxt-link>
        <nuxt-link class="navbar-link" href="/home"><img src="../public/dumbbell_white.png" alt="Home"></nuxt-link>
        <nuxt-link class="navbar-link" href="/chatUsuaris"><img src="../public/chat_full_white.png" alt="Chat"></nuxt-link>
        <nuxt-link class="navbar-link" href="/chatia"><img src="../public/chatgpt_full_white.png" alt="Chatgpt"></nuxt-link>
      </div>
    </div>
  </nav>
</template>

<style scoped>
.navbar {
  background-color: #333;
  color: white;
  width: 90%;
  padding: 10px; /* Modificado para ajustar el espacio vertical */
  margin: auto;
  margin-bottom: 20px;
  display: flex;
  justify-content: center; /* Centra los elementos horizontalmente */
  position: sticky;
  top: 0;
  border-radius: 30px;
  z-index: 1000;

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
  margin: auto;
}

.navbar-link {
  color: white;
  text-decoration: none;
  margin: 0 15px; /* Añade espacio entre los enlaces */
  text-align: center;
}

.navbar-link:hover {
  text-decoration: underline;
}

img{
  width: 60%;
  text-align: center;
}
</style>
