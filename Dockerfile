FROM php:7.2-apache
## [2] Inne składniki wymagane do działania aplikacji
RUN apt-get update
RUN apt-get install -y apache2
RUN a2enmod rewrite
RUN docker-php-ext-install mysqli