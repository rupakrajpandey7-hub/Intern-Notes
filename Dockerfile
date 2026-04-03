FROM php:8.1-fpm-alpine

# Install nginx
RUN apk add --no-cache nginx

# Write nginx config directly in Dockerfile
RUN mkdir -p /etc/nginx && echo 'events {} \
http { \
    include /etc/nginx/mime.types; \
    server { \
        listen 80; \
        root /var/www/html; \
        index index.php index.html; \
        location / { \
            try_files $uri $uri/ /index.php?$query_string; \
        } \
        location ~ \.php$ { \
            fastcgi_pass 127.0.0.1:9000; \
            fastcgi_index index.php; \
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name; \
            include fastcgi_params; \
        } \
    } \
}' > /etc/nginx/nginx.conf

# Copy challenge files
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

EXPOSE 80

# Run php-fpm and nginx inline — no external start.sh needed
CMD sh -c "php-fpm -D && nginx -g 'daemon off;'"
