const url = 'http://localhost:8000/api';
//const url = 'http://fithub.daw.inspedralbes.cat/back/public/api';
const apiUrl = 'https://api.openai.com/v1/chat/completions';
const apiKey = '';


//ejemplo de peticion fetch get

export function getDatosUsuario(idUsuario) {
    return new Promise((resolve, reject) => {
        fetch(`${url}/usuari/${idUsuario}`)
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    reject('Error al obtener los datos del usuario: ' + response.statusText);
                }
            })
            .then(data => {
                resolve(data);
            })
            .catch(error => {
                reject('Error de red al obtener los datos del usuario: ' + error.message);
            });
    });
}

export async function getDatosUsuario2(idUsuario) {
    try {
        const response = await fetch(`${url}/usuari/${idUsuario}`);
        if (!response.ok) {
            throw new Error('Error al obtener los datos del usuario: ' + response.statusText);
        }

        const data = await response.json();
        return data; // Devuelve los datos del usuario en JSON
    }
    catch (error) {
        throw new Error('Error de red al obtener los datos del usuario: ' + error.message);
    }
}

export function getTotosUsuaris() {
    return new Promise((resolve, reject) => {
        fetch(`${url}/tots-usuaris`)
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    reject('Error al obtener los usuarios: ' + response.statusText);
                }
            })
            .then(data => {
                resolve(data);
            })
            .catch(error => {
                reject('Error de red al obtener los usuarios: ' + error.message);
            });
    });
}


export async function getDatosEjercicio() {
    try {
        const response = await fetch(`${url}/exercicis`);
        if (!response.ok) {
            throw new Error('Error al obtener los datos del ejercicio: ' + response.statusText);
        }

        const data = await response.json();
        return data; // Devuelve los datos del ejercicio en JSON
    } catch (error) {
        throw new Error('Error de red al obtener los datos del ejercicio: ' + error.message);
    }
}

export async function getDatosAliments() {
    try {
        const response = await fetch(`${url}/aliments`);
        if (!response.ok) {
            throw new Error('Error al obtener los datos del alimento: ' + response.statusText);
        }

        const data = await response.json();
        return data; // Devuelve los datos del alimento en JSON
    } catch (error) {
        throw new Error('Error de red al obtener los datos del alimento: ' + error.message);
    }
}

export async function getRutina(idUsuario) {
    try {
        const response = await fetch(`${url}/rutina/${idUsuario}`);
        if (!response.ok) {
            throw new Error('Error al obtener los datos del ejercicio: ' + response.statusText);
        }
        const data = await response.json();
        return data;
    } catch (error) {
        throw new Error('Error de red al obtener los datos del ejercicio: ' + error.message);
    }
}

export async function getDieta(idUsuario) {
    try {
        const response = await fetch(`${url}/dieta/${idUsuario}`);
        if (!response.ok) {
            throw new Error('Error al obtener los datos de la dieta: ' + response.statusText);
        }
        const data = await response.json();
        return data;
    } catch (error) {
        throw new Error('Error de red al obtener los datos de la dieta: ' + error.message);
    }
}

//ejemplo de peticion fetch post

export async function iniciarSesion(email, contrasenya) {
    try {
        const response = await fetch(`${url}/loguejat`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                email: email,
                contrasenya: contrasenya,
            }),
        });


        if (!response.ok) {
            throw new Error('Error en la solicitud fetch: ' + response.statusText);
        }


        const data = await response.json();
        return data;
    } catch (error) {
        throw new Error('Error en la solicitud fetch: ' + error.message);
    }
}

export async function enviarRutinaAlServidor(rutina) {
    try {
        const response = await fetch(`${url}/guardar-rutina`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(rutina),
        });

        if (!response.ok) {
            throw new Error('Error al enviar la rutina al servidor');
        }

        const data = await response.json();
        console.log('datos guardados correctamente');
        return data; // Puedes modificar esto si el servidor responde con algún dato específico
    } catch (error) {
        throw new Error('Error al enviar la rutina al servidor: ' + error.message);
    }
}

export async function enviarDietaAlServidor(rutina) {
    try {
        const response = await fetch(`${url}/guardar-dieta`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(rutina),
        });

        if (!response.ok) {
            throw new Error('Error al enviar la rutina al servidor');
        }

        const data = await response.json();
        console.log('datos guardados correctamente');
        return data; // Puedes modificar esto si el servidor responde con algún dato específico
    } catch (error) {
        throw new Error('Error al enviar la rutina al servidor: ' + error.message);
    }
}



//ejemplo de peticion fetch put


export async function actualizarDatosUsuario(idUsuario, formData) {
    let response = await fetch(`${url}/editar-usuari/${idUsuario}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    let data = await response.json();
    return data;
}

// fetch de delete

export async function borrarRutina(idUsuario) {
    try {
        const response = await fetch(`${url}/eliminar-rutina/${idUsuario}`, {
            method: 'DELETE',
        });

        if (!response.ok) {
            throw new Error('Error al borrar la rutina');
        }

        const data = await response.json();
        console.log('Rutina borrada correctamente');
        return data; // Puedes modificar esto si el servidor responde con algún dato específico
    } catch (error) {
        throw new Error('Error al borrar la rutina: ' + error.message);
    }
}

export async function borrarRutinaDia(idUsuario) {
    try {
        const response = await fetch(`${url}/eliminar-rutina-hoy/${idUsuario}`, {
            method: 'DELETE',
        });

        if (!response.ok) {
            throw new Error('Error al borrar la rutina');
        }

        const data = await response.json();
        console.log('Rutina borrada correctamente');
        return data; // Puedes modificar esto si el servidor responde con algún dato específico
    } catch (error) {
        throw new Error('Error al borrar la rutina: ' + error.message);
    }
}


export async function borrarDieta(idUsuario) {
    try {
        const response = await fetch(`${url}/eliminar-dieta/${idUsuario}`, {
            method: 'DELETE',
        });

        if (!response.ok) {
            throw new Error('Error al borrar la dieta');
        }

        const data = await response.json();
        console.log('Dieta borrada correctamente');
        return data; // Puedes modificar esto si el servidor responde con algún dato específico
    } catch (error) {
        throw new Error('Error al borrar la dieta: ' + error.message);
    }
}

export async function borrarDietaHoy(idUsuario) {
    try {
        const response = await fetch(`${url}/eliminar-dieta-hoy/${idUsuario}`, {
            method: 'DELETE',
        });

        if (!response.ok) {
            throw new Error('Error al borrar la dieta');
        }

        const data = await response.json();
        console.log('Dieta borrada correctamente');
        return data; // Puedes modificar esto si el servidor responde con algún dato específico
    } catch (error) {
        throw new Error('Error al borrar la dieta: ' + error.message);
    }
}

export async function borrarUsuari(idUsuario) {
    try {
        const response = await fetch(`${url}/eliminar-usuari/${idUsuario}`, { // Ajusta la URL según tu backend
            method: 'DELETE',
        });

        if (!response.ok) {
            throw new Error('Error al borrar el usuario');
        }

        const data = await response.json();
        console.log('Usuario borrado correctamente');
        return data; // Puedes modificar esto si el servidor responde con algún dato específico
    } catch (error) {
        throw new Error('Error al borrar el usuario: ' + error.message);
    }
}

export async function deleteRutinaByDate(idUsuario, fecha) {
    try {
        const response = await fetch(`${url}/rutinas/${idUsuario}/${fecha}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            const errorData = await response.json();
            throw new Error(errorData.error || 'Error al eliminar la rutina');
        }

        return await response.json();
    } catch (error) {
        throw new Error('Error al borrar el usuario: ' + error.message);
    }
}

export async function deleteDietaByDate(idUsuario, fecha) {
    try {
        const response = await fetch(`${url}/rutinas/${idUsuario}/${fecha}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            const errorData = await response.json();
            throw new Error(errorData.error || 'Error al eliminar la rutina');
        }

        return await response.json();
    } catch (error) {
        throw new Error('Error al borrar el usuario: ' + error.message);
    }
}

//fetch para la api de openai


export async function enviarMensajeOpenAIRutina(message, ejercicios, daotsUsuario) {
    try {
        const payload = {
            model: 'gpt-3.5-turbo',
            messages: [
                {
                    role: 'system',
                    content: "Ets una persona que només parla en català i tens prohibit parlar d'alguna cosa que no tingui relació amb el fitness ja que ets un expert en fitness només tens permès parlar de fer rutines." +
                        " Si et demanen alguna cosa que no sigui una rutina digues el següent: En aquest apartat només puc donar consells de nutrició i generar rutines. " +
                        " Pots donar consells i arguments però fes-ho de forma resumida en unes 2 línies a menys que t'indiquin que volen més informació." +
                        " Nomes pots respondre amb format JSON quan i seguint aquesta estructura:" +
                        " { id_usuari:'', dias:[{dia: '1', exercicis: [{'nom_exercici':'','series':'','repeticions':'','id_exercici':''},...]},...]}" +
                        " Segueix aquesta estructura de JSON pero posa per dia un minim de 5 exercicis i un maxim de 7 exercicis." +
                        " Fes un grup muscular per dia i no repetir exercicis en la mateixa rutina. A no ser que et digui el contrari o algo mes concret." +
                        " Si en el missatge conte dies fes la rutina dels dies que et demanen; si no fes una rutina de 5 dies." +
                        " Agafa les dades del usuari per fer rutines mes personalitzades i tambe agafa el id del usuari per posarlo a id_usuari.",
                },
                {
                    role: 'system',
                    content: JSON.stringify(ejercicios)
                },
                {
                    role: 'system',
                    content: JSON.stringify(daotsUsuario)
                },
                {
                    role: 'user',
                    content: message
                },

            ]

        };

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
        const generatedText = data.choices[0].message.content;

        return generatedText;
    } catch (error) {
        throw new Error('Error al enviar el mensaje a OpenAI: ' + error.message);
    }
}



export async function enviarMensajeOpenAIDieta(message, aliments, datosUsuario) {
    try {
        const payload = {
            model: 'gpt-3.5-turbo',
            messages: [
                {
                    role: 'system',
                    content: " Eres una persona que solo habla catalán y tienes prohibido hablar de nada que no esté relacionado con el fitness y la nutrición porque eres un experto en nutrición y fitness pero tienes muy prohibido hacer rutinas y dietas. " +
                        " Si te piden una rutina di lo siguiente: En esta sección solo puedo dar consejos de nutrición y deporte si quieres generar rutinas ve a la sección de Rutinas y si quieres una dieta en la sección de Dietas. " +
                        " Si puedes dar consejos y argumentos pero hacerlo de forma resumida en 2 líneas, que no te digan que quieren más información." +
                        " Coje los alimentos y toda la información que encuentres en el json de alimentos para crear la dieta. " +
                        " Sólo puedes responder con formato JSON y siguiendo esta estructura: " +
                        " {id_usuari:'',apats:[apat:'',plats:[{nom_plat:'',ingredients:[nom_ingredient:'',quantitat:'',unitat:''],proteines:'',carbohidrats:'',greixos:'',caloreis:''},],apat:'',plats:[nom_plat:'',...],apat:'',plats:[nom_plat:'',...]]}" +
                        // " Si te piden definicion o adelgazar o definir, toma platos que sean para ello; si quieren volumen, ganar mucho músculo o ganar peso toma los platos necesarios para ello. Si no te especifican una dieta neutra" +
                        " Coge los datos del usuario para hacer dietas más personalizadas y también coge el id del usuario para ponerlo en id_usuari." +
                        " Haz que las 5 comdias diarias sean: desayuno, segundo desayuno, comida, merienda y cena. " +
                        " Para cada comida diaria ponle 3 platos para cada una de las 5 comidas. Si te piden algo más concreto hazlo de forma más concreta.",
                },
                {
                    role: 'user',
                    content: message
                },
                {
                    role: 'system',
                    content: JSON.stringify(datosUsuario)
                },
                {
                    role: 'system',
                    content: JSON.stringify(aliments)
                },
            ]
        };


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
        const generatedText = data.choices[0].message.content;

        return generatedText;
    } catch (error) {
        throw new Error('Error al enviar el mensaje a OpenAI: ' + error.message);
    }
}


export async function enviarMensajeOpenAI(message) {
    try {
        const payload = {
            model: 'gpt-3.5-turbo',
            messages: [
                {
                    role: 'system',
                    content: "Ets una persona que només parla en català i tens prohibit parlar d'alguna cosa que no tingui relació amb la nutrició ja que ets un expert en nutrició només tens permès parlar de fer dietes. Si et demanen alguna cosa que no sigui una dieta digues el següent: En aquest apartat només puc donar consells de nutrició i generar dietes. Puc donar consells i arguments però fes-ho de forma resumida en unes 2 línies a menys que t'indiquin que volen més informació.",
                },
                {
                    role: 'user',
                    content: message
                }
            ]
        };


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
        const generatedText = data.choices[0].message.content;


        return generatedText;
    } catch (error) {
        throw new Error('Error al enviar el mensaje a OpenAI: ' + error.message);
    }
}
