# Start from the same base image you were using
FROM php:8.2-apache

# Install the necessary dependencies for mysqli
# 'apt-get update' updates the package lists
# 'docker-php-ext-install' installs and enables the PHP extension
RUN apt-get update \
    && apt-get install -y libzip-dev \
    && docker-php-ext-install mysqli pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# The rest of your configuration (e.g., setting user, if needed)
# Since you are setting the user in docker-compose, this is all you need for the extension.
