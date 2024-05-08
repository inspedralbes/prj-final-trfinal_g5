<template>

    <body>
            <capçalera />
            <div>
    <!-- Barra de búsqueda -->
    <input type="text" v-model="busqueda" placeholder="Buscar...">
    
    <!-- Botón de añadir -->
    <button @click="agregarItem">+</button>
    
    <!-- Lista de elementos -->
    <div v-for="(item, index) in items" :key="index" class="item">
      <img :src="item.imagen" alt="Imagen">
      <div>
        <h3>{{ item.nombre }}</h3>
        <p>{{ item.texto }}</p>
      </div>
      <div class="hora">{{ item.hora }}</div>
    </div>
  </div>

            <navBar />


    </body>
</template>
<script>
export default {
  data() {
    return {
      busqueda: '',
      items: [
        { imagen: 'ruta/a/imagen1.jpg', nombre: 'Nombre 1', texto: 'Texto 1', hora: '10:00' },
        { imagen: 'ruta/a/imagen2.jpg', nombre: 'Nombre 2', texto: 'Texto 2', hora: '11:00' },
        // Agrega más elementos según sea necesario
      ]
    };
  },
  methods: {
    agregarItem() {
      // Lógica para agregar un nuevo elemento
    }
  }
};
</script>

<!-- En tu estilo (CSS) -->
<style scoped>
/* Estilos para los elementos */
.item {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}
.item img {
  width: 100px;
  height: 100px;
  margin-right: 10px;
}
.hora {
  margin-left: auto;
}
</style>