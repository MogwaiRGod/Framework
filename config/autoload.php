<?php

namespace config;

// va être appelée à chaque fois que le script de base rencontre une classe non-déclarée
spl_autoload_register(function($class /* nom de la classe non-déclarée */) {
    // tous les répertoires contenant des classes
    $sources = array(
        "Controllers/$class.php",
        "CRUD/$class.php", 
        "Model/$class.php"
    );

    // on boucle dans les répertoires
    foreach ($sources as $source) {
        // si on trouve le chemin de la classe correspondante
        if (file_exists($source)) {
            // import de la classe
            require_once $source;
        } 
    } 
});

include_once './config/exception_handler.php';
include_once './config/Router.php';
include_once './config/Data.php';
include_once './Utils/Functions.php';
include_once './core/ORMInterface.php';
include_once './core/AbstractController.php';
include_once './core/AbstractORM.php';
include_once './Model/User.php';
include_once './ORM/UserORM.php';
include_once './Controllers/UserController.php';
echo "classes chargées\n";