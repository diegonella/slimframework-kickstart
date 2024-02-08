# Slim Skeleton PHP 7.2
#
# Container for my slim-skeleton-php7 sample project
#
# Extends FROM debian:jessie
FROM php:7.2-apache

MAINTAINER Anthony Chambers <dockerfiles@anthonychambers.co.uk>

# Set up environment variables
ENV DISPLAY_ERRORS=1
ENV LOG_LEVEL=200
ENV VIEW_DEBUG=1
ENV VIEW_AUTO_RELOAD=1
ENV DB_NAME=sample
ENV DB_HOST=your.db.host
ENV DB_USER=mysqluser
ENV DB_PASS=password

# Volume that you can use to mount the host filesystem on
VOLUME /var/www/html

# Add PHP extensions and enable
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-enable pdo_mysql

# Add Apache vhost, disable default and enable new vhost
ADD vhost.conf /etc/apache2/sites-available/
RUN a2dissite 000-default.conf
RUN a2ensite vhost

# Enable Apache modules
RUN a2enmod rewrite

# Finally, restart Apache
RUN service apache2 restart