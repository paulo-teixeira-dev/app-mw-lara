FROM php:8.2.2-fpm

# Instalar dependencias do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nano \
    libpq-dev

# Instalar extensões php fundamentais e o cliente PostgreSQL
RUN docker-php-ext-install mbstring exif pcntl bcmath gd pdo pdo_mysql pdo_pgsql

# Instalar a ultima versão do composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/api

COPY src /var/www/api/

# Limpar cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

