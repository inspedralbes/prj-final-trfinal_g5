import express from 'express';
import cors from 'cors';
import { createServer } from 'node:http';
import { Server } from 'socket.io';
import { join } from 'path';

const app = express();
app.use(cors());

const usersConectados: { id: string, username: string }[] = [];
const messages: { id: number, username: string, text: string }[] = [];

const server = createServer(app);
const io = new Server(server, {
    cors: {
        origin: '*',
        methods: ['GET', 'POST'],
    }
});

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

        usersConectados.push({ id: socket.id, username });
        io.emit('arrayUsers', usersConectados);
    });

    socket.on('message', (data) => {
        const message = { id: Date.now(), username: data.username, text: data.text };
        messages.push(message);
        io.emit('message', message);
        console.log('Mensaje:', message);
    });

    socket.on('disconnect', () => {
        const index = usersConectados.findIndex(user => user.id === socket.id);
        if (index !== -1) {
            const [user] = usersConectados.splice(index, 1);
            console.log(`Usuario desconectado: ${user.username}`);
            io.emit('arrayUsers', usersConectados);
        }
    });
});

const PORT = process.env.PORT || 3001;
server.listen(PORT, () => {
    console.log(`Servidor en ejecución en http://localhost:${PORT}`);
});
