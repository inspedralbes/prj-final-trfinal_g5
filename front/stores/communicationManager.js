const url = 'http://localhost:8000/api';
//const url = 'http://fithub.daw.inspedralbes.cat/back/public/api';
const apiUrl = 'https://api.openai.com/v1/chat/completions';
const apiKey = '123456';


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


//fetch para la api de openai


export async function enviarMensajeOpenAIRutina(message, ejercicios, daotsUsuario) {
    try {
        const payload = {
            model: 'gpt-3.5-turbo',
            messages: [
                {
                    role: 'system',

                    content: "Eres un experto en fitness y sólo puedes hablar sobre rutinas de ejercicios y dar consejos e información al respecto. Sigue estas pautas:" +
                    " Si te saludan o dicen algo no relevante, responde cordialmente según el comentario y añade: 'Si necesitas una rutina, indícame de cuántos días la necesitas y quién es tu objetivo.'" +
                    " Si te piden algo que no sea una rutina di lo siguiente: En este apartado sólo puedo dar consejos de nutrición y generar rutinas. " +
                    " Puedes dar consejos y argumentos pero hazlo de forma resumida en unas 2 líneas a menos que te indiquen que quieren más información." +
                    " Sólo puedes responder con formato JSON cuando te pidan una rutina y siguiendo esta estructura:" +
                    " { id_usuario:'', dias:[{día: '1', ejercicios: [{'nombre_ejercicio':'','series':'','repeticiones':'','id_ejercicio':''}, ...]},...]}" +
                    " Sigue esta estructura de JSON para la generación de rutinas, basándote en tus conocimientos para generar rutinas coherentes utilizando el listado de ejercicios proporcionado" + " Haz un grupo muscular por día y no repetir ejercicios en la misma rutina. A no ser que te diga lo contrario o algo más concreto." +
                    " Si en el mensaje cuento los días haz la rutina de los días que te piden; si no hiciera una rutina de 5 días." +
                    " No cometas faltas ortográficas o gramaticales y mantiene un tono educado y respetuoso en todo momento." +
                    " Siempre habla en catalán." +
                    " Coge los datos del usuario para hacer rutinas más personalizadas y también coge el id del usuario para ponerlo a id_usuario.",
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

        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            const data = await response.json();
            const generatedText = data.choices[0].message.content;
            try {
                // Intentar analizar el contenido como JSON
                const jsonContent = JSON.parse(generatedText);
                // Si el análisis tiene éxito, significa que es JSON válido
                // Por lo tanto, podemos devolverlo como está
                return generatedText;
            } catch (error) {
                // Si el análisis falla, significa que no es JSON válido
                // En este caso, devolvemos el texto original
                return generatedText;
            }
        } else {
            // Si la respuesta no está en formato JSON, devolvemos el texto original
            const text = await response.text();
            return text;
        }
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
                    content: "Ets una persona que només parla en catalan i tens prohibit parlar d'alguna cosa que no tingui relacion amb fitnes i nutricion ja que ets un expert en nutricion i fitnes però tens molt prohibit fer rutines i dietes." +
                        " Si et demanen una rutin digues el següent: En aquest apartat només puc donar consells de nutricion i esportius si vols generar rutines veus a l'apartat de Rutines i si vols una dieta en l'apartat de Dietes." +
                        // " Si pots donar consells i arguments però fes-ho de forma resumina en unes 2 línies tret que t'indiquin que volen mes informacion." +
                        " Agafa els aliments i tota l'informacio que troves en el json d'aliments per crear la dieta." +
                        " Nomes pots respondre amb format JSON i seguint aquesta estructura:" +
                        " {id_usuari:{nom_plat:'Macedònia de fruites',apat:'esmorzar',ingredients:[nom_ingredient:'Maduixes',quantitat:'50',unitat:'grams'],proteines:'2.50',carbohidrats:'27.90',greixos:'0.70',caloreis:'127.00',},{nom_plat:'',apat:'segon_esmorzar',...},{nom_plat:'',...},...}" +
                        " Fes 5 apats diaris. I per cada apat posa un minim de 3 plats per apat" +
                        " Si et demanen definicio o perdre pes o definir, agafa plats que siguin per aixo; si volen volum, guanyar massa muscular o guanyar pes agafa els plats necessaris per allo. Si no especifiquen dieta neutral" +
                        " Agafa les dades del usuari per fer dietes mes personalitzades i tambe agafa el id del usuari per posarlo a id_usuari." +
                        " QUIERO 5 COMDIAS DIARIAS DE MI BASE DE DATOS Y CADA COMIDA QUIERO QUE PONGAS 3 PLATOS DE MI BASE DE DATOS Y EL ID DE USUARIO SOLO LO QUIERO 1 VEZ Y EL QUE COJES DEL DATOS USUARIO",
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

        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            const data = await response.json();
            const generatedText = data.choices[0].message.content;
            return generatedText;
        } else {
            throw new Error('La respuesta de OpenAI no está en formato JSON');
        }
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
