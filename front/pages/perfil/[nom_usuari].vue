<template>

    <body>
        <div>
            <div class="flex-container">
                <capçalera />
                <form @submit.prevent="guardarDatosUsuario" enctype="multipart/form-data">
                    <div class="user-info-container">
                        <div v-if="errorMessage" class="error-message">{{ errorMessage }}</div>
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
                            <label>Altura:</label>
                            <input type="text" placeholder="Altura (cm)" v-model="usuario.altura"
                                @input="validateAltura" maxlength="4">
                        </div>
                        <div class="input-container">
                            <label>Pes:</label>
                            <input type="text" placeholder="Pes (kg)" v-model="usuario.pes" @input="validatePeso"
                                maxlength="6">
                        </div>
                        <div class="input-container">
                            <label>Gènere:</label>
                            <select v-model="usuario.genere">
                                <option value="Home">Home</option>
                                <option value="Dona">Dona</option>
                                <option value="Altres">Altres</option>
                            </select>
                        </div>
                        <div class="input-container">
                            <label>Alergia/Intolerancia:</label>
                            <label>Opcional</label>
                            <textarea placeholder="Introdueix la teva alergia o intolerencia"
                                v-model="usuario.alergia_intolerancia"
                                @input="validateInput($event, 'alergia_intolerancia')" maxlength="255"></textarea>
                        </div>
                        <div class="input-container">
                            <label>Lesió:</label>
                            <label>Opcional</label>
                            <textarea placeholder="Introdueix la teva lesió" v-model="usuario.lesio"
                                @input="validateInput($event, 'lesio')" maxlength="255"></textarea>
                        </div>

                        <div class="input-container">
                            <label>Foto de Perfil:</label>
                            <input type="file" name="foto_perfil" @change="onFileChange">
                        </div>
                        <button type="submit" class="large-button">Guardar</button>
                    </div>
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
            // Filtrar los campos modificados
            const usuarioModificado = {};
            for (const key in this.usuario) {
                // Verificar si el valor ha sido modificado
                if (this.usuario[key] !== this.datosOriginales[key]) {
                    usuarioModificado[key] = this.usuario[key];
                }
            }

            // Realizar la solicitud PUT al servidor con los datos modificados
            const store = useUsuariPerfilStore();
            const idUsuario = store.id_usuari;
            console.log('Datos del usuario a enviar:', usuarioModificado);
            fetch('http://localhost:8000/api/editar-usuari/' + idUsuario, {
                method: 'PUT',
                body: JSON.stringify(usuarioModificado),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    console.log('Datos del usuario actualizados:', data);
                    // Verificar si el nombre ha sido modificado y actualizar la tienda solo si es así
                    if (usuarioModificado.nom) {
                        useUsuariPerfilStore().nom_usuari = usuarioModificado.nom;
                    }
                    
                    // Actualizar los datos originales con los datos modificados
                    this.datosOriginales = { ...this.datosOriginales, ...usuarioModificado };
                })
                .catch(error => {
                    console.error('Error al actualizar los datos del usuario:', error);
                });
                this.$router.push('/home');

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

.flex-container {
    display: flex;
    flex-direction: column;
    align-items: stretch;
    min-height: 100vh;
    background-color: #FFF;
}

.user-info-container {
    margin-top: 20px;
    display: flex;
    flex-direction: column;
    padding: 0 20px;
}

.input-container {
    display: flex;
    margin-bottom: 10px;
}

.input-container label {
    flex: 1;
    text-align: right;
    margin-right: 10px;
}

.user-info-container label {
    font-weight: bold;
}

.input-container input,
.input-container select {
    flex: 1;
    padding: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.large-button {
    width: 100%;
    max-width: 400px;
    height: 60px;
    margin-top: 20px;
    font-size: 18px;
    font-weight: bold;
    color: #FFF;
    cursor: pointer;
    border: none;
    outline: none;
    background-color: #000000;
    border-radius: 10px;
}

navBar {
    width: 100%;
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px 0;
    position: fixed;
    bottom: 0;
}
</style>
