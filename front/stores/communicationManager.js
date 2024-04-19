const url = 'http://localhost:8000/api';// const url = 'http://.daw.inspedralbes.cat/'; //producción
const apiUrl = 'https://api.openai.com/v1/chat/completions'; 
const apiKey = '1234567890';

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

//ejemplo de peticion fetch put

export async function actualizarDatosUsuario(idUsuario, formData) {
    // return new Promise((resolve, reject) => {    
    //     fetch(`http://localhost:8000/api/editar-usuari/${idUsuario}`, {    
    //         method: 'PUT',    
    //         headers: {    
    //             'Content-Type': 'application/json'    
    //         },    
    //         body: JSON.stringify(formData)    
    //     })    
    //     .then(response => {    
    //         if (response.ok) {    
    //             resolve('Datos actualizados exitosamente', response.json());    
    //         } else {    
    //             reject('Error al actualizar los datos del usuario: ' + response.statusText);    
    //         }    
    //     })    
    //     .catch(error => {    
    //         reject('Error de red al actualizar los datos del usuario: ' + error.message);    
    //     });    
    // });

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

export async function enviarMensajeOpenAIRutina(message) {
    try {
        const payload = {
            model: 'gpt-3.5-turbo',
            messages: [
                {
                    role: 'system',
                    content: 'You are a helpful assistant.'
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

export async function enviarMensajeOpenAI(message) {
    try {
        const payload = {
            model: 'gpt-3.5-turbo',
            messages: [
                {
                    role: 'system',
                    content: 'You are a helpful assistant.'
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

export async function enviarMensajeOpenAIDieta(message) {
    try {
        const payload = {
            model: 'gpt-3.5-turbo',
            messages: [
                {
                    role: 'system',
                    content: 'You are a helpful assistant.'
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
    }catch (error) {
        throw new Error('Error al enviar el mensaje a OpenAI: ' + error.message);
    }
}
