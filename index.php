<pre>

<?php
// all classes so they can be used via namespaces
include_once('./config/autoload.php');
?>

<h1>CRUD générique</h1>
<p>Utilisation des ORM étendant l'ORM abstrait</p>

<?php
$user = new Model\User("test", "test", "test");
$orm = new ORM\UserORM();
?>

<h2>Create : nouvel utilisateur </h2>

<?php
echo "Objet créé \n";
var_dump($user = $orm->create($user));
echo "json file mis à jour \n";
var_dump(file_get_contents(JSON_FILE_URL));
?>

<h2>Read : utilisateur à l'ID 3</h2>

<?php
var_dump($user = $orm->read(3));
?>

<h2>Update : utilisateur à l'ID 3</h2>
<ul><li> Username -> "Toto"</li><li>Password -> "tutu"</li>

<?php
$user = $user->setUsername("Toto")
            ->setPassword("Tutu");
echo "Objet modifié : \n";
var_dump($user);
echo "Objet mis à jour : \n";
var_dump($user = $orm->update($user));
echo "json file mis à jour \n";
var_dump(file_get_contents(JSON_FILE_URL));
?>

<h2>Delete : utilisateur à l'ID 3</h2>

<?php
echo "Objet supprimé : \n";
var_dump($user = $orm->delete(3));
echo "json file mis à jour \n";
var_dump(file_get_contents(JSON_FILE_URL));
?>