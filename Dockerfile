FROM php:7.4-fpm-alpine

# Copy the nginx configuration file
COPY nginx.conf /etc/nginx/nginx.conf

# Copy the app directories
COPY . /var/www/html/
# Email configuration; use a volume to overwrite
COPY cfg/emailconf.php /var/www/html/src/emailconf.php

RUN apk add --no-cache sqlite nginx openssl

# Initialize kikocars.db using SQLite3
RUN sqlite3 /var/www/html/db/kikocars.db < /var/www/html/db/kikocars.sql

# Create directories for certs and email config
RUN mkdir -p /opt/certs /opt/config

# Set permissions on app webroot
RUN chown -R www-data:www-data /var/www/html

# Define environment variable for password
ENV PASSWORD=password

# Create the password file using the environment variable
RUN printf "nikos:$(openssl passwd -apr1 $PASSWORD)\n" | > /opt/kiko-password

# Start PHP-FPM and Nginx services
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]

# Expose ports 80 and 443 for Nginx
EXPOSE 80
EXPOSE 443

# Use volumes to persist data and make it accessible to the host
VOLUME [ "/opt/certs" ]
