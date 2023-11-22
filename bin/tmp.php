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

<h2>Delete : utilisateur à l'ID 1</h2>

<?php
echo "Objet supprimé : \n";
var_dump($user = $orm->delete(1));
echo "json file mis à jour \n";
var_dump(file_get_contents(JSON_FILE_URL));
?>