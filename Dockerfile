# Usa una imagen base de PHP con Apache
FROM php:8.4-apache

# Instala extensiones de PHP que Laravel necesita
RUN apt-get update && \
    apt-get install -y git libzip-dev unzip libonig-dev && \
    docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# Habilita el módulo de reescritura de Apache (para rutas bonitas de Laravel)
RUN a2enmod rewrite
# Copia la configuración personalizada para apuntar a la carpeta 'public'
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf
# Establece el directorio de trabajo dentro del contenedor
WORKDIR /var/www/html

# 1. Copia los archivos de configuración de composer para la capa de caché
COPY composer.json composer.lock ./

# 2. Copia Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 3. ¡CORRECCIÓN! Copia el resto del código fuente (incluyendo 'artisan') AHORA
# Esto asegura que 'artisan' esté presente para el script de post-instalación de Composer.
COPY . .

# 4. Instala las dependencias de Laravel
# Este paso ahora encontrará 'artisan' y NO fallará.
RUN composer install --no-dev --prefer-dist --optimize-autoloader

# --- FIN DE LA SECCIÓN CRÍTICA ---

# Ajusta permisos (importante para Laravel, especialmente para storage y bootstrap/cache)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache