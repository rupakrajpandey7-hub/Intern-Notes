FROM php:8.1-fpm-alpine

RUN apk add --no-cache nginx bash

COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

RUN mkdir -p /run/nginx

EXPOSE 80

CMD bash -c "php-fpm -D; PORT=\${PORT:-80}; cat > /tmp/nginx.conf << NGINXEOF
events { worker_connections 1024; }
http {
  include /etc/nginx/mime.types;
  server {
    listen \$PORT;
    root /var/www/html;
    index index.php index.html;
    location / { try_files \\\$uri \\\$uri/ /index.php?\\\$query_string; }
    location ~ \\.php\$ {
      fastcgi_pass 127.0.0.1:9000;
      fastcgi_param SCRIPT_FILENAME \\\$document_root\\\$fastcgi_script_name;
      include fastcgi_params;
    }
  }
}
NGINXEOF
nginx -c /tmp/nginx.conf -g 'daemon off;'"
