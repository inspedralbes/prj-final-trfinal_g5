<template>
    <body>
        <div class="flex-container">
            <div class="header-container">
                <img src="../public/usuario.png" alt="Usuario" class="user-icon" />
                <h1 class="title">Benvingut @usuari</h1>
            </div>
            <div>
                {/* Resto del contenido */}
                <div>


                </div>
            </div>
        </div>
    </body>
</template>

<script>
export default {

}
</script>

<style scoped>
/* Estilos de los divs en el componente */
html, body {
  margin: 0;
  padding: 0;
  height: 100%;
}

body {
  font-family: Arial, sans-serif; /* Establecer la fuente predeterminada */
}

.flex-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100vh;
    background-color: #FFF;
}

.header-container {
    position: sticky;
    top: 0;
    background-color: #FFA500;
    display: flex;
    align-items: center;
    padding: 1rem;
    width: 100%;
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
</style>