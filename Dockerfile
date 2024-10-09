FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    vim \
    git \
    unzip \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy current directory to the container
COPY ./source /var/www/html

RUN chown -R www-data:www-data /var/www/html && \
    chmod 777 -Rf /var/www

CMD ["php-fpm"]
