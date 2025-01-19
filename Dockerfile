# Utiliser l'image officielle PHP avec Apache
    FROM php:8.2-apache

    # Installer les dépendances nécessaires
    RUN apt-get update && apt-get install -y \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        zip \
        unzip \
        && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

    # Activer le module Apache rewrite
    RUN a2enmod rewrite

    # Copier les fichiers de l'application
    COPY . /var/www/html/

    # Définir les permissions
    RUN chown -R www-data:www-data /var/www/html

    # Exposer le port 80
    EXPOSE 80
