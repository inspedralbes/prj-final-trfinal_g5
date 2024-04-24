<template>
  <body>
    <div>
      <div class="contenedor">
        <div class="cabecera">Assessorament</div>
        <!-- Movido el mensaje de bienvenida y cambiado el estilo -->
        <h2 class="mensaje-bienvenida">"Sóc Arturo, el teu assessor nutricional i esportiu, ¿en què puc ajudar-te?"</h2>
        <div class="chat-container">
          <div class="chat">
            <div v-for="(message, index) in chatMessages" :key="index" :class="getMessageClass(message)">
              <div class="mensaje" :class="{ 'mensaje-usuario': message.role === 'user', 'mensaje-asistente': message.role === 'assistant' }">
                <div class="info-usuario" v-if="message.role === 'user'">
                  <img src="" alt="Avatar usuario" class="avatar-usuario" />
                  <p class="nombre-usuario">{{ usuario }}</p>
                </div>
                <div class="contenido-mensaje">
                  <img v-if="message.role === 'assistant'" src="./public/img/icono_Arturo.jpg" alt="Avatar de Arturo"
                    class="avatar-asistente" />
                  <p><strong v-if="message.role === 'assistant'">Arturo</strong>{{ message.content }}</p>
                </div>
              </div>
            </div>
            <!-- Mostrar animación de carga si isLoading es true -->
            <div v-if="isLoading || isSending" class="animacion-carga"></div>
          </div>
        </div>
        <!-- Movido el textarea y el botón al final del contenedor -->
        <div class="controles-inferiores">
          <textarea v-model="message" @keydown.enter="enviarMensajeOnEnter" class="entrada-mensaje"
            placeholder="Mensaje Arturo"></textarea>
          <button @click="enviarMensaje" class="boton-enviar" :disabled="!message.trim() || isSending">Enviar</button>
        </div>
      </div>
      <navBar />
    </div>
  </body>
</template>

<script>
import { useUsuariPerfilStore } from '@/stores/index'

export default {
  data() {
    return {
      usuario: '',
      foto_perfil: '',
      message: '',
      chatMessages: [],
      isLoading: false,
      isSending: false,
    };
  },
  methods: {
    async enviarMensaje() {
      try {
        if (!this.message.trim()) {
          return;
        }

        this.chatMessages.push({
          role: 'user',
          content: this.message,
        });

        this.isLoading = true;
        this.isSending = true;
        
        const response = await enviarMensajeOpenAI(this.message);

        this.chatMessages.push({
          role: 'assistant',
          content: response,
        });

        this.message = ''; // Limpiar el campo de texto
      } catch (error) {
        console.error('Error al enviar el mensaje:', error);
      } finally {
        this.isLoading = false;
        this.isSending = false;
      }
    },
    async enviarMensajeOnEnter(event) {
      if (event.key === 'Enter' && !event.shiftKey) {
        event.preventDefault(); // Evitar el salto de línea
        await this.enviarMensaje(); // Llamar al método enviarMensaje al presionar Enter
      }
    },
    getMessageClass(message) {
      return {
        'mensaje-usuario': message.role === 'user',
        'mensaje-asistente': message.role === 'assistant',
      };
    },
  },
  mounted() {
    // Recuperar el nombre de usuario del almacenamiento local
    this.usuario = localStorage.getItem('username');
  },
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
  font-family: Arial, sans-serif;
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
  background-color: #333;
  color: rgb(255, 255, 255);
  padding: 10px 0;
  font-size: 24px;
  text-align: center;
  font-weight: bold;
  border-radius: 70px;
  width: 95%;
  margin: auto;
  margin-top: 20px;
  margin-bottom: 10px;
}

.mensaje-bienvenida {
    font-size: 1em;
    font-weight: 600;
    text-align: center;
    padding: 15px;
    background-color: #33333356;
    font-style: italic; /* Add this line to make the text italic */
    margin-top: 0;
 
}

.chat-container {
  overflow-y: auto; /* Hace que el contenido sea desplazable verticalmente si es necesario */
  flex: 1; /* Permite que el área del chat ocupe el espacio disponible */
}

.chat {
  display: flex;
  flex-direction: column;
  margin-top: 20px;
  padding: 0 20px;
  width: 90%;
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
  padding: 20px;
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
}</style>
