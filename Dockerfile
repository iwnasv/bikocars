# Use the Alpine Linux base image
FROM alpine:latest

# Update and install necessary packages
RUN apk update && apk upgrade && \
    apk add --no-cache php8 php8-fpm php8-pdo php8-pdo_sqlite php8-sqlite3 nginx unzip

# Copy the nginx configuration file
COPY nginx.conf /etc/nginx/nginx.conf

# Copy the conf.d directory with all configuration files
COPY nginx-conf-d /etc/nginx/conf.d

# Create a directory for the PHP-FPM socket file
RUN mkdir -p /run/php8

# Create a directory for the LetsEncrypt certificates
RUN mkdir -p /etc/cert

# Copy the app directories
COPY admin /var/www/html/admin
COPY db /var/www/html/db
COPY public /var/www/html/public
COPY src /var/www/html/src

# Download and extract PHPMailer
ADD https://github.com/PHPMailer/PHPMailer/archive/master.zip /tmp/phpmailer.zip
RUN unzip /tmp/phpmailer.zip -d /var/www/html/src && \
    rm /tmp/phpmailer.zip

# Create the kikocars.db using SQLite3
RUN sqlite3 /var/www/html/db/kikocars.db < /var/www/html/db/kikocars.sql

# Start PHP-FPM and Nginx services
CMD ["sh", "-c", "php-fpm8 -D && nginx -g 'daemon off;'"]

# Expose ports 80 and 443 for Nginx
EXPOSE 80
EXPOSE 443

# Expose the /etc/cert directory for mounting
VOLUME /etc/cert
