<template>

  <body>
    <div class="contenedor">
      <capçalera />

      <div class="cabecera">Assessorament</div>
      <!-- Movido el mensaje de bienvenida y cambiado el estilo -->
      <div class="mensaje-bienvenida">
        <img src="../public/img/icono_Arturo.jpg" alt="">
        <h2>Sóc Arturo, el teu assessor nutricional i esportiu, ¿en què puc ajudar-te?</h2>

       
      </div>

      <div class="botones-bienvenida">
        <nuxt-link to="/chatRutina" class="boton-chat-Rutina">Assessor de Rutina</nuxt-link>
        <nuxt-link to="/chatDieta" class="boton-chat-Dieta">Assessor de Dieta</nuxt-link>

      </div>
      

      <div class="chat-container">
        <div class="chat">
          <div v-for="(message, index) in chatMessages" :key="index" :class="getMessageClass(message)">
              <div class="info-usuario" v-if="message.role === 'user'">
                <img :src="'http://127.0.0.1:8000/storage/imagenes_perfil/' + foto_perfil" alt="Avatar usuario"
                  class="avatar-usuario" />
                <p class="nombre-usuario">{{ nom_usuari }}</p>
              </div>
              <div class="contenido-mensaje">
                <img v-if="message.role === 'assistant'" src="../public/img/icono_Arturo.jpg" alt="Avatar de Arturo"
                  class="avatar-asistente" />
                <p><strong v-if="message.role === 'assistant'">Arturo</strong>{{ message.content }}</p>
              </div>
          </div>
          <!-- Mostrar animación de carga si isLoading es true -->
          <div v-if="isLoading || isSending" class="animacion-carga"></div>
        </div>
      </div>
      <!-- Movido el textarea y el botón al final del contenedor -->
      <div class="controles-inferiores">
        <div class="entrada-mensaje-container">
          <textarea v-model="mensaje" class="entrada-mensaje" placeholder="Escribe tu mensaje..."></textarea>

          <button @click="enviarMensaje" :disabled="isSaving" class="boton-enviar">
            <Icon id="send" name="i-ic:round-send"></Icon>
          </button>
        </div>
      </div>
      <navBar />

    </div>

  </body>
</template>

<script>
import { enviarMensajeOpenAIDieta } from '@/stores/communicationManager';
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


        if (this.chatMessages.length === 0) {
          document.querySelector('.mensaje-bienvenida').style.display = 'none';
        }

        if(this.chatMessages.length === 0) {
          document.querySelector('.botones-bienvenida').style.display = 'none';
        }


        this.chatMessages.push({
          role: 'user',
          content: this.message,
        });


        this.isLoading = true;
        this.isSending = true;


        const generatedText = await enviarMensajeOpenAI(this.message);


        this.chatMessages.push({
          role: 'assistant',
          content: generatedText,
        });


        this.message = '';
      } catch (error) {
        console.error('Error al enviar el mensaje:', error);
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
  computed: {
    nom_usuari() {
      return useUsuariPerfilStore().nom_usuari;
    },
    foto_perfil() {
      return useUsuariPerfilStore().foto_perfil;
    },
  },
};
</script>

<style scoped>
html,
body {
  margin: 0;
  padding: 0;
  height: 100vh;
  overflow-x: hidden;


}

body {
  /* Establecer la fuente predeterminada */
  background: linear-gradient(to top right, #FFA500, #f45c36);

  /* Color de fondo */
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
}

.mensaje-bienvenida {
  display: grid;
  grid-template-columns: .1fr 1fr;
  margin-top: 15%;
}

.botones-bienvenida{
  display: grid;
  grid-template-columns: 1fr 1fr;
  grid-gap: 20px;
  margin: auto;
  margin-top: 170px;
  margin-bottom: 20px;
  width: 90%;

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
  background-color: #fda65975;
  padding: 10px;
  border-radius: 25px;
  border-top-right-radius: 0;
  align-self: flex-end;
  margin-bottom: 8px;
  word-wrap: break-word;
  max-width: 90%;
  
}




.mensaje-asistente {
  display: flex;
  align-items: flex-start;
  margin-bottom: 8px;
  padding: 10px;
  border-radius: 25px;
  border-bottom-left-radius: 0;
  background-color: #757575a2;
  margin-right: 10%;
  max-width: 70%;
  word-wrap: break-word;
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

.boton-chat-Rutina {
  background-color: #0000002f;
  color: white;
  border: 4px solid #1b1b1b23;
  padding: 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  border-radius: 4px;
  width: 80%;
  padding-top: 30px;
  padding-bottom: 30px;
  margin: auto;

}

.boton-chat-Dieta {
  background-color: #0000002f;
  color: white;
  border: 4px solid #1b1b1b23;
  padding: 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  border-radius: 4px;
  width: 80%;
  padding-top: 30px;
  padding-bottom: 30px;
  margin: auto;
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
  padding-bottom: 20px;
}

.entrada-mensaje-container {
  display: flex;
  align-items: center;
  display: grid;
  grid-template-columns: 5fr .1fr .1fr;
  width: 90%;
  padding: 10px;
  border-radius: 30px;
  background-color: #333;
  margin-top: 10px;
}

.entrada-mensaje {
  margin-left: 2px;
  width: 95%;
  padding-left: 10px;
  padding-top: 10px;
  box-sizing: border-box;
  background-color: #f0f0f0;
  border: none;
  border-radius: 20px;
  height: 35px;
  overflow-y: hidden;
}

.boton-enviar {
  width: 35px;
  height: 35px;
  border-radius: 50%;
  background-color: #ccc;
  color: white;
  border: none;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  transition: background-color 0.3s;
  margin-left: 10px;
}

.boton-enviar:hover {
  background-color: #333;
}

#send {
  width: 100%;
  height: 100%;
  margin-left: 2px;
  color: #333;
}
</style>