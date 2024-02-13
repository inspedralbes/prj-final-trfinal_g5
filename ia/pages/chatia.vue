<template>
  <body>
    <div class="contenedor">
      <div class="cabecera">Asesoramiento</div>
      <!-- Movido el mensaje de bienvenida y cambiado el estilo -->
      <h2 class="mensaje-bienvenida">Soy Arturo, ¿en qué puedo ayudarte?</h2>
      <div class="chat">
        <div v-for="(message, index) in chatMessages" :key="index" :class="getMessageClass(message)">
          <div v-if="message.role === 'user'" class="mensaje-usuario">
            <div class="info-usuario">
              <img src="" alt="Avatar del usuario" class="avatar-usuario" />
              <p class="nombre-usuario">Nombre del Usuario</p>
            </div>
            <p>{{ message.content }}</p>
          </div>
          <div v-else-if="message.role === 'assistant'" class="mensaje-asistente">
            <img src="./public/img/icono_Arturo.jpg" alt="Avatar de Arturo" class="avatar-asistente" />
            <div class="contenido-mensaje-asistente">
              <p><strong>Arturo</strong><br> {{ message.content }}</p>
            </div>
          </div>
        </div>
        <!-- Mostrar animación de carga si isLoading es true -->
        <div v-if="isLoading || isSending" class="animacion-carga"></div>
      </div>
      <!-- Movido el textarea y el botón al final del contenedor -->
      <div class="controles-inferiores">
        <textarea v-model="message" class="entrada-mensaje" placeholder="Mensaje Arturo"></textarea>
        <button @click="enviarMensaje" class="boton-enviar" :disabled="!message.trim() || isSending">Enviar</button>
      </div>
    </div>
    <navBar />
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
      isSending: false,
    };
  },
  methods: {
    async enviarMensaje() {
      try {
        // Verificar si el mensaje está vacío
        if (!this.message.trim()) {
          // Si el mensaje está vacío, no hagas nada y sal del método
          return;
        }

        // Agregar el mensaje del usuario al historial de chat
        this.chatMessages.push({
          role: 'user',
          content: this.message,
        });

        // Activar la animación de carga y el indicador de envío
        this.isLoading = true;
        this.isSending = true;

        const resposta = this.message;
        this.message = '';
        const apiUrl = 'http://localhost:1234/v1/chat/completions';
        const response = await axios.post(apiUrl, {
          "messages": [
            {
              "role": "system",
              "content": "Respondeme en español, tu nombre es Arturo, puedes responderme en formato JSON, solo quiero que me lo dividas por número de días y solo quiero que guardes el ejercicio, los sets y las repeticiones"
            },
            {
              "role": "user",
              content: resposta,
            }
          ],
        });

        // Agregar la respuesta de la API al historial de chat
        this.chatMessages.push(...response.data.choices.map(choice => choice.message));

        // Desactivar la animación de carga y el indicador de envío
        this.isLoading = false;
        this.isSending = false;

      } catch (error) {
        console.error('Error al enviar el mensaje:', error);
        // En caso de error, también desactivar la animación de carga y el indicador de envío
        this.isLoading = false;
        this.isSending = false;
      }
    },
    getMessageClass(message) {
      return {
        'mensaje-usuario': message.role === 'user',
        'mensaje-asistente': message.role === 'assistant',
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
  background-color: #f8a60e;
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
  padding: 20px 0;
  font-size: 24px;
  text-align: center;
  font-weight: bold;
  width: 100%;
}

.mensaje-bienvenida {
  font-size: 18px;
  text-align: center;
  margin-top: 20px;
}

.chat {
  display: flex;
  flex-direction: column;
  margin-top: 20px;
  padding: 0 20px;
  width: 100%;
}

.mensaje-usuario {
  background-color: #FFDAB9;
  padding: 10px;
  border-radius: 8px;
  align-self: flex-end;
  margin-bottom: 8px;
}

.mensaje-asistente {
  display: flex;
  align-items: flex-start;
  margin-bottom: 8px;
}

.avatar-asistente {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  margin-right: 10px;
  background-color: #FFA500;
}

.contenido-mensaje-asistente {
  max-width: 70%;
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
  margin-bottom: 20px;
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
</style>
