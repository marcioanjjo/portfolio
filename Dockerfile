FROM php:8.3-apache

# Instala extensões de banco de dados necessárias para o PHP
RUN docker-php-ext-install pdo pdo_mysql

# Habilita o mod_rewrite do Apache (essencial para rotas amigáveis / MVC)
RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.confd

# Define o diretório de trabalho dentro do contêiner
WORKDIR /var/www/html/public

# Ajusta as permissões para o Apache ler os arquivos corretamente
RUN chown -R www-data:www-data /var/www/html/public