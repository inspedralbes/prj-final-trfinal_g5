import Vue from 'vue';
import io from 'socket.io-client';

const socket = io('http://localhost:3000'); // Cambia la URL con la dirección de tu servidor WebSocket

Vue.prototype.$socket = socket;
