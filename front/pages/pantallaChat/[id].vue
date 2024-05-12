<template>
    <body>
        <div>
            <div class="contenedor">
                <!-- Cabecera del chat -->
                <div class="cabecera">
                    <!-- Mostrar nombre del usuario -->
                    
                    <!-- Mostrar foto de perfil del usuario -->
                    <img :src="'http://localhost:8000/storage/imagenes_perfil/' + usuario.foto_perfil" alt="Foto de perfil">
                    <p>{{ usuario.nom }}</p>
                </div>

                <div class="chat-container">
                    <!-- Contenido del chat -->
                </div>

                <!-- Controles inferiores -->
                <div class="controles-inferiores">
                    <textarea class="entrada-mensaje" placeholder="Escriu el teu missatge"></textarea>
                    <button class="boton-enviar">Enviar</button>
                </div>

                <!-- Navbar -->
                <navBar />
            </div>
        </div>
    </body>
</template>

<script>
import { useUsuariPerfilStore } from '@/stores/index';

export default {
    data() {
        return {
            usuario: {} // Objeto para almacenar la información del usuario
        };
    },
    async mounted() {
        try {
            const id_usuario = useUsuariPerfilStore().amic;
            const response = await fetch(`http://localhost:8000/api/usuari/${id_usuario}`);
            const responseData = await response.json();
            console.log(responseData);
            if (responseData.status === 1) {
                // Asignar la información del usuario devuelta por la API a la variable usuario
                this.usuario = responseData.usuario;
            } else {
                // Manejar el caso de error
            }
        } catch (error) {
            console.error('Error al obtener las solicitudes:', error);
        }
    },
    beforeRouteLeave(next) {
        // Limpiar el campo 'amic' del pinia cuando se abandona la página actual
        useUsuariPerfilStore().amic = null;
        next();
    }
};
</script>
<style scoped>
html,
body {
    margin: 0;
    padding: 0;
    height: 100%;
}

body {
    /* Establecer la fuente predeterminada */
    background: linear-gradient(to top right, #FFA500, #f45c36);

    /* Color de fondo */
    height: 100vh;
}

.contenedor {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    height: 100vh;
}
.cabecera {
    display: flex; /* Para que los elementos estén en línea */
    align-items: center; /* Para centrar verticalmente */
    justify-content: center; /* Para centrar horizontalmente */
    background-color: #333;
    color: rgb(255, 255, 255);
    padding: 10px 20px;
    border-radius: 10px;
    width: 95%;
    margin-top: 20px;
    margin-bottom: 10px;
}

.cabecera p {
    margin-left: 20px;

    margin: 0;
    font-size: 18px;
}

.cabecera img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

.mensaje-bienvenida {
    display: grid;
    grid-template-columns: .2fr 1fr;
    margin-top: 50%;


}

.mensaje-bienvenida h2 {
    font-size: 1.5em;
    font-weight: 600;
    text-align: center;
    padding: 15px;

    background-color: #33333327;
    font-style: italic;
    /* Add this line to make the text italic */
    width: 70%;
    margin: auto;
    border-radius: 10px;
}

.mensaje-bienvenida img {
    width: 55px;
    height: 55px;
    border-radius: 50%;
    margin-left: 45px;
}

.chat-container {
    overflow-y: auto;
    /* Hace que el contenido sea desplazable verticalmente si es necesario */
    flex: 1;
    /* Permite que el área del chat ocupe el espacio disponible */
    width: 90%;
}

.chat {
    display: flex;
    flex-direction: column;
    margin-top: 20px;
    padding: 0 20px;
    width: 90%;
}

.chat img {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin-right: 10px;

}

.info-usuario {
    display: grid;
    grid-template-columns: .1fr 1fr;
    align-items: center;
}

.info-usuario p {
    font-style: italic;
}

.mensaje-usuario {
    background-color: #FFDAB9;
    padding: 10px;
    border-radius: 25px;
    border-top-right-radius: 0;
    align-self: flex-end;
    margin-bottom: 8px;
}

.mensaje-asistente {
    display: flex;
    align-items: flex-start;
    margin-bottom: 8px;
    padding: 10px;
    border-radius: 25px;
    border-bottom-left-radius: 0;
    background-color: #c7ab92;
    margin-right: 10%;
}

.avatar-asistente {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin-right: 10px;
    background-color: #FFA500;
}

.contenido-mensaje-asistente {
    max-width: 100%;
}

.animacion-carga {
    width: 20px;
    height: 20px;
    border: 2px solid #4CAF50;
    border-radius: 50%;
    border-top: 2px solid #ccc;
    animation: spin 1s linear infinite;
    align-self: flex-start;
    margin-bottom: 8px;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}

.controles-inferiores {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 20px;
    padding-bottom: 20px;
    background-color: #33333356;
}

.entrada-mensaje {
    width: calc(100% - 20px);
    padding: 10px;
    margin: 10px 0;
    box-sizing: border-box;
    background-color: #f0f0f0;
    border: none;
    border-radius: 8px;
}

.boton-enviar {
    background-color: #000;
    color: white;
    border: none;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
    border-radius: 4px;
    margin: 10px 10px 0;
    width: calc(100% - 20px);
}

.boton-enviar:hover {
    background-color: #333;
}

navBar {
    position: fixed;
    /* Para que el navbar sea fijo */
    bottom: 0;
    /* Lo posiciona en la parte inferior */
    width: 100%;
    /* Ocupa todo el ancho de la pantalla */
    z-index: 999;
    /* Asegura que esté por encima del contenido */
}
</style>