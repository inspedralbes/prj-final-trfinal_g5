const url = 'http://localhost:8000/api';
// const url = 'http://.daw.inspedralbes.cat/'; //producción


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