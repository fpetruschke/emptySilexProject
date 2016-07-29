# emptyProject - Silex

Based on Silex 1.3 ( [http://silex.sensiolabs.org/documentation](http://silex.sensiolabs.org/documentation) )

AUTHOR: Florian Petruschke

------

# Inhalt

* [Requirements](#requirements)
* [Dependencies](#dependencies)
* [Installation](#installation)
* [Testing](#testing)
* [Logging](#logging)
* [Debugging help](#debugging-help)

------

## Requirements

* Apache WebServer >=2.4.7
* PHP >=5.4
* MySQL Server >=5.5.47 
* Composer >= 1.0.0-alpha10

## Dependencies

```
    "silex/silex": "~1.3",  
    "twig/twig": ">=1.8,<2.0-dev",  
    "symfony/yaml":"v2.2.0",  
    "symfony/config":"v2.2.0",  
    "doctrine/orm": "^2.5",  
    "monolog/monolog": "^1.17"   
    "phpunit/phpunit": "4.8.*"  
``` 

------

## Installation

### Git Clone
First of all you need to clone or download this repository.  
Make sure you have the permissions to read, write and execute.  

### Composer update
Now you need to run a composer install:

`composer install`

#### .htaccess
We want to address this little project with typing **`localhost/emptySilex-Project/`**.  
Since the index.php is located under the web-directory we don't want to have to expand the url with /web.  
Therefore we need to configure an `.htaccess`-file inside the root of the project.  
Put following content into it:    

```
// .htaccess

<IfModule mod_rewrite.c>
    Options -MultiViews
    Options +FollowSymLinks
    RewriteEngine On
    RewriteCond %{DOCUMENT_ROOT}/web/$1 -f
    RewriteRule ^((.+)/?)*$ /web/$1 [L]
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ web/index.php [QSA,L]
    RewriteRule ^\.htaccess$ - [F]
</IfModule>

```

#### rewrite.mod
Check if apaches' rewrite module is enabled: 

`ll /etc/apache2/mods-enabled/ | grep 'rewrite.load'` 

(If not (nothing shows up) run `sudo a2enmod rewrite` and restart your apache.)

### web/index.php  

**Here you have to check the roots: **

```php

// web/index.php

/**
 * defining the projects root
 */
$app['serverRoot']  = /*Root for all asset stuff (css, img, js)      */ "/emptyProjectSilex/web/";
$app['urlRoot']     = /*Root for your callable urls (ajax-requests): */ "/emptyProjectSilex/";

```

### Database

**Now you have to create the database...**   

    ...just execute the database-script inside the scripts-directory...

**... and check for the parameters:**


```php

// web/index.php

$app['eM'] = function ($app) {
    $isDevMode = true;
    $config = \Doctrine\ORM\Tools\Setup::createYAMLMetadataConfiguration(array(__DIR__ . "/../app/config/mapping"), $isDevMode);
    $path = 'emptyProjectSilex\\Model';
    $params = array(
        'driver' => 'pdo_mysql',
        'host'   => 'localhost',            <------------------------- HERE
        'user'   => 'silexAdmin',           <------------------------- HERE
        'password' => 'ADMIN',              <------------------------- HERE AND
        'dbname' => 'emptyProjectSilex',    <------------------------- HERE
        'collation' => 'utf-8',
        'charset' => 'utf8',
        'entities' => array(array(
            'type' => 'yaml',
            'path' => '../config/mapping',
            'namespace' => 'emptyProjectSilex\Model'
        )));
    $entityManager = \Doctrine\ORM\EntityManager::create($params, $config);
    return $entityManager;


```

### Log files
If you want the application to read and write log files under `app/log/` check, if the necessary log files are existent:
**(For automatically creating the log-files you can execute following script: `php /path/to/project/app/cli/createEmptyLogs.php -h`)**

* AUTH.log
* BASE.log
* CREATE.log
* DELETE.log
* EDIT.log

------

# Testing

## PHPUnit

PHPUnit-Tests are unser `tests/MVC/`.

Execute tests: **`phpunit --bootstrap vendor/autoload.php tests/MVC/`**

...with testdox: **`phpunit --bootstrap vendor/autoload.php --testdox tests/MVC/`**

...with coverage(HTML): **`phpunit --bootstrap vendor/autoload.php --coverage-html tests/Coverage tests/MVC/`**

Coverage-directory: `tests/Coverage`

------


------

# Logging

The software can write log-files. The above mentioned files and their content:  

* **AUTH** Login-events
* **BASE** <could be something like changing base data>
* **CREATE** <could be something like creating users>
* **DELETE** <could be something like deleting users>
* **EDIT** <could be something like editing users> 
 
By defaul those log files can grow up to max 5MB.  
If the file is growing bigger than that, it will automatically be cleared except of the last 100 lines.  

Those default values are configurable inside the `app/MVC/Controller/Tools/logController.php`.

------

# Debugging help

For debugging you can use Silex' Debugging-Mode.  
If enabled there will also be a little debugging frame showing current routes and stuff.

```php

// web/index.php

`$app['debug'] = true;`

```

------