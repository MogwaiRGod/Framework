<pre>

<?php
// all classes so they can be used via namespaces
include_once('./config/autoload.php');
?>

<h1>Données actuelles</h1>
<?php 
var_dump(file_get_contents(JSON_FILE_URL));
?>

<h2>Create</h2>
<?php 
$user = new Model\User('ok', 'ok', 'ok');
Controller\UserController::add($user);
var_dump(file_get_contents(JSON_FILE_URL));
?>

<h2>Read : ID 1</h2>
<?php 
var_dump(Controller\UserController::get(1));
?>

<h2>Update : user avec ID 42</h2>
<h3>D'abord, récupérer l'utilisateur</h3>
<?php 
var_dump($user = Controller\UserController::get(42));
?>
<h3>Modifier ses données en local : username = Michel et email = bentou@mel.com</h3></br>
<?php 
$user->setUsername("Michel");
$user->setEmail("bentou@mel.com");
echo "Modif de l'user \n";
var_dump($user);
?>
<h3>Puis dans le JSON File</h3></br>
<?php 
echo "Dans la méthode \n";
var_dump($user = Controller\UserController::update($user));
echo "Dans le json file \n";
var_dump(file_get_contents(JSON_FILE_URL));
?>

<h2>Delete : user avec ID 42</h2>
<?php 
Controller\UserController::delete(42);
var_dump(file_get_contents(JSON_FILE_URL));