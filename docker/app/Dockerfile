FROM php:8.3-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    nano \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libldap2-dev \
    supervisor \
    libssl-dev \
    && apt-get clean

# Instalar extensiones de PHP
#RUN docker-php-ext-install pdo_mysql mbstring zip gd
RUN docker-php-ext-configure ldap --with-libdir=/lib/x86_64-linux-gnu \
    && docker-php-ext-install pdo_mysql mbstring zip gd ldap 

# Instalar Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Copiar configuración de Supervisor
COPY supervisor/supervisor.conf /etc/supervisor/supervisord.conf


# Configurar el directorio de trabajo
WORKDIR /var/www/html



##########comandos
## iniciar
#docker-compose up --build

##entrar a la consola
#docker exec -it peligro-laravel-app bash

##bajar contenedores
#docker-compose down