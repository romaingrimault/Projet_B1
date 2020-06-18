<?php
$metierAccess=1;
$slogan = 'Opérateur de Chimere';
include_once "include/header.php";
include_once "include/verifSession.php";
require_once 'operation/Config.php';
$db = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BASE . "", Config::USER, Config::MDP);

$r = $db->prepare("select * from client");
$r->execute();
$info = $r->fetchAll();
$liste = '<div class="reduire"><table class="responsive-table"><thead><tr><th>Nom</th><th>Prenom</th><th>Téléphone</th><th>Fiche client</th></tr></thead><tbody>';
foreach ($info as $infos) {
    $liste = $liste . '<tr><th>' . $infos["nom"] . '</th><th>' . $infos["prenom"] . '</th><th>' . $infos["tel"] . '</th><th>
    <a class="btn-floating btn-large waves-effect waves-light red" href="ficheClient.php?name='.$infos["idclient"].'">
    <i class="material-icons">person</i></a></th></tr>';
}


$liste = $liste . '</tbody></table></div><a href="index.php"class="red waves-effect waves-light btn">Retour</a>';
echo $liste;
?>

</body>
</html>
