FROM php:8.1-fpm-alpine

RUN apk add --no-cache nginx

COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

EXPOSE 80

CMD sh -c " \
    mkdir -p /run/nginx && \
    echo 'events {}' > /etc/nginx/nginx.conf && \
    echo 'http {' >> /etc/nginx/nginx.conf && \
    echo '  include /etc/nginx/mime.types;' >> /etc/nginx/nginx.conf && \
    echo '  server {' >> /etc/nginx/nginx.conf && \
    echo \"    listen \${PORT:-80};\" >> /etc/nginx/nginx.conf && \
    echo '    root /var/www/html;' >> /etc/nginx/nginx.conf && \
    echo '    index index.php index.html;' >> /etc/nginx/nginx.conf && \
    echo '    location / { try_files \$uri \$uri/ /index.php?\$query_string; }' >> /etc/nginx/nginx.conf && \
    echo '    location ~ \\.php\$ { fastcgi_pass 127.0.0.1:9000; fastcgi_index index.php; fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name; include fastcgi_params; }' >> /etc/nginx/nginx.conf && \
    echo '  }' >> /etc/nginx/nginx.conf && \
    echo '}' >> /etc/nginx/nginx.conf && \
    php-fpm -D && \
    nginx -g 'daemon off;'"
