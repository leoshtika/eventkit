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


Working on bugs and features
----------------------------
Having prepared your develop environment as explained above you can now start working on a feature or bugfix.

### 1. Make sure there is an issue created for the thing you are working on if it requires significant effort to fix
All new features and bug fixes should have an associated issue to provide a single point of reference for discussion 
and documentation.
If you do not find an existing issue matching what you intend to work on, please open a new issue or create 
a pull request directly if it is straightforward fix.

### 2. Fetch the latest code from the main 'eventkit' branch
You should start at this point for every new contribution to make sure you are working on the latest code.
```
git checkout master
git pull upstream master
```

### 3. Create a new branch for your feature based on the current master branch
Each separate bug fix or change should go in its own branch. Branch names should be descriptive and start with the 
number of the issue that your code relates to. If you aren't fixing any particular issue, just skip number. For example:
```
git checkout -b 999-name-of-your-branch
```

### 4. Do your magic, write your code
All new code should follow [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) 
coding standard. Make sure it works :)

### 5. Commit your changes
```
git add --all
git commit -m "Resolve #999: A brief description of this change"
```

### 6. Pull the latest code from upstream, rebase & squash your changes
Before pushing your code to GitHub make sure to integrate upstream changes into your local repository
```
git checkout master
git pull upstream master
git checkout 999-name-of-your-branch
git rebase master
```
This ensures that your changes can be merged with one click. 

**Squash commits** 
This step is not always necessary, but is required when your commit history is full of small, unimportant commits.
```
git rebase -i master
```

### 7. Push your code to GitHub
```
git push -u origin 999-name-of-your-branch
```

### 8. Open a [pull request](https://help.github.com/articles/creating-a-pull-request-from-a-fork/) against upstream
Go to your repository on GitHub and click "Pull Request", choose 'develop' as the base branch and your '999-name-of-your-branch' as the head branch and enter some more details in the comment box. To link the pull request to the issue put anywhere in the pull comment #999 where 999 is the issue number.
Note that each pull-request should fix a single change.

### 9. Someone will review your code
Someone will review your code, and you might be asked to make some changes, if so go to step #5 
(you don't need to open another pull request if your current one is still open). 
If your code is accepted it will be merged into the main branch and become part of the next release.

### 10. Cleaning it up
After your code was either accepted or declined you can delete branches you've worked with from your local repository and origin.
```
git checkout master
git branch -D 999-name-of-your-branch
git push origin --delete 999-name-of-your-branch
```


Message Translations
--------------------
To generate(extract) the translation files inside common/messages, run in the console from the root folder:
```
./yii message/extract @common/config/i18n.php
```
