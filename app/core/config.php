<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    define('DBNAME', 'telemedicine'); // database name
    define('DBHOST', 'localhost'); // database host
    define('DBUSER', 'root'); // database user
    define('DBPASS', ''); // database password
    define('DBDRIVER', ''); // database driver (e.g., mysql, pgsql)
    define('ROOT', '/telemedicine-system-/public'); // root path for localhost
} else {
    define('DBNAME', 'my_db'); // database name
    define('DBHOST', 'localhost'); // database host
    define('DBUSER', 'root'); // database user
    define('DBPASS', ''); // database password
    define('DBDRIVER', ''); // database driver (e.g., mysql, pgsql)
    define('ROOT', 'https://yourproductiondomain.com');
}

define('APP_NAME', 'Telemedicine System'); // application name
define('APP_DESC', 'A telemedicine platform for remote healthcare services.'); // application description

define('DEBUG', true); // debug mode