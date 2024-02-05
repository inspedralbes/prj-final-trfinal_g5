<template>
  <body>
    <div class="chat-container">
      <div class="header">Asesoramiento</div>
      <div class="chat">
        <!-- Mostrar mensaje inicial si no hay mensajes en el chat -->
        <div v-if="chatMessages.length === 0" class="initial-message">
          <p>¿En qué puedo ayudarte?</p>
        </div>
        <div v-for="(message, index) in chatMessages" :key="index" :class="getMessageClass(message)">
          <div v-if="message.role === 'user'" class="user-message">
            <p>{{ message.content }}</p>
          </div>
          <div v-else-if="message.role === 'assistant'" class="assistant-message">
            <div class="assistant-avatar"></div>
            <div class="assistant-message-content">
              <p><strong>Arturo:</strong> {{ message.content }}</p>
            </div>
          </div>
        </div>
        <!-- Mostrar animación de carga si isLoading es true -->
        <div v-if="isLoading" class="loading-animation"></div>
      </div>
      <div class="footer">
        <textarea v-model="message" class="message-input" placeholder="Mensaje Arturo"></textarea>
        <button @click="enviarMensaje" class="send-button">Enviar</button>
      </div>
    </div>
  </body>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      message: '',
      chatMessages: [],
      isLoading: false,
      initialMessageShown: false // Para controlar si se mostró el mensaje inicial
    };
  },
  methods: {
    async enviarMensaje() {
      try {
        // Agregar el mensaje del usuario al historial de chat
        this.chatMessages.push({
          role: 'user',
          content: this.message,
        });

        // Ocultar el mensaje inicial después del primer mensaje
        this.initialMessageShown = true;

        // Activar la animación de carga
        this.isLoading = true;

        // Realizar la solicitud a la API
        const apiUrl = 'http://localhost:1234/v1/chat/completions';
        const response = await axios.post(apiUrl, {
          "messages": [
            {
              "role": "system",
              "content": "Respondeme en español, tu nombre es Arturo, puedes responderme en formato JSON, solo quiero que me lo dividas por número de días y solo quiero que guardes el ejercicio, los sets y las repeticiones"
            },
            {
              "role": "user",
              content: this.message,
            }
          ],
        });

        // Agregar la respuesta de la API al historial de chat
        this.chatMessages.push(...response.data.choices.map(choice => choice.message));

        // Desactivar la animación de carga
        this.isLoading = false;

        // Limpiar el campo de entrada después de enviar el mensaje
        this.message = '';
      } catch (error) {
        console.error('Error al enviar el mensaje:', error);
        // En caso de error, también desactivar la animación de carga
        this.isLoading = false;
      }
    },
    getMessageClass(message) {
      return {
        'user-message': message.role === 'user',
        'assistant-message': message.role === 'assistant',
      };
    },
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
  background-color: #FFA500;
  /* Color de fondo */
}

.chat-container {
  width: 100%;
  height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  background-color: #FFA500;
  padding-bottom: 60px;
  /* Para mantener espacio para el cuadro de entrada */
  overflow-y: auto;
  /* Habilitar desplazamiento vertical */
}

.header {
  background-color: #FFA500;
  color: black;
  padding: 10px 0;
  font-size: 24px;
  text-align: center;
  font-weight: bold;
  font-size: 2.5em;
}

.chat {
  display: flex;
  flex-direction: column;
  margin-top: 20px;
  padding: 0 20px;
  /* Añadido espacio alrededor de los mensajes */
}

.user-message {
  background-color: #FFDAB9;
  /* Naranja claro */
  padding: 10px;
  border-radius: 8px;
  align-self: flex-end;
  margin-bottom: 8px;
}

.assistant-message {
  display: flex;
  align-items: flex-start;
  margin-bottom: 8px;
}

.assistant-avatar {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  margin-right: 10px;
  background-color: #FFA500;
  /* Naranja */
}

.assistant-message-content {
  max-width: 70%;
}

.loading-animation {
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

.message-input {
  width: calc(100% - 20px);
  padding: 10px;
  margin: 10px 0;
  box-sizing: border-box;
  background-color: #f0f0f0;
  /* Gris claro */
  border: none;
  border-radius: 8px;
}

.send-button {
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
  /* Ajuste de ancho */
}

.send-button:hover {
  background-color: #333;
}

.footer {
  background-color: #FFA500;
  padding: 10px 0;
  text-align: center;
}
</style>
