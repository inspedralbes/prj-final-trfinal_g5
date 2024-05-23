<template>

    <body>
        <div id="main">
            <div class="flex-container">
                <HeaderPerfil />
                <form @submit.prevent="guardarDatosUsuario">
                    <div class="user-info-container">
                        <div class="input-container">
                            <label>Nom:</label>
                            <input type="text" placeholder="Nom" v-model="usuario.nom"
                                @input="capitalizeOnInput($event, 'nom')" maxlength="25">
                        </div>
                        <div class="input-container">
                            <label>Cognoms:</label>
                            <input type="text" placeholder="Cognoms" v-model="usuario.cognoms"
                                @input="capitalizeOnInput($event, 'cognoms')" maxlength="80">
                        </div>
                        <div class="input-container">
                            <label>Nom d'usuari:</label>
                            <input type="text" placeholder="Usuari" v-model="usuario.nom_usuari" maxlength="20">
                        </div>
                        <div class="input-container">
                            <label>Telèfon:</label>
                            <input type="tel" placeholder="ex: 123456789" v-model="usuario.telefon"
                                @input="validatePhoneNumber" maxlength="9">
                        </div>

                        <div class="input-container">
                            <label>Data de naixement:</label>
                            <input type="date" v-model="usuario.data_naixement" @change="validateFecha">
                        </div>
                        <div class="input-container">
                            <label>Gènere:</label><br>
                            <select v-model="usuario.genere">
                                <option value="Home">Home</option>
                                <option value="Dona">Dona</option>
                                <option value="Altres">Altres</option>
                            </select>
                        </div>

                        <div class="input-container">
                            <label>Altura:</label><br>
                            <input type="text" v-model="usuario.altura" placeholder="Altura (cm)"
                                @input="validateAltura" maxlength="4">
                        </div>

                        <div class="input-container">
                            <label>Pes:</label><br>
                            <input type="decimal" v-model="usuario.pes" placeholder="Pes (kg)" maxlength="6">
                        </div>

                        <div class="input-container">
                            <label>Al·lèrgies/Intoleràncies:</label>
                            <textarea placeholder="Introdueix la teva alergia o intolerencia (opcional)"
                                v-model="usuario.alergia_intolerancia"
                                @input="validateInput($event, 'alergia_intolerancia')" maxlength="255"></textarea>
                        </div>
                        <div class="input-container">
                            <label>Lesió:</label>
                            <textarea placeholder="Introdueix la teva lesió (opcional)" v-model="usuario.lesio"
                                @input="validateInput($event, 'lesio')" maxlength="255"></textarea>
                        </div>
                    </div>

                    <div v-if="errorMessage" class="error-message">{{ errorMessage }}</div>
                    <button type="submit" class="large-button" @click="redirectToHome">Guardar</button>

                    <button type="button" class="large-button logout-button"
                        @click="desloguearUsuario">Tanca Sessió</button>
                </form>
                <navBar />


            </div>
        </div>
    </body>
</template>

<script>
import { useUsuariPerfilStore } from '@/stores/index';

export default {
    data() {
        return {
            usuario: {
                nom: '',
                cognoms: '',
                nom_usuari: '',
                email: '',
                telefon: '',
                data_naixement: '',
                altura: '',
                pes: '',
                genere: '',
                alergia_intolerancia: '',
                lesio: '',
                registre: '',
            },
            datosOriginales: {}, // Mantén una copia de los datos originales
            errorMessage: '',
            isSaving: false // Variable de estado para controlar el proceso de guardado

        };
    },
    mounted() {
        this.obtenerDatosUsuario();
    },
    methods: {
        redirectToHome() {
            this.$router.push({ path: '/home' }); // Redirige a la página principal (home)
        },
        obtenerDatosUsuario() {
            const store = useUsuariPerfilStore();
            const idUsuario = store.id_usuari;

            getDatosUsuario(idUsuario)
                .then(data => {
                    this.usuario = data.usuario;
                    this.datosOriginales = { ...data.usuario }; // Guarda una copia de los datos originales
                    // console.log('Datos del usuario obtenidos:', data);
                })
                .catch(error => {
                    // console.error('Error al obtener los datos del usuario:', error);
                });
        },
        guardarDatosUsuario() {
            this.errorMessage = ''; // Limpiar el mensaje de error antes de guardar los datos
            // Verificar si hay errores de validación
            if (this.errorMessage) {
                // Mostrar un mensaje de error y no continuar con el guardado
                return;
            }

            // Verificar si los campos obligatorios están vacíos
            if (!this.usuario.nom || !this.usuario.cognoms || !this.usuario.nom_usuari) {
                this.errorMessage = "Els camps nom, cognoms i nom d'usuari són requerits.";
                return;
            }

            // Verificar si el nom_usuari ha sido modificado y existe
            if (this.usuario.nom_usuari !== this.datosOriginales.nom_usuari) {
                this.comprobarNomUsuari();
            } else {
                // Si el nom_usuari no ha sido modificado o es el mismo que el original, continuar con el guardado
                this.continuarGuardado();
            }
        },
        async comprobarNomUsuari() {
            // console.log(this.usuario.nom_usuari)
            try {
                const response = await fetch('http://localhost:8000/api/comprovarnomusuari', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        nom_usuari: this.usuario.nom_usuari,
                    }),
                });
                const data = await response.json();

                // Verificar si el nom_usuari existe
                if (data.status === 1) {
                    // El nom_usuari ya existe, mostrar mensaje de error
                    this.errorMessage = 'El nom d\'usuari ja existeix. Si us plau, tria un altre.';
                } else if (data.status === 0) {
                    // El nom_usuari no existe, continuar con el guardado
                    this.continuarGuardado();
                }
            } catch (error) {
                console.error('Error al comprobar el nom d\'usuari:', error);
                this.errorMessage = 'S\'ha produït un error al comprovar el nom d\'usuari.';
                this.isSaving = false; // Restablecer la variable de estado a false si hay un error
            }
        },


        continuarGuardado() {
            // Si hay otros campos modificados además de la foto de perfil
            if (this.hayOtrosCamposModificados()) {
                this.guardarDatosUsuarioSinFotoPerfil();
            }
        },


        hayOtrosCamposModificados() {
            // Verifica si hay otros campos modificados además de la foto de perfil
            // Por ejemplo, puedes comprobar si hay algún campo diferente a foto_perfil que esté presente en el objeto usuario y sea diferente de su valor original
            // Aquí estoy asumiendo que this.datosOriginales contiene los datos originales del usuario
            for (const key in this.usuario) {
                if (key !== 'foto_perfil' && this.usuario[key] !== this.datosOriginales[key]) {
                    return true;
                }
            }
            return false;
        },

        guardarDatosUsuarioSinFotoPerfil() {
            // Crear un objeto para almacenar solo los campos modificados
            const camposModificados = {};

            // Comparar los campos modificados con los datos originales
            for (const key in this.usuario) {
                // Verificar si el campo actual es diferente al valor original
                if (this.usuario[key] !== this.datosOriginales[key]) {
                    camposModificados[key] = this.usuario[key]; // Agregar el campo modificado al objeto camposModificados
                }
            }

            // Verificar si hay campos modificados que enviar
            if (Object.keys(camposModificados).length > 0) {
                // Realizar la solicitud PUT al servidor con los campos modificados
                this.enviarDatos(camposModificados);
            } else {
                // No hay campos modificados además de la foto de perfil, no es necesario enviar la solicitud
                this.isSaving = false; // Restablecer la variable de estado a false
            }
        },

        enviarDatos(data) {
            const store = useUsuariPerfilStore();
            const idUsuario = store.id_usuari;
            actualizarDatosUsuario(idUsuario, data) // Llama a la función actualizarDatosUsuario con los datos y el idUsuario
                .then(data => {
                    // console.log('Datos del usuario actualizados:', data);
                    this.$router.push('/home');
                    // console.log('Datos del usuario actualizados:', data);
                    useUsuariPerfilStore().registre = Boolean(Number(data.registre));


                    // Verificar si el nombre ha sido modificado y actualizar la tienda solo si es así
                    if (this.usuario.nom) {
                        useUsuariPerfilStore().nom_usuari = this.usuario.nom;
                    }
                    if (this.usuario.nom_usuari) {
                        useUsuariPerfilStore().username = this.usuario.nom_usuari;
                    }

                    // Actualizar los datos originales con los datos modificados
                    this.datosOriginales = { ...this.datosOriginales, ...this.usuario };

                    // Restablecer la variable de estado a false después de completar el guardado
                    this.isSaving = false;
                })
                .catch(error => {
                    // console.error('Error al actualizar los datos del usuario:', error);
                    // Restablecer la variable de estado a false si hay un error en el guardado
                    this.isSaving = false;
                });
        },

        // Función para capitalizar la primera letra de una cadena
        capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        },
        // Función para capitalizar la primera letra del nombre o apellido mientras se escribe
        capitalizeOnInput(event, property) {
            if (this.usuario[property] && this.usuario[property].length > 0) {
                const inputValue = event.target.value;
                const lastCharIndex = inputValue.length - 1;

                // Verificar si el último carácter es un espacio
                if (lastCharIndex > 0 && inputValue[lastCharIndex - 1] === ' ') {
                    // Convertir el último carácter ingresado en mayúscula
                    this.usuario[property] = inputValue.slice(0, lastCharIndex) + inputValue[lastCharIndex].toUpperCase();
                }
                // Si no hay espacio, solo se capitaliza la primera letra
                else if (inputValue[0] === inputValue[0].toLowerCase()) {
                    // Convertir la primera letra en mayúscula
                    this.usuario[property] = this.capitalizeFirstLetter(inputValue);
                }
            }
        },
        validateAltura(event) {
            // Expresión regular para validar un solo dígito del 1 al 9
            const regex = /^[1-9]$/;

            // Verificar si la entrada del usuario coincide con la expresión regular
            if (!regex.test(event.target.value)) {
                // Si no coincide, eliminar los caracteres no válidos
                this.usuario.altura = event.target.value.replace(/[^1-9]/g, '');
            }
        },

        validatePhoneNumber() {
            // Verifica si el número de teléfono está vacío o tiene 9 caracteres
            if (this.usuario.telefon && this.usuario.telefon.length !== 9) {
                this.usuario.telefon = this.usuario.telefon.replace(/\D/g, '');

                this.errorMessage = 'El número de teléfono debe tener 9 caracteres.';
            } else {
                this.errorMessage = ''; // Limpiar el mensaje de error si la validación es exitosa
            }
        },

        validateFecha() {
            // Verifica si la fecha de nacimiento está presente
            if (!this.usuario.data_naixement) {
                // Si la fecha de nacimiento está vacía, no se realiza ninguna validación adicional y se limpia el mensaje de error
                this.errorMessage = '';
                return;
            }

            // Si la fecha de nacimiento no está vacía, realiza la validación adicional
            const birthDate = new Date(this.usuario.data_naixement);
            const minDate = new Date('1900-01-01');
            const maxDate = new Date();

            if (birthDate < minDate || birthDate > maxDate) {
                // Actualiza el mensaje de error si la fecha de nacimiento está fuera del rango deseado
                this.errorMessage = 'La fecha de nacimiento debe estar entre 1900 y la fecha actual.';
            } else {
                this.errorMessage = ''; // Limpia el mensaje de error si la validación es exitosa
            }
        },

        validateAltura(event) {
            // Expresión regular para permitir solo números
            const regex = /^[0-9]*$/;
            // Verificar si la entrada del usuario coincide con la expresión regular
            if (!regex.test(event.target.value)) {
                // Si no coincide, eliminar los caracteres no válidos
                this.usuario.altura = event.target.value.replace(/[^0-9]/g, '');
            }
        },
        validatePeso(event) {
            // Expresión regular para permitir solo números y un único punto como separador decimal
            const regex = /^[0-9]+(\.[0-9]{0,2})?$/;
            // Verificar si la entrada del usuario coincide con la expresión regular
            if (!regex.test(event.target.value)) {
                // Si no coincide, eliminar los caracteres no válidos
                this.usuario.pes = event.target.value.replace(/[^0-9.]/g, '');

                // Si hay más de un punto, eliminar todos los puntos adicionales
                const periods = this.usuario.pes.match(/\./g);
                if (periods && periods.length > 1) {
                    this.usuario.pes = this.usuario.pes.replace(/\./g, (match, offset) => {
                        return offset === this.usuario.pes.lastIndexOf('.') ? '.' : '';
                    });
                }

                // Si hay más de dos decimales, recortarlos
                const decimalIndex = this.usuario.pes.indexOf('.');
                if (decimalIndex !== -1) {
                    const decimalPart = this.usuario.pes.substring(decimalIndex + 1);
                    if (decimalPart.length > 2) {
                        this.usuario.pes = this.usuario.pes.substring(0, decimalIndex + 3);
                    }
                }
            }
        },
        validateInput(event, property) {
            // Para alergias y lesiones, no se aplicarán restricciones
            if (property === 'alergia_intolerancia' || property === 'lesio') {
                this.usuario[property] = event.target.value;
            } else {
                // Expresión regular para permitir solo letras, números y espacios
                const regex = /^[A-Za-z0-9\s]*$/;
                // Verificar si la entrada del usuario coincide con la expresión regular
                if (!regex.test(event.target.value)) {
                    // Si no coincide, eliminar los caracteres no válidos
                    this.usuario[property] = event.target.value.replace(/[^A-Za-z0-9\s]/g, '');
                }
            }
        },
        desloguearUsuario() {
            const store = useUsuariPerfilStore();
            store.id_usuari = '';
            store.username = '';
            store.nom_usuari = '';
            store.registre = false;
            store.foto_perfil = '';
            store.email_usuari = '';
            store.tipus_usuari = '';
            this.$router.push('/');
        },
    },
};
</script>
<style scoped>
@import url('https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap');

html,
body {
    margin: 0;
    padding: 0;
    height: 100%;
    overflow-x: hidden;
}

body {
    font-family: 'M PLUS Rounded 1c', Arial, sans-serif;
}

#main {
    position: relative;
}

.flex-container {
    display: flex;
    flex-direction: column;
    align-items: stretch;
    min-height: 100vh;
}


.user-info-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 30px;
    /* margin: auto; */
    margin-left: 15px;
    margin-top: -30px;
    width: 90%;
}

input {
    background-color: transparent;
    padding: 2rem;
    margin-bottom: 2.5rem;
    width: 100%;

}

textarea {
    background-color: #dddddd;
    border-radius: 5px;

}


.user-info-container label {
    font-weight: bold;
}

.input-container input,
.input-container select {
    flex: 1;
    padding: 5px;
    border-radius: 5px;
    border: none;
    border-bottom: 2px solid #ccc;

}

.large-button {
    width: 100%;
    height: 50px;
    font-size: 18px;
    font-weight: bold;
    color: #FFF;
    cursor: pointer;
    border: none;
    outline: none;
    background-color: #FFA500;
    border-radius: 50px;
    margin: auto;
    margin-top: 30px;

}

.logout-button {
    background-color: #FF4500;
    /* Puedes elegir el color que prefieras */
    margin-top: 30px;
    width: 50%;
    margin-bottom: -20px;
}

form {
    display: grid;
    grid-template-columns: 1fr;
    margin: auto;
    padding: 20px;
    padding-top: 40px;
    border-radius: 20px;
    margin-top: 0;
    margin-bottom: 20px;
}

.error-message {
    color: red;
    text-align: center;
    margin-top: 20px;
}
</style>
