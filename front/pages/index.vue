<template>

    <body>
        <div class="login-container">
            <div class="logo-container">
                <img src="../public/logo_fithub.png" alt="FitHub Logo" class="logo-image" />
            </div>

            <form class="form-container" @submit.prevent="login">
                <div class="form-field">
                    <label class="form-label" for="username">Correu electrònic:</label>
                    <input v-model="email" class="form-input" type="email" placeholder="Correu electrònic"
                        :class="{ 'error': showError && !isValid }" />
                </div>
                <div class="form-field">
                    <label class="form-label" for="contrasenya">Contrasenya:</label>
                    <input v-model="contrasenya" class="form-input" type="password" placeholder="Contrasenya"
                        :class="{ 'error': showError && !isValid }" />
                    <p v-if="showError && !isValid" class="form-error">Correu electrònic o contrasenya incorrectes.</p>
                </div>
                <div class="button-container">
                    <button class="button button--primary" type="submit">Iniciar sessió</button>
                    <button class="button button--secondary" type="button" @click="goToRegister">Registre</button>
                </div>
            </form>
        </div>
    </body>
</template>

<script>
import { iniciarSesion } from '@/stores/communicationManager';
import { useUsuariPerfilStore } from '@/stores/index';

export default {
    data() {
        return {
            email: '',
            contrasenya: '',
            showError: false,
            isValid: true
        };
    },
    methods: {
        async login() {
            try {
                if (!this.email || !this.contrasenya) {
                    this.showError = true;
                    this.isValid = false;
                    return;
                }

                const data = await iniciarSesion(this.email, this.contrasenya);

                if (data.status === 1) {
                    const store = useUsuariPerfilStore();
                    store.iniciarSesionExitoso();
                    store.id_usuari = data.id;
                    store.nom_usuari = data.nom;
                    store.username= data.nom_usuari;
                    store.email_usuari = data.email;
                    store.foto_perfil = data.foto_perfil;
                    store.tipus_usuari = data.tipus;
                    store.registre = Boolean(Number(data.registre));
                    this.$router.push('/home');
                } else {
                    this.showError = true;
                    this.isValid = false;
                }

            } catch (error) {
                // console.error('Error al iniciar sesión:', error);
                this.showError = true;
                this.isValid = false;
            }
        },
        goToRegister() {
            this.$router.push('/registre');
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
}

body {
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