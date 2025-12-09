# Usa una imagen base de PHP con Apache
FROM php:8.2-apache

# Instala extensiones de PHP que Laravel necesita
RUN apt-get update && \
    apt-get install -y git libzip-dev unzip libonig-dev && \
    docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# Habilita el módulo de reescritura de Apache (para rutas bonitas de Laravel)
RUN a2enmod rewrite

# Establece el directorio de trabajo dentro del contenedor
WORKDIR /var/www/html

# Copia los archivos de configuración de composer para la capa de caché
COPY composer.json composer.lock ./

# Instala Composer (si no está ya en la imagen base)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instala las dependencias de Laravel
# Este paso fallará si no has copiado 'artisan' (verás el error 'Could not open input file: artisan')
# Por eso, es mejor copiar los archivos de la app antes de composer install.
# Para evitar el problema anterior, puedes instalar solo las dependencias aquí
RUN composer install --no-dev --prefer-dist --optimize-autoloader

# Copia el resto del código fuente de la aplicación al contenedor
COPY . .

# Ajusta permisos (importante para Laravel, especialmente para storage y bootstrap/cache)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache