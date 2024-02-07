# Use the official Node.js image as a parent image
FROM node:20

# Establecer el directorio de trabajo en el contenedor
WORKDIR /home/node/app

# Exponer el puerto en el que se ejecuta la aplicación
EXPOSE 3000

# Servir la aplicación
CMD ["npm install" && "npm run dev"]
