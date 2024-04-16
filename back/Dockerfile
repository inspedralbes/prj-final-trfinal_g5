# Use the official PHP image as a parent image
FROM php:8.0-apache

# Establecer el directorio de trabajo en el contenedor
WORKDIR /var/www/html

# Habilitar mod_rewrite para Apache
RUN a2enmod rewrite

# Instalar extensiones PHP requeridas
RUN docker-php-ext-install pdo pdo_mysql

# Descargar e instalar Composer

RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        unzip \
        && docker-php-ext-install zip pdo_mysql

# Exponer el puerto en el que se ejecuta la aplicación
EXPOSE 8000

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

