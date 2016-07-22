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

### 2) Vagrant
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

### 5) Configure the database
- Open the common/config/main-local.php file
- Use the dns, username (root) & password (pass123) of your DB server
- Migrate the database. **Careful! Skip this step If the database exists**. if doesn't, create one and run `php yii migrate`.

### 6) Install phpmyadmin
```
sudo apt-get install phpmyadmin
```
username: root
password: pass123