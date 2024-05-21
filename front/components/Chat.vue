<template>
    <div>
      <div v-for="message in messages" :key="message.id">
        <strong>{{ message.username }}:</strong> {{ message.text }}
      </div>
      <input v-model="newMessage" @keyup.enter="sendMessage" placeholder="Type your message..."/>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        messages: [],
        newMessage: '',
        username: ''
      };
    },
    mounted() {
      this.username = prompt('Enter your username');
      this.socket = this.$nuxtSocket({
        name: 'main'
      });
      this.socket.emit('Nuevo usuario', this.username);
      this.socket.on('message', (message) => {
        this.messages.push(message);
      });
    },
    methods: {
      sendMessage() {
        if (this.newMessage.trim()) {
          this.socket.emit('message', {
            username: this.username,
            text: this.newMessage
          });
          this.newMessage = '';
        }
      }
    }
  };
  </script>
  
  <style scoped>
  input {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
  }
  </style>
  