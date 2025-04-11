# Use an official PHP image with Apache
FROM php:8.2-apache

# Copy all files from the repo into the container's web directory
COPY . /var/www/html/

# Set permissions (optional but useful)
RUN chown -R www-data:www-data /var/www/html

# Expose the default Apache port
EXPOSE 80
