<template>

    <body>
        <div id="main">
            <div class="flex-container">
                <HeaderPerfil />
                <form @submit.prevent="guardarDatosUsuario" enctype="multipart/form-data">
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
                            <label>Correu electrònic:</label>
                            <input type="email" placeholder="Correu electronic" v-model="usuario.email" disabled>
                        </div>
                        <div class="input-container">
                            <label>Telefon:</label>
                            <input type="tel" placeholder="ex: 123456789" v-model="usuario.telefon"
                                @input="validatePhoneNumber" maxlength="9">
                        </div>

                        <div class="input-container">
                            <label>Data naixement:</label>
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
                            <input type="number" v-model="usuario.altura"placeholder="Altura (cm)"maxlength="4">
                        </div>
                        <div class="input-container">
                            <label>Pes:</label><br>
                            <input type="decimal" v-model="usuario.pes" placeholder="Pes (kg)"maxlength="6">
                        </div>

                        <div class="input-container">
                            <label>Alergia/Intolerancia:</label>
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
                    <button type="submit" class="large-button">Guardar</button>

                </form>


            </div>
            <navBar />
        </div>
    </body>
</template>

<script>
import { useUsuariPerfilStore } from '@/stores/index';
import { getDatosUsuario } from '@/stores/communicationManager';

export default {
    data() {
        return {
            usuario: {
                nom: '',
                cognoms: '',
                email: '',
                telefon: '',
                data_naixement: '',
                altura: '',
                pes: '',
                genere: '',
                foto_perfil: {
                    name: '',
                    size: '',
                    type: '',
                    lastModified: '',
                    lastModifiedDate: '',
                },
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
                    console.error('Error al obtener los datos del usuario:', error);
                });
        },
        guardarDatosUsuario() {
            // Verificar si ya se está guardando para evitar múltiples envíos
            if (this.isSaving) return;

            this.isSaving = true; // Establecer la variable de estado a true para indicar que se está guardando

            // Lógica para guardar los datos del usuario
            // Puedes llamar a funciones separadas para manejar la lógica de guardado de la imagen y los otros campos
            // Por ejemplo:
            if (this.usuario.foto_perfil instanceof File) {
                this.guardarFotoPerfil();
            }

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

        guardarFotoPerfil() {
            // Lógica para guardar la foto de perfil
            const reader = new FileReader();
            reader.onload = () => {
                const base64Image = reader.result.split(',')[1]; // Extraer solo el contenido base64

                // Construir el objeto de datos a enviar
                const data = {
                    usuario: this.usuario,
                    foto_perfil_base64: base64Image // Agregar la imagen base64 a los datos del usuario
                };

                // Realizar la solicitud PUT al servidor con los datos del usuario y la imagen en base64
                this.enviarDatos(data);
            };

            // Leer la imagen de perfil como base64
            reader.readAsDataURL(this.usuario.foto_perfil);
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
                    console.log('Datos del usuario actualizados:', data);
                    this.$router.push('/home');


                    const nullFields = Object.values(data).some(value => value === null);
                    useUsuariPerfilStore().registre = !nullFields;

                    // Verificar si el nombre ha sido modificado y actualizar la tienda solo si es así
                    if (this.usuario.nom) {
                        useUsuariPerfilStore().nom_usuari = this.usuario.nom;
                    }
                    if (this.usuario.foto_perfil) {
                        useUsuariPerfilStore().foto_perfil = data.foto_perfil;
                    }

                    // Actualizar los datos originales con los datos modificados
                    this.datosOriginales = { ...this.datosOriginales, ...this.usuario };

                    // Restablecer la variable de estado a false después de completar el guardado
                    this.isSaving = false;
                })
                .catch(error => {
                    console.error('Error al actualizar los datos del usuario:', error);
                    // Restablecer la variable de estado a false si hay un error en el guardado
                    this.isSaving = false;
                });
        },

        onFileChange(event) {
            const file = event.target.files[0]; // Obtener el archivo del evento

            if (file) {
                // Asignar directamente el archivo seleccionado a this.usuario.foto_perfil
                this.usuario.foto_perfil = file;

                // Mostrar en la consola la foto de perfil seleccionada
                console.log('Foto de Perfil seleccionada:', this.usuario.foto_perfil);
            } else {
                console.error('No se seleccionó ningún archivo.');
            }
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
        validatePhoneNumber() {
            if (this.usuario.telefon.length !== 9) {
                this.errorMessage = 'El número de teléfono debe tener 9 caracteres.';
            } else {
                this.errorMessage = ''; // Limpiar el mensaje de error si la validación es exitosa
            }
        },
        validateFecha() {
            const birthDate = new Date(this.usuario.data_naixement);
            const minDate = new Date('1900-01-01');
            const maxDate = new Date();

            if (birthDate < minDate || birthDate > maxDate) {
                // Actualizar el mensaje de error
                this.errorMessage = 'La fecha de nacimiento debe estar entre 1900 y la fecha actual.';
                return false; // Retorna false si la fecha de nacimiento no es válida
            }

            // Limpiar el mensaje de error si la validación es exitosa
            this.errorMessage = '';
            return true; // Retorna true si la fecha de nacimiento es válida
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
        }


    },
};
</script>
<style scoped>
/* Estilos de los divs en el componente */
html,
body {
    margin: 0;
    padding: 0;
    height: 100%;
    overflow-x: hidden;
}

body {
    font-family: Arial, sans-serif;
}

#main {
    position: relative;
}

.flex-container {
    display: flex;
    flex-direction: column;
    align-items: stretch;
    min-height: 100vh;
    background: linear-gradient(to top right, #FFA500, #f44336);
}


.user-info-container {
    margin-top: 5px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 20px;
    margin: auto;
}

input {
    background-color: transparent;
    padding: 2rem;
    margin-bottom: 2.5rem;
    width: 160px;
    
}

textarea{
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
    width: 40%;
    height: 50px;
    margin-top: 20px;
    font-size: 18px;
    font-weight: bold;
    color: #FFF;
    cursor: pointer;
    border: none;
    outline: none;
    background-color: #333;
    border-radius: 50px;
    margin: auto;
    margin-top: 20px;
}

form {
    display: grid;
    grid-template-columns: 1fr;
    margin: auto;
    background-color: #f3f3f3;
    padding: 20px;
    padding-top: 40px;
    border-radius: 20px;
    margin-top: 0;
    width: 85%;
    margin-bottom: 20px;
}
.error-message {
    color: red;
    text-align: center;
    margin-top: 20px;
}
</style>
