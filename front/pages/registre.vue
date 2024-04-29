<template>
    <div class="register-container">

        <div v-if="showStartButton">

            <div class="logo-container">
                <img src="../public/logo_fithub.png" alt="FitHub Logo" class="logo-image" />
            </div>
            <div class="button-container">
                <button class="button button--secondary" @click="startRegistration">Començar Registre</button>
            </div>
        </div>

        <div v-else>
            <div class="progress-bar" :style="{ width: progressPercentage + '%' }"></div>

            <div v-if="currentQuestionIndex === registrationQuestions.length" class="loading">
                <img src="../public/dumbbell_white.png" alt="" class="loading-image">
            </div>
            <div v-if="checkingEmail" class="loading">
                <img src="../public/dumbbell_white.png" alt="" class="loading-image">
            </div>

            <div v-if="currentQuestionIndex < registrationQuestions.length" class="question-container fade-in">
                <div v-if="currentQuestionIndex <= registrationQuestions.length" class="question-counter">
                    {{ currentQuestionIndex + 1 }} / {{ totalQuestions }}
                </div>
                <h2 class="registrationQuestion fade-in">{{ registrationQuestions[currentQuestionIndex].question }}</h2>

                <input v-if="registrationQuestions[currentQuestionIndex].inputType === 'textarea'"
                    v-model="currentAnswer" placeholder="Escribe tu respuesta"></input>
                <input v-else-if="registrationQuestions[currentQuestionIndex].inputType === 'email'"
                    v-model="currentAnswer" type="email" placeholder="Correu electronic" @input="validateEmailInput">
                <input v-else-if="registrationQuestions[currentQuestionIndex].inputType === 'contrasenya'"
                    v-model="currentAnswer" type="password" placeholder="Contraseña" @input="validatePassword">
                <input v-else-if="registrationQuestions[currentQuestionIndex].inputType === 'nom'"
                    v-model="currentAnswer" type="text" placeholder="Nom" @input="validateNameInput" maxlength="25">
                <input v-else-if="registrationQuestions[currentQuestionIndex].inputType === 'cognoms'"
                    v-model="currentAnswer" type="text" placeholder="Cognoms" @input="validateNameInput" maxlength="80">
                <input v-else-if="registrationQuestions[currentQuestionIndex].inputType === 'altura'"
                    v-model="currentAnswer" type="text" placeholder="Altura (cm)" @input="validateAlturaInput"
                    maxlength="4">
                <input v-else-if="registrationQuestions[currentQuestionIndex].inputType === 'pes'"
                    v-model="currentAnswer" type="text" placeholder="Pes (kg)" @input="validatePesInput" maxlength="6">
                <input v-else-if="registrationQuestions[currentQuestionIndex].inputType === 'telefon'"
                    v-model="currentAnswer" type="tel" placeholder="Numero de telefon" @input="validateTelefonInput">
                <input v-else-if="registrationQuestions[currentQuestionIndex].inputType === 'data_naixement'"
                    v-model="currentAnswer" type="date" @input="validateDate">
                <div v-if="registrationQuestions[currentQuestionIndex].inputType === 'genere'">
                    <div class="gender-options">
                        <div v-for="(option, index) in registrationQuestions[currentQuestionIndex].respuesta"
                            :key="index" class="gender-option">
                            <input type="radio" :id="'option' + index" :value="option" v-model="currentAnswer">
                            <label :for="'option' + index" @click="selectGenderOption(option)">{{ option }}</label>

                        </div>
                    </div>
                </div>

                <div v-if="showErrorMessage" class="error-message">
                    {{ errorMessage }}
                </div>
                <div v-if="registrationQuestions[currentQuestionIndex].inputType === 'contrasenya'"
                    class="error-message">{{ passwordErrorMessage }}</div>
                <div v-if="registrationQuestions[currentQuestionIndex].inputType === 'data_naixement'"
                    class="error-message">{{ dateErrorMessage }}</div>

                <div class="buttons fade-in">
                    <button @click="seguentPregunta">Seguent</button>
                    <button v-if="!registrationQuestions[currentQuestionIndex].required"
                        @click="saltarPregunta">Saltar</button>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import { useUsuariPerfilStore } from '@/stores/index'

export default {
    data() {
        return {
            showStartButton: true,
            checkingEmail: false,
            errorMessage: "",
            showErrorMessage: false,
            currentQuestionIndex: 0,
            currentAnswer: "",
            selectedOptions: [],
            phoneNumberValid: false,
            passwordErrorMessage: "",
            dateErrorMessage: "",
            userData: {
                email: "",
                contrasenya: "",
                nom: "",
                cognoms: "",
                data_naixement: "",
                genere: "",
                pes: "",
                altura: "",
                telefon: ""
            },
            totalQuestions: 0,
            progressPercentage: 0,

            registrationQuestions: [
                {
                    question: "Quin es el teu correu electronic?",
                    inputType: 'email',
                    required: true,

                },
                {
                    question: "Quina es la teva contrasenya?",
                    inputType: 'contrasenya',
                    required: true,

                },
                {
                    question: "Quin es el teu nom?",
                    inputType: 'nom',
                    required: true,

                },
                {
                    question: "Quin es el teus cognoms?",
                    inputType: 'cognoms',
                    required: true,

                },

                {
                    question: "Quin es el teu genere?",
                    inputType: 'genere',
                    respuesta: ['Home', 'Dona', 'Altres'],
                },
                {
                    question: "Quin es la teva data de naixement?",
                    inputType: 'data_naixement',
                },
                {
                    question: "Quina es la teva altura?",
                    inputType: 'altura',
                },
                {
                    question: "Quin es el teu pes?",
                    inputType: 'pes',
                },
                {
                    question: "Quin es el teu numero de telefon?",
                    inputType: 'telefon',
                }

            ],
            showErrorMessage: false,
        };
    },
    computed: {
        progressPercentage() {
            return (this.currentQuestionIndex / this.totalQuestions) * 100;
        },
    },
    methods: {
        startRegistration() {
            this.showStartButton = false;
            this.totalQuestions = this.registrationQuestions.length; // Establecer el número total de preguntas
        },
        async seguentPregunta() {
            // Obtener la pregunta actual
            const currentQuestion = this.registrationQuestions[this.currentQuestionIndex];

            // Verificar si la pregunta actual es requerida
            if (currentQuestion.required && this.currentAnswer === "") {
                // Mostrar un mensaje de error indicando que la pregunta es requerida
                this.showErrorMessage = true;
                this.errorMessage = "Aquesta pregunta és requerida. Si us plau, respon abans de continuar.";
                return;
            }
            if (this.currentAnswer === "") {
                // Mostrar un mensaje de error indicando que la respuesta es requerida
                this.showErrorMessage = true;
                this.errorMessage = "Aquest camp no pot estar buit. Si us plau, respon abans de continuar.";
                return;
            }
            if (currentQuestion.inputType === 'contrasenya') {
                const isPasswordValid = this.validatePassword();
                if (!isPasswordValid) {
                    // Mostrar mensaje de error si la contraseña no es válida
                    return;
                }
            }
            if (currentQuestion.inputType === 'data_naixement') {
                const isDateValid = this.validateDate();
                if (!isDateValid) {
                    // Mostrar mensaje de error si la fecha no es válida
                    return;
                }
            }
            if (currentQuestion.inputType === 'telefon') {
                this.validateTelefonInput(); // Validar el número de teléfono
                if (this.showErrorMessage) {
                    // Mostrar mensaje de error si el número de teléfono no es válido
                    return;
                }
            }

            // Verificar si el correo electrónico no está vacío y es la pregunta actual
            if (this.currentAnswer !== "" && currentQuestion.inputType === 'email') {
                this.validateEmailInput(); // Validar el correo electrónico
                if (this.showErrorMessage) {
                    // Mostrar mensaje de error si el correo electrónico no es válido
                    return;
                } else {
                    // Realizar la verificación del correo electrónico
                    const response = await fetch('http://localhost:8000/api/comprovaremail', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            email: this.currentAnswer
                        }),
                    });

                    this.checkingEmail = false;

                    // Convertir la respuesta a formato JSON
                    const responseData = await response.json();

                    // Si el correo ya existe, mostrar el mensaje de error y no avanzar
                    if (responseData.status === 1) {
                        this.showErrorMessage = true;
                        this.errorMessage = responseData.message;
                        return;
                    }
                }
            }

            // Si la pregunta no es requerida, o si es requerida pero tiene respuesta, proceder a la siguiente pregunta
            // Guardar la respuesta actual en el objeto de datos del usuario
            this.userData[currentQuestion.inputType] = this.currentAnswer;

            // Incrementar el índice de la pregunta
            this.currentQuestionIndex++;

            // Reiniciar la respuesta actual
            this.currentAnswer = "";
            this.showErrorMessage = false;

            // Si es la última pregunta, registra al usuario
            if (this.currentQuestionIndex === this.registrationQuestions.length) {
                await this.registerUser();
            }
        },


        async saltarPregunta() {
            // Obtener la pregunta actual
            const currentQuestion = this.registrationQuestions[this.currentQuestionIndex];
            this.currentAnswer = "";

            if (currentQuestion.required) {
                // Mostrar un mensaje de error indicando que la pregunta es requerida
                this.showErrorMessage = true;
                this.errorMessage = "Aquesta pregunta és requerida. Si us plau, respon abans de continuar";
                return;
            }
            // Si hay una respuesta, guardarla en el objeto de datos del usuario
            if (this.currentAnswer.trim() !== "") {
                this.userData[currentQuestion.inputType] = this.currentAnswer;
            }

            // Incrementar el índice de la pregunta
            this.currentQuestionIndex++;

            // Reiniciar la respuesta actual
            this.currentAnswer = "";
            this.showErrorMessage = false;

            // Si es la última pregunta, registra al usuario
            if (this.currentQuestionIndex === this.registrationQuestions.length) {
                // Filtrar userData para eliminar campos vacíos


                // Realizar el registro solo si hay datos válidos

                await this.registerUser();
            }
        },

        selectGenderOption(option) {
            // Establecer el valor de la respuesta como la opción seleccionada
            this.currentAnswer = option;
        },


        goToLogin() {
            this.$router.push('/');
        },
        validateNumberInput() {
            // Validar que la entrada sea un número o un solo punto decimal
            this.currentAnswer = this.currentAnswer.replace(/[^0-9.]/g, '');

            // Asegurar que solo haya un punto decimal
            const dotCount = this.currentAnswer.split('.').length - 1;
            if (dotCount > 1) {
                this.currentAnswer = this.currentAnswer.slice(0, -1);
            }
        },
        validateTelefonInput() {
            // Validar que la entrada sea un número y limitar la longitud a 9 dígitos
            this.currentAnswer = this.currentAnswer.replace(/[^\d]/g, '').slice(0, 9);

            // Verificar si el número de teléfono tiene exactamente 9 dígitos
            const phoneNumberLength = this.currentAnswer.length;
            if (phoneNumberLength !== 9) {
                // Si el número de teléfono no tiene 9 dígitos, mostrar un mensaje de error
                this.showErrorMessage = true;
                this.errorMessage = "El número de telèfon ha de tenir exactament 9 dígits.";
                return;
            } else {
                // Si el número de teléfono tiene 9 dígitos, ocultar cualquier mensaje de error anterior
                this.showErrorMessage = false;
            }

            // Reiniciar el mensaje de error si la validación es exitosa
            this.showErrorMessage = false;
        },

        validateNameInput() {
            // Eliminar caracteres no alfabéticos del nombre
            this.currentAnswer = this.currentAnswer.replace(/[^A-Za-zÀ-ÿ\s]/g, '');

            // Capitalizar la primera letra de cada palabra
            this.currentAnswer = this.currentAnswer.toLowerCase().replace(/(^|\s)\S/g, match => match.toUpperCase());
        },

        validateEmailInput() {
            // Validar el correo electrónico como se muestra en la respuesta anterior
            // Si hay un error, establecer el mensaje de error
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            if (!emailRegex.test(this.currentAnswer)) {
                this.errorMessage = 'El format del correu electronic es incorrecte.';
                this.showErrorMessage = true; // Mostrar el mensaje de error
                return;
            }

            const allowedDomains = ['gmail.com', 'hotmail.com', 'inspedralbes.cat'];
            const domain = this.currentAnswer.split('@')[1];
            if (!allowedDomains.includes(domain)) {
                this.errorMessage = 'Només es permeten correus electrònics amb domini gmail.com o hotmail.com. inspedralbes.cat';
                this.showErrorMessage = true; // Mostrar el mensaje de error
                return;
            }

            // Si el correo electrónico es válido, asegúrate de que no haya otros mensajes de error
            this.showErrorMessage = false;
        },
        validatePassword() {
            if (this.currentAnswer.length < 6) {
                this.passwordErrorMessage = "La contrasenya ha de tenir com a mínim 6 caràcters.";
                return false;
            } else {
                this.passwordErrorMessage = "";
                return true;
            }
        },

        validateDate() {
            const currentDate = new Date();
            const selectedDate = new Date(this.currentAnswer);
            const minDate = new Date('1900-01-01');

            if (selectedDate > currentDate || selectedDate < minDate) {
                this.dateErrorMessage = "La data seleccionada ha d'estar entre la data actual i el 1900.";
                return false;
            } else {
                this.dateErrorMessage = "";
                return true;
            }
        },
        validatePesInput() {
            // Validar que la entrada sea un número con máximo dos decimales
            this.currentAnswer = this.currentAnswer.replace(/[^\d.]/g, ''); // Eliminar todos los caracteres que no sean dígitos ni puntos
            const decimalCount = (this.currentAnswer.match(/\./g) || []).length; // Contar el número de puntos decimales

            if (decimalCount > 1) {
                // Si hay más de un punto decimal, eliminar todos los puntos después del segundo
                const indexOfSecondDecimal = this.currentAnswer.indexOf('.', this.currentAnswer.indexOf('.') + 1);
                this.currentAnswer = this.currentAnswer.slice(0, indexOfSecondDecimal);
            }

            // Limitar el número de decimales a dos
            const decimalIndex = this.currentAnswer.indexOf('.');
            if (decimalIndex !== -1) {
                const integerPart = this.currentAnswer.slice(0, decimalIndex);
                const decimalPart = this.currentAnswer.slice(decimalIndex + 1, decimalIndex + 3);
                this.currentAnswer = `${integerPart}.${decimalPart}`;
            }

            // Verificar si el peso tiene más de dos decimales
            if (decimalCount > 1 || (decimalIndex !== -1 && this.currentAnswer.length - decimalIndex > 3)) {
                this.showErrorMessage = true;
                this.errorMessage = "El peso debe tener máximo dos decimales.";
            } else {
                this.showErrorMessage = false;
            }
        },
        validateAlturaInput() {
            // Validar que la entrada sea un número entero
            this.currentAnswer = this.currentAnswer.replace(/[^\d]/g, ''); // Eliminar todos los caracteres que no sean dígitos
        },


        async registerUser() {
            console.log(this.userData);
            // Filtrar los campos que no estén vacíos
            const filteredUserData = Object.fromEntries(
                Object.entries(this.userData).filter(([key, value]) => value !== "")
            );

            const response = await fetch('fithub.daw.inspedralbes.cat/api/registre', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(filteredUserData), // Enviar solo los datos llenos como cuerpo de la solicitud
            });

            if (!response.ok) {
                // Manejar el caso de error si la respuesta no fue exitosa
                // Puedes mostrar un mensaje de error o manejar la situación de otra manera
                return;
            } else {
                // Convertir la respuesta a formato JSON
                const userDataResponse = await response.json();

                console.log(userDataResponse)

                useUsuariPerfilStore().nom_usuari = filteredUserData.nom;
                useUsuariPerfilStore().email_usuari = filteredUserData.email;
                useUsuariPerfilStore().loguejat = true;
                useUsuariPerfilStore().id_usuari = userDataResponse.idUsuario;
                useUsuariPerfilStore().foto_perfil = "usuario.png";


                this.$router.push('/home');
            }


        }
    }

};
</script>

<style scoped>
/* Estilos de la página de inicio de sesión */

html,
body {
    margin: 0;
    padding: 0;
    height: 100%;
    background-color: #FFA500;
    font-family: Arial, sans-serif;

}

.page-enter-active,
.page-leave-active {
    transition: all 0.4s;
}

.page-enter-from,
.page-leave-to {
    opacity: 0;
    filter: blur(1rem);
}



.progress-bar {
    height: 5px;
    background-color: #ff5100;
    /* Color de la barra de progreso */
    position: fixed;
    top: 0;
    left: 0;
    height: 12px;
    transition: width 0.3s ease;
    /* Transición suave del cambio de ancho */
    z-index: 9999;
    /* Para asegurarse de que la barra de progreso esté en la parte superior */
}

.register-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background-color: #FFA500;
    padding: 0% 10% 0% 10%;
    margin: auto;
}

.question-counter {
    font-size: 1.2rem;
    font-weight: bold;
    margin-bottom: 1rem;
    animation: fadeIn 0.5s ease-in-out;

}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in {
    opacity: 1;
    transition: opacity .5s ease-in-out;
}

.fade-in.active {
    opacity: 0;
}

.logo-container {
    margin-bottom: 1.5rem;
    /* Equivalente a 6px */
}

.logo-image {
    width: 300px;
    height: 300px;
}

.form-container {
    background-color: #FFF;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 0.5rem;
    border: 1px solid #000;
    padding: 2rem;
    margin-bottom: 2.5rem;
    /* Equivalente a 10px */
    width: 300px;
}

.form-field {
    margin-bottom: 1rem;
    /* Equivalente a 4px */
}

.form-label {
    display: block;
    color: #ccc;
    /* Text color */
    font-size: 1.5rem;
    /* Equivalente a 16px */
    font-weight: bold;
    margin-bottom: 0.5rem;
    /* Equivalente a 2px */
}

.registrationQuestion {
    font-size: 2.5rem;
    /* Equivalente a 16px */
    font-weight: bold;
    margin-bottom: 0.5rem;
    /* Equivalente a 2px */
    color: #181818;
    font-weight: bolder;
    animation: fadeIn 0.5s ease-in-out;


}



input {
    width: 100%;
    padding: 0.5rem;
    border: none;
    border-bottom: 3px solid #f1f1f1;
    border-radius: 5px;
    font-size: 1rem;
    color: #333;
    outline: none;
    background-color: transparent;
    margin-bottom: 10px;
    animation: fadeIn 0.5s ease-in-out;


}



.buttons {
    display: grid;
    grid-template-columns: 1fr 1fr;
    font-weight: bolder;
    animation: fadeIn 0.5s ease-in-out;

}

.buttons button {
    margin-top: 10px;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
    width: 80%;
    background-color: #f1f1f1;
    color: #2b2b2b;
    font-weight: bold;
    font-size: 1rem;
    animation: fadeIn 0.5s ease-in-out;


}

.gender-options {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 10px;
    margin-top: 20px;
    margin-bottom: 20px;
}

.gender-option {
    text-align: center;
    border: 2px solid rgb(43, 43, 43);
    border-radius: 5px;
    padding: 10px;
    cursor: pointer;
    transition: border-color 0.3s ease;
}

.gender-option:hover {
    border-color: white;
}

.gender-option input {
    display: none;
}

.form-input {
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #ccc;
    /* Light gray border */
    border-radius: 0.25rem;
    font-size: 1rem;
    /* Equivalente a 14px */
    color: #ccc;
    /* Text color */
    outline: none;
}

.button-container {
    display: flex;
    flex-direction: column;
    /* Botones uno debajo del otro */
    align-items: center;
}

.button {
    margin-top: 0.5rem;
    /* Espacio entre botones */
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
    width: 100%;
}

.loading {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
}

.loading-image {
    width: 100px;
    /* Tamaño deseado para la imagen */
    height: auto;
    /* Mantener la proporción de aspecto */
    animation: spin 2s linear infinite;
    /* Animación de rotación */
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}

.button--primary {
    background-color: #FFA500;
    /* Orange color */
    color: #FFF;
    /* Text color */
    font-weight: bold;
    font-size: 1rem;
    /* Equivalente a 14px */
}

.button--secondary {
    background-color: #FF7F00;
    /* Darker orange color */
    color: #FFF;
    /* Text color */
    font-weight: bold;
    font-size: 1rem;
    /* Equivalente a 14px */
}

.error {
    border-color: red;
}

.form-error {
    color: red;
    font-size: 0.8rem;
    margin-top: 0.5rem;
}

.error-message {
    color: red;
    font-size: 0.8rem;
    margin-top: 0.5rem;
}
</style>
