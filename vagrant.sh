#!/usr/bin/env bash

# Update the list of available packages
apt-get -y update

# Install GIT
# apt-get install -y git

# Installing Apache
apt-get install -y apache2

# Remove 'html' folder and add a symbolic link, only if it doesn't already exists
if ! [ -L /var/www/html ]; then
  rm -rf /var/www/html
  ln -fs /vagrant /var/www/html
fi

# Change AllowOverride in apache2.conf for the .htaccess to work
sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Enable Apache's mod_rewrite
sudo a2enmod rewrite

# Installing MySQL and it's dependencies, Also, setting up root password for MySQL as it will prompt to enter the password during installation
debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password password pass123'
debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password_again password pass123'
apt-get -y install mysql-server libapache2-mod-auth-mysql

# Installing PHP and it's dependencies
apt-get -y install php5 libapache2-mod-php5 php5-mcrypt curl php5-curl php5-mysql
apt-get -y install php5-intl

# Install Composer
if [ ! -f /usr/local/bin/composer ]; then
    curl -sS https://getcomposer.org/installer | php
    mv composer.phar /usr/local/bin/composer
fi

# Install 'composer-asset-plugin'
echo "Installing Composer Asset Plugin"
composer global require "fxp/composer-asset-plugin:~1.1.1"

# Restart Apache
service apache2 restart