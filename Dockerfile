# Comece com a imagem base oficial que já estamos usando a
FROM php:8.1-apache

# Comando para instalar a extensão pdo_mysql e suas dependências
RUN docker-php-ext-install pdo_mysql