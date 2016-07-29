# emptyProject - Silex

Basierend auf Silex 1.3 ( [http://silex.sensiolabs.org/documentation](http://silex.sensiolabs.org/documentation) )

AUTOR: Florian Petruschke    
STAND: 29.07.2016  

------

# Inhalt

* [Voraussetzungen](#min.-voraussetzungen)
* [Abhängigkeiten](#abh-ngigkeiten)
* [Installation](#installation)
* [Testen](#testen)
* [Logging](#logging)
* [Debugging Hilfe](#debugging-hilfe)

------

## min. Voraussetzungen

* Apache WebServer >=2.4.7
* PHP >=5.4
* MySQL Server >=5.5.47 
* Composer >= 1.0.0-alpha10

## Abhänigkeiten
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
Klonen des Repositories.  

### Composer update
Installation der benötigten externen Ressourcen und Initialisierung des Autoloadings  
`composer install` | `composer update`

#### .htaccess
Erstellen einer `.htaccess`-Datei im root-Verzeichnis mit folgendem Inhalt:  

```
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
Testen, ob die Apache `rewrite.load`-Mod aktiviert ist:

`ll /etc/apache2/mods-enabled/ | grep 'rewrite.load'` 

(Wenn die Mod nicht aktiviert ist, kann sie durch `sudo a2enmod rewrite` und einem Neustart des Apache Webservers aktiviert werden.)

### index.php  
**In der index.php müssen die Root-Urls geprüft werden!**

```php

/**
 * defining the projects root
 */
$app['serverRoot']  = /*Root für alle assets (css, img, js)      */ "/emptyProjectSilex/web/";
$app['urlRoot']     = /*Root für alle URLs (z.B. ajax-Requests): */ "/emptyProjectSilex/";

```

**Außerdem muss die Datenbank erstellt...**   

    Hierzu kann das database-script im scripts-Verzeichnis verwendet werden.

**... und eingebunden werden:**


```php

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
Folgende Log-files müssen unter `app/log/` vorhanden sein:
**(Für das Anlegen kann das CLI-Tool "createEmptyLogs" genutzt werden: `php /path/to/project/app/cli/createEmptyLogs.php -h`)**

* AUTH.log
* BASE.log
* CREATE.log
* DELETE.log
* EDIT.log

------

# Testen

## PHPUnit

PHPUnit-Tests befinden sich im Verzeichnis `tests/MVC/`.

Tests ausführen: **`phpunit --bootstrap vendor/autoload.php tests/MVC/`**

...mit Testdox: **`phpunit --bootstrap vendor/autoload.php --testdox tests/MVC/`**

...mit Coverage(HTML): **`phpunit --bootstrap vendor/autoload.php --coverage-html tests/Coverage tests/MVC/`**

Coverage-Verzeichnis: `tests/Coverage`

------


------

# Logging

Die Anwendung schreibt an einigen Stellen in Logfiles. Die oben genannten Log-files und ihre Funktionen:

* **AUTH** Login-Versuche  
* **BASE** Änderung der Stammdaten (Nutzer, Räume, Abteilungen, Gerätetypen, Hersteller)  
* **CREATE** Erstellen von Geräten  
* **DELETE** Löschen von Geräten  
* **EDIT** Änderung von Gerätedaten (auf Geräteebene)  

Defaultmäßig wird die maximale Größe der Logfiles auf 5MB gesetzt.  
Wird diese Größe überschritten, wird die betreffende Logdatei standardmäßig bis auf die letzten 100 Zeilen geleert.

Diese Standardwerte sind in `app/MVC/Controller/Tools/logController.php` konfigurierbar.

------

# Debugging Hilfe

Zum Debuggen kann Silex' Debugging-Modus eingeschaltet werden.  
Dazu einfach in der index.php `$app['debug'] = true;` setzen.


Ferner wird eine kleine Dropdown-Debugging-Hilfe angezeigt:

![debugging Helper](http://s940-gitlab-01.optadata-gruppe.local/dzh/emptyProjectSilex/tree/master/web/img/debugHelper.png)

------