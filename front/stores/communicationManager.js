const url = 'http://localhost:8000/api';// const url = 'http://.daw.inspedralbes.cat/'; //producción
const apiUrl = 'https://api.openai.com/v1/chat/completions';
const apiKey = '0123456789';


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
        return data; // Puedes modificar esto si el servidor responde con algún dato específico
    } catch (error) {
        throw new Error('Error al enviar la rutina al servidor: ' + error.message);
    }
}



//ejemplo de peticion fetch put


export async function actualizarDatosUsuario(idUsuario, formData) {
    // return new Promise((resolve, reject) => {   
    //     fetch(`http://localhost:8000/api/editar-usuari/${idUsuario}`, {   
    //         method: 'PUT',   
    //         headers: {   
    //             'Content-Type': 'application/json'   
    //         },   
    //         body: JSON.stringify(formData)   
    //     })   
    //     .then(response => {   
    //         if (response.ok) {   
    //             resolve('Datos actualizados exitosamente', response.json());   
    //         } else {   
    //             reject('Error al actualizar los datos del usuario: ' + response.statusText);   
    //         }   
    //     })   
    //     .catch(error => {   
    //         reject('Error de red al actualizar los datos del usuario: ' + error.message);   
    //     });   
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


export async function enviarMensajeOpenAIRutina(message, ejercicios, daotsUsuario) {
    try {
        const payload = {
            model: 'gpt-3.5-turbo',
            messages: [
                {
                    role: 'system',
                    content: "Ets un expert en fitness i només pots parlar sobre rutines d'exercicis i donar consells i informació sobre aquest tema. Segueix aquestes pautes:" +
                "\n- Si et saluden o diuen alguna cosa no rellevant, respon cordialment segons el comentari i respon: 'Si necessites una rutina, indica'm de quant dies la necessites y quien es el teu objectiu.'" +
                "\n- Si et demanen alguna cosa que no sigui una rutina d'exercicis o informació sobre aquestes, respon: 'En aquest apartat només puc generar rutines i informació sobre aquestes. Qualsevol altra consulta ves a l'apartat d'assessorament.' " +
                "\n- Si et demanen alguna cosa relacionada amb una dieta o nutricio, respon: 'En aquest apartat només puc generar rutines i informació sobre aquestes. Qualsevol consulta d'aquet tipus ves a l'apartat de dietes o assesorament.' " +
                "\n- Pots proporcionar consells i arguments, però de forma resumida en unes 2 línies, a menys que se sol·liciti més informació.'" +
                "\n- Només pots respondre amb format JSON seguint aquesta estructura:"+
                "\n- { id_usuari:'', dias:[{dia: '1', exercicis: [{'nom_exercici':'','series':'','repeticions':'','id_exercici':''},...]},...]}"+
                "\n- Segueix aquesta estructura de JSON per a la generació de rutines, basant-te en els teus coneixements per generar rutines coherents utilitzant el llistat d'exercicis proporcionat" +
                "\n- No pots crear una rutina si no s'especifiquen el nombre de dies. En aquest cas, pregunta els dies primer." +
                "\n- No cometis faltes ortogràfiques o gramaticals i mantén un to educat i respectuós en tot moment."+
                "\n- Sempre parla en catala."},

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



export async function enviarMensajeOpenAI(message) {
    try {
        const payload = {
            model: 'gpt-3.5-turbo',
            messages: [
                {
                    role: 'system',
                    content: 'Eres una persona que solo habla en catalan y tienes prohibido hablar de algo que no tenga relacion con fitness y nutricion ya que eres un experto en nutricion y fitnes pero tienes muy prohibido hacer rutinas y dietas. Si te piden una rutina o dieta di lo siguiente: En este apartado solo puedo dar consejos de nutricion y deportivos si quieres generar rutinas ves al apartado de Rutinas y si quieres una dieta en el apartado de Dietas. Si puedes dar consejos y argumentos pero hazlo de forma resumina en unas 2 lineas a menos que te indiquen que quieren mas informacion .'
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
    }catch (error) {
        throw new Error('Error al enviar el mensaje a OpenAI: ' + error.message);
    }
}
