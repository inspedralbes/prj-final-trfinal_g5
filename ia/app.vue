<template>
  <div class="container">
    <h1>Hola soy Arturo, tu asistente de Google</h1>
    <div class="chat">
      <div v-for="(message, index) in chatMessages" :key="index" :class="getMessageClass(message)">
        <div v-if="message.role === 'user'" class="user-message">
          <div class="user-info">
            <img src="" alt="User Avatar" class="user-avatar" />
            <p class="user-name">Nombre del Usuario</p>
          </div>
          <p>{{ message.content }}</p>
        </div>
        <div v-else-if="message.role === 'assistant'" class="assistant-message">
          <img src="./public/img/icono_Arturo.jpg" alt="Arturo Avatar" class="assistant-avatar" />
          <div class="assistant-message-content">
            <p><strong>Arturo</strong><br> {{ message.content }}</p>
          </div>
        </div>
      </div>
      <!-- Mostrar animación de carga si isLoading es true -->
      <div v-if="isLoading" class="loading-animation"></div>
    </div>
    <textarea v-model="message" class="message-input" placeholder="Mensaje Arturo"></textarea>
    <button @click="enviarMensaje" class="send-button">Enviar</button>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      message: '',
      chatMessages: [],
      isLoading: false,
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
.container {
  max-width: 600px;
  margin: 0 auto;
  text-align: center;
}

h1 {
  color: #333;
  font-size: 24px;
}

.chat {
  display: flex;
  flex-direction: column;
  margin-top: 20px;
}

.user-message {
  background-color: #DCF8C6;
  padding: 10px;
  border-radius: 8px;
  align-self: flex-end;
  margin-bottom: 8px;
}

.user-info {
  display: flex;
  align-items: center;
  margin-bottom: 5px;
}

.user-avatar {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  margin-right: 10px;
}

.user-name {
  font-weight: bold;
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
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.message-input {
  width: calc(100% - 20px);
  padding: 10px;
  margin: 10px 0;
  box-sizing: border-box;
}

.send-button {
  background-color: #4CAF50;
  color: white;
  border: none;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  cursor: pointer;
  border-radius: 4px;
}

.send-button:hover {
  background-color: #45a049;
}
</style>
