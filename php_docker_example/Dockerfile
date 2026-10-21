FROM php:8.2-apache

# # Install PHP extensions, Many apps need extensions like pdo, mysqli, etc.
# RUN docker-php-ext-install pdo pdo_mysql mysqli

# Enable Apache rewrite, needed for frameworks like Laravel, CodeIgniter, or custom routing using .htaccess
RUN a2enmod rewrite


# Set working directory to Apache’s web root, This avoids repeating paths.
WORKDIR /var/www/html

# # Copies your application files from the build context into Apache’s web root
# COPY . /var/www/html/
# COPY . .
# # Copy files with correct ownership
COPY --chown=www-data:www-data . /var/www/html


# # Fix permissions
# COPY --chown=www-data:www-data . /var/www/html
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Set ServerName to suppress warnings
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

