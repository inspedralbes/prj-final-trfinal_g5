<template>
  <body>
    <div class="contenedor">
      <capçalera />
      <div class="cabecera">Assessorament Rutina</div>


      <div class="chat-container">
        <div class="chat">
          <!-- Mensajes de chat de usuario y asistente -->
          <div v-for="(message, index) in chatMessages" :key="index" :class="getMessageClass(message)">
            <div class="mensaje"
              :class="{ 'mensaje-usuario': message.role === 'user', 'mensaje-asistente': message.role === 'assistant' }">
              <div class="info-usuario" v-if="message.role === 'user'">
                <img :src="'http://fithub.daw.inspedralbes.cat/back/public/storage/imagenes_perfil/' + foto_perfil" alt="Avatar usuario"
                  class="avatar-usuario" />
                <p class="nombre-usuario">{{ nom_usuari }}</p>
              </div>
              <div class="contenido-mensaje">
                <img v-if="message.role === 'assistant'" src="@/public/img/icono_Arturo.jpg" alt="Avatar de Arturo"
                  class="avatar-asistente" />
                <p><strong v-if="message.role === 'assistant'">Arturo</strong>{{ message.content }}</p>
              </div>
            </div>
          </div>


          <!-- Opciones de respuesta como botones -->
          <div v-if="currentOptions && showOptions" class="botones-preseleccionados">
            <button v-for="(option, key) in currentOptions" :key="key" @click="handleOptionSelect(key)">
              {{ key }}
            </button>
          </div>




          <!-- Mostrar animación de carga si isLoading es true -->
          <div v-if="isLoading || isSending" class="animacion-carga"></div>
        </div>
      </div>


      <div class="controles-inferiores">
        <textarea v-model="message" @keydown.enter="enviarMensajeOnEnter" class="entrada-mensaje"
          placeholder="Escriu la teva consulta"></textarea>
        <button @click="enviarMensaje" class="boton-enviar" :disabled="!message.trim() || isSending">Enviar</button>
      </div>
      <navBar />
    </div>
  </body>
</template>


<script>
import { enviarMensajeOpenAIRutina } from '@/stores/communicationManager';
import { useUsuariPerfilStore } from '@/stores/index';
const arbrePreguntes = {
  pregunta: "Quin tipus de rutina vols?",
  opcions: {
    Hipertrofia: {
      pregunta: "Quants dies prefereixes entrenar a la semana?",
      opcions: {
        "3": "Rutina de hipertrofia de 4 dies: Dilluns, Dimarts, Dijous, Divendres",
        "4": "Rutina de hipertrofia de 5 dies: Dilluns, Dimarts, Dimecres, Dijous, Divendres",
        "5": "Rutina de hipertrofia de 6 dies: Dilluns, Dimarts, Dimecres, Dijous, Divendres, Dissabte",
      }
    },
    Calistenia: {
      pregunta: "Quants dies prefereixes entrenar a la semana?",
      opcions: {
        "3": "Rutina de calistenia de 4 dies: Dilluns, Dimarts, Dijous, Divendres",
        "4": "Rutina de calistenia de 5 dies: Dilluns, Dimarts, Dimecres, Dijous, Divendres",
        "5": "Rutina de calistenia de 6 dies: Dilluns, Dimarts, Dimecres, Dijous, Divendres, Dissabte",
      }
    },
    Equilibrada: {
      pregunta: "Quants dies prefereixes entrenar a la semana?",
      opcions: {
        "3": "Rutina de equilibrada de 4 dies: Dilluns, Dimarts, Dijous, Divendres",
        "4": "Rutina de equilibrada de 5 dies: Dilluns, Dimarts, Dimecres, Dijous, Divendres",
        "5": "Rutina de equilibrada de 6 dies: Dilluns, Dimarts, Dimecres, Dijous, Divendres, Dissabte",
      }
    }
  }
};


export default {
  data() {
    return {
      usuario: '',
      message: '',
      chatMessages: [],
      isLoading: false,
      isSending: false,
      currentQuestion: arbrePreguntes.pregunta,
      currentOptions: arbrePreguntes.opcions,
      showOptions: true,
    };
  },
  watch: {
    message(newValue) {
      this.showOptions = !newValue.trim();
    }
  },
  methods: {
    handleOptionSelect(optionKey) {
      let nextStep = this.currentOptions[optionKey];


      // Comprobar si hay un siguiente nivel de opciones
      if (nextStep && typeof nextStep === 'object' && nextStep.pregunta) {
        // Actualizar la pregunta y opciones actuales si hay más preguntas
        this.currentQuestion = nextStep.pregunta;
        this.currentOptions = nextStep.opcions || {};
        // Añadir la respuesta del asistente al chat
        this.chatMessages.push({
          role: 'assistant',
          content: this.currentQuestion
        });
      } else {
        // Manejar el final del árbol de preguntas
        this.currentQuestion = nextStep; // Esta sería la respuesta final
        this.currentOptions = {};
        // Establecer el mensaje final en `message` para ser enviado
        this.message = nextStep;
        // Añadir al chat y preparar para enviar
        this.chatMessages.push({
          role: 'assistant',
          content: this.currentQuestion
        });
        // Opcional: Llamar a enviarMensaje directamente si se desea enviar inmediatamente
        this.enviarMensaje();
      }
    },
    async enviarMensaje() {
      try {
        if (!this.message.trim()) {
          return;
        }


        if (this.chatMessages.length === 0) {
          document.querySelector('.mensaje-bienvenida').style.display = 'none';
        }
        if (this.chatMessages.length === 0) {
          document.querySelector('.botones-preseleccionados').style.display = 'none';
        }


        this.chatMessages.push({
          role: 'user',
          content: this.message,
        });


        this.isLoading = true;
        this.isSending = true;


        const store = useUsuariPerfilStore();
        const idUsuario = store.id_usuari;




        const daotsUsuario = await getDatosUsuario2(idUsuario);
        const ejercicios = await getDatosEjercicio();
        const generatedText = await enviarMensajeOpenAIRutina(this.message, ejercicios, daotsUsuario);


        // console.log(generatedText);

        const rutinaJSON = JSON.parse(generatedText); // Convertir el texto generado en JSON


        await enviarRutinaAlServidor(rutinaJSON); // Enviar el JSON al backend


        // Construir el mensaje con la lista de días y ejercicios
        let mensajeRutina = '\nAquí tens la teva rutina:\n'; // Comienza el mensaje con la introducción


        rutinaJSON.dias.forEach((dia) => {
          // Iterar sobre cada día de la rutina
          mensajeRutina += `\nDía: ${dia.dia}\n`; // Agregar el número del día al mensaje


          dia.exercicis.forEach((exercicio) => {
            // Iterar sobre cada ejercicio del día
            mensajeRutina += `\n- ${exercicio.nom_exercici}( series de ${exercicio.series} amb  ${exercicio.repeticions} repeticions) \n`;
          });
        });




        this.chatMessages.push({
          role: 'assistant',
          content: mensajeRutina,
        });




        this.message = '';
      } catch (error) {
        // console.error('Error al enviar el mensaje:', error);
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


    this.chatMessages.push({
      role: 'assistant',
      content: this.currentQuestion
    });
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
  display: grid;
  grid-template-columns: .1fr 1fr;
  margin-top: 15%;




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


.botones-preseleccionados {
  display: grid;
  grid-template-columns: 1fr 1fr;
  grid-gap: 20px;
  margin: auto;
  margin-top: 60px;
  margin-bottom: 20px;
  width: 90%;


}


.botones-preseleccionados button {
  background-color: #0000002f;
  color: white;
  border: 4px solid #1b1b1b23;
  padding: 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 1em;
  font-weight: bold;
  cursor: pointer;
  border-radius: 4px;
  width: 100%;
  padding-top: 20px;
  padding-bottom: 20px;
  margin: auto;
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




.avatar-usuario {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  margin-right: 10px;
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
