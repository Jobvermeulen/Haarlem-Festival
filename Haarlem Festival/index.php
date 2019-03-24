<?php
//Get error messages
error_reporting(E_ALL);
ini_set('display_errors', 1);

//Require routes file
require_once('routes.php');

//Autoload for loading all files
function __autoload($className)
{
    if (file_exists('./models/' . $className . '.php')) {
        require_once './models/' . $className . '.php';
    } else if (file_exists('./controllers/' . $className . '.php')) {
        require_once './controllers/' . $className . '.php';
    } else if (file_exists('./views/modules/food/' . $className . '.php')) {
        require_once './views/modules/food/' . $className . '.php';
    } else if (file_exists('./views/modules/carousel/' . $className . '.php')) {
        require_once './views/modules/carousel/' . $className . '.php';
    }else if (file_exists('./views/modules/' . $className . '.php')) {
        require_once './views/modules/' . $className . '.php';
    } else if (file_exists('./' . $className . '.php')) {
        require_once './' . $className . '.php';
    }
}

