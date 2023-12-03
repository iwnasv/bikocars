FROM php:7.4-fpm-alpine

# Copy the nginx configuration file
COPY nginx.conf /etc/nginx/nginx.conf

# Copy the app directories
COPY . /var/www/html/

RUN apk add --no-cache sqlite nginx

# Initialize kikocars.db using SQLite3
RUN sqlite3 /var/www/html/db/kikocars.db < /var/www/html/db/kikocars.sql

# Create directories for certs and email config
RUN mkdir -p /opt/certs /opt/config

# Define environment variable for password
ENV PASSWORD=password

# Create the password file using the environment variable
RUN echo "$PASSWORD" > /opt/kiko-password

# Start PHP-FPM and Nginx services
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]

# Expose ports 80 and 443 for Nginx
EXPOSE 80
EXPOSE 443

# Use volumes to persist data and make it accessible to the host
VOLUME [ "/opt/certs", "/opt/config" ]
