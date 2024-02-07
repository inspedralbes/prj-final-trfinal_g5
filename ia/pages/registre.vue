<template>
    <div class="login-container">
        <div class="logo-container">
            <img src="../public/logo_fithub.png" alt="FitHub Logo" class="logo-image" />
        </div>
        <div v-if="showStartButton">
            <div class="button-container">
                <button class="button button--primary" @click="startRegistration">Empezar Registro</button>
                <button class="button button--secondary" type="button" @click="goToLogin">Iniciar sesión</button>
            </div>
        </div>

        <div v-else>
            <div v-if="currentQuestionIndex < registrationQuestions.length">
                <h2>{{ registrationQuestions[currentQuestionIndex].question }}</h2>
                <textarea v-if="registrationQuestions[currentQuestionIndex].inputType === 'textarea'"
                    v-model="currentAnswer" placeholder="Escribe tu respuesta"></textarea>
                <input v-else-if="registrationQuestions[currentQuestionIndex].inputType === 'email'" v-model="currentAnswer"
                    type="email" placeholder="Correo electrónico" @input="validateEmailInput">
                <input v-else-if="registrationQuestions[currentQuestionIndex].inputType === 'password'"
                    v-model="currentAnswer" type="password" placeholder="Contraseña">
                <input v-else-if="registrationQuestions[currentQuestionIndex].inputType === 'nom'" v-model="currentAnswer"
                    type="text" placeholder="Nom" @input="validateNameInput">
                <input v-else-if="registrationQuestions[currentQuestionIndex].inputType === 'cognoms'"
                    v-model="currentAnswer" type="text" placeholder="Cognoms" @input="validateNameInput">
                <input v-else-if="registrationQuestions[currentQuestionIndex].inputType === 'pes'" v-model="currentAnswer"
                    type="text" placeholder="Pes" @input="validateNumberInput">
                <input v-else-if="registrationQuestions[currentQuestionIndex].inputType === 'altura'"
                    v-model="currentAnswer" type="text" placeholder="Altura" @input="validateNumberInput">
                <input v-else-if="registrationQuestions[currentQuestionIndex].inputType === 'telefon'"
                    v-model="currentAnswer" type="text" placeholder="Numero de telefon" @input="validateTelefonInput">
                <input v-else-if="registrationQuestions[currentQuestionIndex].inputType === 'date'" v-model="currentAnswer"
                    type="date">
                <div v-for="(option, index) in registrationQuestions[currentQuestionIndex].respuesta" :key="index">
                    <input type="radio" :id="'option' + index" :value="option" v-model="currentAnswer">
                    <label :for="'option' + index">{{ option }}</label>
                </div>

                <div v-if="showErrorMessage" class="error-message">
                    {{ errorMessage }}
                </div>
                <button @click="seguentPregunta">Seguent</button>
                <button @click="saltarPregunta">Saltar</button>
            </div>
            <div v-else>
                <p>¡Registro completado! Gracias por registrarte.</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            showStartButton: true,
            errorMessage: "",
            showErrorMessage: false,
            currentQuestionIndex: 0,
            currentAnswer: "",
            selectedOptions: [],
            phoneNumberValid: false,
            userData: {
                email: "",
                contrasenya: "",
                nom: "",
                cognoms: "",
                dataNaixement: "",
                genere: "",
                pes: "",
                altura: "",
                telefon: ""
            },
            registrationQuestions: [
                {
                    question: "Quin es el teu correu electronic?",
                    inputType: 'email',
                    required: true,

                },
                {
                    question: "Quina es la teva contrasenya?",
                    inputType: 'password',
                    required: true,

                },
                {
                    question: "Quin es el teu nom?",
                    inputType: 'nom',
                    required: true,

                },
                {
                    question: "Quin es el teu cognoms?",
                    inputType: 'cognoms',
                    required: true,

                },
                {
                    question: "Quin es la teva data de naixement?",
                    inputType: 'date',
                },
                {
                    question: "Quin es el teu genere?",
                    inputType: 'checkbox',
                    respuesta: ['Home', 'Dona', 'Altres'],
                },


                {
                    question: "Quin es el teu pes?",
                    inputType: 'pes',
                },
                {
                    question: "Quina es la teva altura?",
                    inputType: 'altura',
                },
                {
                    question: "Quin es el teu numero de telefon?",
                    inputType: 'telefon',
                }

            ],
            showErrorMessage: false,
        };
    },
    methods: {
        startRegistration() {
            this.showStartButton = false;
        },
        async seguentPregunta() {
            if (this.currentQuestionIndex === this.registrationQuestions.length - 1) {
                // Si es la última pregunta, llamar a registerUser
                console.log('Registrando usuario...');
                await this.registerUser();
            } else {
                // Verificar si la pregunta actual es requerida y si la respuesta está vacía
                const currentQuestion = this.registrationQuestions[this.currentQuestionIndex];
                this.userData[currentQuestion.inputType] = this.currentAnswer;
                if (currentQuestion.required && this.currentAnswer.trim() === "") {
                    this.showErrorMessage = true;
                    this.errorMessage = "Por favor, responde a esta pregunta antes de continuar.";
                    return;
                }

                // Reiniciar el mensaje de error
                this.showErrorMessage = false;

                // Validar la entrada según el tipo de pregunta
                switch (currentQuestion.inputType) {
                    case 'date':
                        const selectedDate = new Date(this.currentAnswer);
                        const today = new Date();
                        if (selectedDate > today) {
                            this.errorMessage = "La fecha de nacimiento no puede ser en el futuro.";
                            this.showErrorMessage = true;
                            return;
                        }
                        break;
                    case 'email':
                        this.validateEmailInput(); // Validar el correo electrónico
                        if (this.showErrorMessage) {
                            return; // No avanzar si hay un error en el correo electrónico
                        }
                        break;
                    case 'telefon':
                        this.validateTelefonInput(); // Validar el número de teléfono
                        if (!this.phoneNumberValid) {
                            this.errorMessage = 'Por favor, introduce un número de teléfono válido.';
                            this.showErrorMessage = true;
                            return; // Detener el proceso si hay un error
                        }
                        break;
                    default:
                        break;
                }

                // Agregar el console.log aquí para mostrar la pregunta y respuesta actual antes de avanzar a la siguiente pregunta
                console.log(`Pregunta ${this.currentQuestionIndex + 1}: ${currentQuestion.question}`);
                console.log(`Respuesta: ${this.currentAnswer}`);


                // Incrementar el índice de la pregunta y restablecer la respuesta actual
                this.currentQuestionIndex++;
                this.currentAnswer = "";
            }
        },

        async saltarPregunta() {
            const currentQuestion = this.registrationQuestions[this.currentQuestionIndex];
            this.userData[currentQuestion.inputType] = this.currentAnswer;

            if (this.currentQuestionIndex === this.registrationQuestions.length - 1) {
                // Si es la última pregunta, llamar a registerUser
                console.log('Registrando usuario...');
                await this.registerUser();
            } else {
                // Verificar si la pregunta actual es requerida y si la respuesta está vacía o si se ha escrito algo
                if (currentQuestion.required && this.currentAnswer.trim() === "") {
                    this.showErrorMessage = true;
                    this.errorMessage = "Por favor, responde a esta pregunta antes de continuar.";
                    return;
                }

                // Reiniciar el mensaje de error
                this.showErrorMessage = false;

                // Agregar el console.log aquí para mostrar la pregunta y respuesta actual antes de saltar a la siguiente pregunta
                console.log(`Pregunta ${this.currentQuestionIndex + 1}: ${currentQuestion.question}`);
                console.log(`Respuesta: ${this.currentAnswer}`);

                // Incrementar el índice de la pregunta
                this.currentQuestionIndex++;

                // Reiniciar la respuesta actual
                this.currentAnswer = "";

                // Verificar si la siguiente pregunta es requerida y si ya se ha respondido
                const nextQuestion = this.registrationQuestions[this.currentQuestionIndex];
                if (nextQuestion && nextQuestion.required && this.currentAnswer.trim() === "") {
                    this.showErrorMessage = true;
                    this.errorMessage = "Por favor, responde a esta pregunta antes de continuar.";
                    // Retroceder al índice de la pregunta actual
                    this.currentQuestionIndex--;
                    return; // Salir de la función si hay un error
                }

                // Si es la última pregunta, registra al usuario
                if (this.currentQuestionIndex === this.registrationQuestions.length - 1) {
                    await this.registerUser();
                }
            }
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
            this.phoneNumberValid = this.currentAnswer.length === 9;

            // Reiniciar el mensaje de error si la validación es exitosa
            this.showErrorMessage = false;
        },
        validateNameInput() {
            // Eliminar caracteres no alfabéticos del nombre
            this.currentAnswer = this.currentAnswer.replace(/[^A-Za-zÀ-ÿ\s]/g, '');

            // Convertir la primera letra de cada palabra a mayúscula
            this.currentAnswer = this.currentAnswer.replace(/\b\w/g, match => match.toUpperCase());
        },
        validateEmailInput() {
            // Validar el correo electrónico como se muestra en la respuesta anterior
            // Si hay un error, establecer el mensaje de error
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            if (!emailRegex.test(this.currentAnswer)) {
                this.errorMessage = 'El formato del correo electrónico es incorrecto.';
                this.showErrorMessage = true; // Mostrar el mensaje de error
                return;
            }

            const allowedDomains = ['gmail.com', 'hotmail.com'];
            const domain = this.currentAnswer.split('@')[1];
            if (!allowedDomains.includes(domain)) {
                this.errorMessage = 'Solo se permiten correos electrónicos con dominio gmail.com o hotmail.com.';
                this.showErrorMessage = true; // Mostrar el mensaje de error
                return;
            }

            // Si el correo electrónico es válido, asegúrate de que no haya otros mensajes de error
            this.showErrorMessage = false;
        },

        async registerUser() {
            try {
                const userData = {
                    email: this.currentAnswer,
                    contrasenya: this.currentAnswer,
                    nom: this.currentAnswer,
                    cognoms: this.currentAnswer,
                    dataNaixement: this.currentAnswer,
                    genere: this.currentAnswer,
                    pes: this.currentAnswer,
                    altura: this.currentAnswer,
                    telefon: this.currentAnswer,
                };

                // Realizar la solicitud de registro
                const response = await fetch('http://localhost:8000/api/registre', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(userData),

                });

                // Analizar la respuesta JSON
                const responseData = await response.json();

                if (!response.ok) {
                    // Si la respuesta no es exitosa, lanzar un error con el mensaje de error de la respuesta
                    throw new Error(`Error al registrar usuario: ${responseData.message}`);
                }

                // Registro exitoso, redirigir al usuario a la página de inicio
                this.$router.push('/home');
            } catch (error) {
                // Error al realizar la solicitud o al procesar la respuesta
                console.error('Error al registrar usuario:', error.message);
                this.errorMessage = 'Se produjo un error al registrar el usuario. Por favor, inténtalo de nuevo más tarde.';
            }
        }


    },
};
</script>

<style scoped>
/* Estilos de la página de inicio de sesión */

html,
body {
    margin: 0;
    padding: 0;
    height: 100%;
}

body {
    font-family: Arial, sans-serif;
    /* Establecer la fuente predeterminada */
    background-color: #f0f0f0;
    /* Color de fondo */
}

.login-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background-color: #FFA500;
    /* Orange color */
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
    color: #333;
    /* Text color */
    font-size: 1.5rem;
    /* Equivalente a 16px */
    font-weight: bold;
    margin-bottom: 0.5rem;
    /* Equivalente a 2px */
}

.form-input {
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #ccc;
    /* Light gray border */
    border-radius: 0.25rem;
    font-size: 1rem;
    /* Equivalente a 14px */
    color: #333;
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