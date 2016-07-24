EventKit 
========


REQUIREMENTS
------------

- PHP 5.4.0. or higher
- Enable **php5-intl** extension (used for International date/time/number/currency formatting). To install this extension on Ubuntu run: `sudo apt-get install php5-intl`


INSTALLATION
------------
### 1) Clone the project
```
git clone https://github.com/leoshtika/eventkit.git
```

### 2) Install LAMP stack with Vagrant
```
vagrant up
vagrant ssh
cd /vagrant
```

### 3) Install dependencies
```
composer global require "fxp/composer-asset-plugin:~1.1.1"
composer install
```

### 4) Initialize the application
```
php init
```
Select [0] Development environment

### 5) Install phpmyadmin
```
sudo apt-get install phpmyadmin
```
Open phpmyadmin from: `http://localhost:4000/phpmyadmin`
username: `root`, password: `pass123`

### 6) Configure the database
- Create a database and name it `eventkit`
- Open the common/config/main-local.php file
- Change host = `localhost`, dbname = `eventkit`, username = `root` & password = `pass123` 
- Migrate the database running `php yii migrate`


Message Translations
--------------------
To generate(extract) the translation files inside common/messages, run in the console from the root folder:
```
./yii message/extract @common/config/i18n.php
```