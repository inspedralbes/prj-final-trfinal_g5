<template>
    <div >
        <h1>Detalles del Usuario</h1>
        <p><strong>Nombre:</strong> {{ usuario.nom }}</p>
        <p><strong>Apellidos:</strong> {{ usuario.cognoms }}</p>
        <p><strong>Email:</strong> {{ usuario.email }}</p>
        <p><strong>Fecha de Nacimiento:</strong> {{ usuario.data_naixement }}</p>
        <p><strong>Género:</strong> {{ usuario.genere }}</p>
        <p><strong>Peso:</strong> {{ usuario.pes }}</p>
        <p><strong>Altura:</strong> {{ usuario.altura }}</p>
        <p><strong>Teléfono:</strong> {{ usuario.telefon }}</p>
    </div>
</template>

<script>
import { useUsuariPerfilStore } from '@/stores/index';
export default {
    data() {
        return {
            usuario: null
        };
    },
    mounted() {
        this.cargarUsuario();
    },
    methods: {
        cargarUsuario() {
            const store = useUsuariPerfilStore();
            const idUsuario = store.id_usuari;
            getDatosUsuario2(idUsuario)
                .then(data => {
                    this.usuario = data.usuario;
                })
                .catch(error => {
                    console.error(error);
                });
        }
    }
};
</script>

<style scoped>
h1 {
    margin-bottom: 20px;
}
p {
    margin: 5px 0;
}
</style>
