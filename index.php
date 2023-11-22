<pre>

<?php
// all classes so they can be used via namespaces
include_once('./config/autoload.php');

$router = new config\Router();

$router->route($_SERVER['REQUEST_URI']);

// $controller = new Controllers\UserController();
// $user = new Model\User("j", "j", "j");
// echo (($controller->tmp()));
// $controller->get(1);
// $test = "ORM\\UserORM";
// $user3 = new $test();
// var_dump($user3);
?>


