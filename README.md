EventKit 
========
Conference management framework


REQUIREMENTS
------------

- If you are going to use Vagrant for this project you will need to install Virtualbox and Vagrant to your machine. All the needed components are already installed there. 
- If you have your own developing enviroment make sure you have a LAMP stack with PHP 5.4.0. or higher and **php5-intl** extension enabled (used for International date/time/number/currency formatting). To install this extension on Ubuntu run: `sudo apt-get install php5-intl`.


Prepare your development environment
------------------------------------

### 1. Fork the 'eventkit' repository on GitHub and clone your fork to your development environment
```
git clone https://github.com/YOUR-GITHUB-USERNAME/eventkit.git
```

### 2. Add the main 'eventkit' repository as an additional git remote called "upstream"
```
git remote add upstream https://github.com/leoshtika/eventkit.git
```

### 3. Install LAMP stack with Vagrant
```
vagrant up
vagrant ssh
cd /vagrant
```
Now you are inside the VM and in the /vagrant folder. All the following commands will be executed from here.

### 4. Install dependencies
```
composer global require "fxp/composer-asset-plugin:~1.1.1"
composer install
```

### 5. Initialize the application
```
php init
```
Select [0] Development environment

### 6. Install phpmyadmin
```
sudo apt-get install phpmyadmin
```
Open phpmyadmin from: `http://localhost:4000/phpmyadmin`
username: `root`, password: `pass123`

### 7. Configure the database
- Create a database and name it `eventkit`
- Open the common/config/main-local.php file and change host = `localhost`, dbname = `eventkit`, username = `root` & password = `pass123` 
- Using the phpmyadmin import the eventkit.sql database from DB BACKUP folder


Message Translations
--------------------
To generate(extract) the translation files inside common/messages, run in the console from the root folder:
```
./yii message/extract @common/config/i18n.php
```
