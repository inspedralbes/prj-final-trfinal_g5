import express from 'express';
import cors from 'cors';
import { createServer } from 'http';
import { Server } from 'socket.io';
import { join } from 'path';

const app = express();
app.use(cors());

const server = createServer(app);
const io = new Server(server, {
    cors: {
        origin: '*',
        methods: ['GET', 'POST'],
    }
});

const usersConectados: { id: string, username: string, room: string }[] = [];
const messages: { id: number, username: string, text: string, room: string }[] = [];

app.get('/', (req, res) => {
    res.sendFile(join(__dirname, 'index.html'));
});

io.on('connection', (socket) => {
    console.log('a user connected', socket.id);

    socket.on('Nuevo usuario', (username) => {
        console.log('Usuario conectado:', username);
        const usuarioExistente = usersConectados.find(user => user.username === username);
        if (usuarioExistente) {
            console.error(`Usuario ${username} ya existe. Elige otro nombre.`);
            return;
        }

        // Crear salas privadas con usuarios existentes y unirse a ellas
        usersConectados.forEach(user => {
            const room1 = `${username}_${user.username}`;
            const room2 = `${user.username}_${username}`;
            socket.join(room1);
            socket.join(room2);
            console.log(`Usuario ${username} se unió a la sala ${room1}`);
            console.log(`Usuario ${user.username} se unió a la sala ${room2}`);
        });

        // Agregar el nuevo usuario a la lista de usuarios conectados
        usersConectados.push({ id: socket.id, username, room: usersConectados.length.toString()});
        console.log('Usuarios conectados:', usersConectados);

        // Emitir lista de usuarios conectados a todos los clientes
        io.emit('arrayUsers', usersConectados);
    });

    socket.on('message', (data) => {
        const message = { id: Date.now(), username: data.username, text: data.text };
        // Enviar mensaje solo a la sala privada correspondiente
        const room1 = `${data.sender}_${data.receiver}`;
        //const room2 = `${data.receiver}_${data.sender}`;
        io.to(room1).emit('message', message);
        //io.to(room2).emit('message', message);
        console.log(`Mensaje enviado en la sala ${room1}:`, message);
        //console.log(`Mensaje enviado en la sala ${room2}:`, message);
    });

    socket.on('disconnect', () => {
        const index = usersConectados.findIndex(user => user.id === socket.id);
        if (index !== -1) {
            const [user] = usersConectados.splice(index, 1);
            console.log(`Usuario desconectado: ${user.username}`);
            // Dejar la sala cuando un usuario se desconecta
            usersConectados.forEach(user => {
                const room1 = `${user.username}_${user.username}`;
                const room2 = `${user.username}_${user.username}`;
                socket.leave(room1);
                socket.leave(room2);
                console.log(`Usuario ${user.username} dejó la sala ${room1}`);
                console.log(`Usuario ${user.username} dejó la sala ${room2}`);
            });
            io.emit('arrayUsers', usersConectados);
        }
    });
});

const getUsersInRoom = (room: string) => {
    return usersConectados.filter(user => user.room === room);
};

const PORT = process.env.PORT || 3001;
server.listen(PORT, () => {
    console.log(`Servidor en ejecución en http://localhost:${PORT}`);
});
