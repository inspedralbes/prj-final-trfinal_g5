<template>
    <body>
        <div class="login-container">
            <div class="logo-container">
                <img src="../public/logo_fithub.png" alt="FitHub Logo" class="logo-image" />
            </div>
            <!-- Formulario de inicio de sesión -->
            <form class="form-container" @submit.prevent="login">
                <div class="form-field">
                    <label class="form-label" for="username">Correu electrónic:</label>
                    <input v-model="email" class="form-input" type="email" placeholder="Correu electrónic"
                        :class="{ 'error': showError && !isValid }" />
                </div>
                <div class="form-field">
                    <label class="form-label" for="password">Contrasenya:</label>
                    <input v-model="password" class="form-input" type="password" placeholder="Contrasenya"
                        :class="{ 'error': showError && !isValid }" />
                    <p v-if="showError && !isValid" class="form-error">Correu electrónic o contrasenya incorrectes.</p>
                </div>
                <div class="button-container">
                    <button class="button button--primary" type="submit">Iniciar sesió</button>
                    <button class="button button--secondary" type="button" @click="goToRegister">Registre</button>
                </div>
            </form>
        </div>
    </body>
</template>
  
<script>
export default {
    data() {
        return {
            email: '',
            password: '',
            showError: false,
            isValid: true
        };
    },
    methods: {
        async login() {
            if (!this.email || !this.password) {
                // Validar si los campos están vacíos
                this.showError = true;
                this.isValid = false;
                return;
            }

            try {
                const response = await fetch('http://localhost:8000/api/loguejat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        email: this.email,
                        contrasenya: this.password
                    })
                });

                const data = await response.json(); // Convertir la respuesta a JSON

                if (response.ok) {
                    // Si la respuesta es correcta, pero el usuario no está autenticado
                    if (!data.loggedIn) {
                        this.showError = true;
                        this.isValid = false;
                    } else {
                        // Si la autenticación es exitosa y el usuario está autenticado
                        this.$router.push('/home');
                    }
                } else {
                    // Si la respuesta no es correcta, mostrar error
                    this.showError = true;
                    this.isValid = false;
                }
            } catch (error) {
                console.error('Error al iniciar sesión:', error);
                // Manejar el error, por ejemplo, mostrar un mensaje al usuario
                this.showError = true;
                this.isValid = false;
            }
        },
        goToRegister() {
            // Lógica para redirigir a la página de registro
            this.$router.push('/registro');
        }
    }
};
</script>
  
<style scoped >
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
</style>
  