FROM php:8.1-fpm

# Instalar dependencias
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libwebp-dev \
    libxpm-dev \
    zlib1g-dev

# Configurar extensiones GD con soporte para JPEG, PNG, etc.
RUN docker-php-ext-configure gd --with-jpeg --with-freetype --with-webp --with-xpm

# Instalar extensiones para PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Obtener Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer el directorio de trabajo
WORKDIR /var/www

# Copiar el código fuente
COPY . /var/www

# Instalar dependencias con Composer
RUN composer install

# Copia el script de inicio
COPY start.sh /var/www/start.sh

EXPOSE 9000
CMD ["/var/www/start.sh"]

