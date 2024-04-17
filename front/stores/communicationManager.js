const url = 'http://localhost:8000/api';
// const url = 'http://.daw.inspedralbes.cat/'; //producción


//ejemplo de peticion fetch get
export function getAllMovies() {
    return new Promise((resolve, reject) => {
        fetch(`${url}/movies`)
            .then(response => {
                if (response.status == 200) {
                    return response.json();
                } else {
                    reject('Error al obtener las peliculas');
                }
            }).then(data => {
                JSON.stringify(data);
                resolve(data);
            }).catch(error => {
                reject(error);
            });
    });
}

//ejemplo de peticion fetch post
export function postValidateEmail (data) {
    return new Promise((resolve, reject) => {
        fetch(`${url}/entradas/validate`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(response => {
            if (response.status == 200) {
                return response.json();
            } else {
                reject('Error al validar el email: ' + response.statusText);
            }
        }).then(data => {
            JSON.stringify(data);
            resolve(data);
        }).catch(error => {
            reject(error);
        });
    });
}