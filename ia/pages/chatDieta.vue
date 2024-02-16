<template>
  <body>
    <div>
      <div class="contenedor">
        <div class="cabecera">Assessor de Dieta</div>
        <!-- Movido el mensaje de bienvenida y cambiado el estilo -->
        <h2 class="mensaje-bienvenida">Sóc Arturo, el teu assessor nutricional, ¿en què puc ajudar-te?</h2>
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
export default {
  data() {
    return {
      usuario: '',
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

        // URL de la API de OpenAI
        const apiUrl = 'https://api.openai.com/v1/chat/completions';

    // Tu clave API de OpenAI (mantenla segura y no la expongas en el frontend)
    const apiKey = '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';

    // Preparar el payload de la solicitud
    const payload = {
      model: "gpt-3.5-turbo",
      messages: [
        {
          role: "system",
          content: "Ets una persona que només parla en català i tens prohibit parlar d'alguna cosa que no tingui relació amb la nutrició ja que ets un expert en nutrició només tens permès parlar de fer dietes. Si et demanen alguna cosa que no sigui una dieta digues el següent: En aquest apartat només puc donar consells de nutrició i generar dietes. Puc donar consells i arguments però fes-ho de forma resumida en unes 2 línies a menys que t'indiquin que volen més informació.",
        },
        {
          role: "user",
          content: this.message,
        },
      ],
    };

        // Hacer la solicitud POST
        const response = await fetch(apiUrl, {
          method: 'POST',
          headers: {
            'Authorization': `Bearer ${apiKey}`,
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(payload),
        });

        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();

        // Asumimos que la respuesta incluye el texto generado
        const generatedText = data.choices[0].message.content;

        // Agregar la respuesta al chat
        this.chatMessages.push({
          role: 'assistant',
          content: generatedText,
        });

        this.message = ''; // Limpiar el input después de enviar
      } catch (error) {
        console.error('Error al enviar el mensaje:', error);
        // Manejo específico para diferentes tipos de errores, como límites de tasa
        if (error.message.startsWith("HTTP error! status: 429")) {
          alert("Has superado el límite de solicitudes. Por favor, espera un momento antes de intentar de nuevo.");
        }
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
  padding: 10px;
  border-radius: 10px;
  background-color: #FFDAB9;
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
