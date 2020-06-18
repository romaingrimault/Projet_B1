<?php
$metierAccess=1;
$slogan = 'Opérateur de Chimere';
include_once "include/header.php";
include_once "include/verifSession.php";
require_once 'operation/Config.php';
$db = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BASE . "", Config::USER, Config::MDP);

$r = $db->prepare("select * from employee");
$r->execute();
$info = $r->fetchAll();
$r = $db->prepare("select idMetier, nomMetier from metier");
$r->execute();
$metier = $r->fetchAll();
$liste = '<div class="reduire"><table class="responsive-table"><thead><tr><th>Nom</th><th>Prenom</th><th>état</th><th>Métier</th><th>Métier</th></tr></thead><tbody>';
foreach ($info as $infos) {
  if($infos["etat"]==1){
    $infos["etat"]='Actif';
    foreach ($metier as $metiers) {
      if( $infos["Metier_idMetier"]==$metiers['idMetier']){
        $infos['Metier_idMetier']=$metiers['nomMetier'];
      }
    }
    $liste = $liste . '<tr><th>' . $infos["nom"] . '</th><th>' . $infos["prenom"] . '</th><th>' . $infos["etat"] . '</th><th>'.
    $infos["Metier_idMetier"] .'</th><th>
    <a class="btn-floating btn-large waves-effect waves-light red" href="ficheOperateur.php?name='.$infos["identifiant"].'">
    <i class="material-icons">person</i></a></th></tr>';
  }
  elseif($infos["etat"]==0){
    $infos["etat"]='Inactif';
    foreach ($metier as $metiers) {
      if( $infos["Metier_idMetier"]==$metiers['idMetier']){
        $infos['Metier_idMetier']=$metiers['nomMetier'];
      }
    }
    if($infos["idEmployee"]!=0){
      $liste = $liste . '<tr><th>' . $infos["nom"] . '</th><th>' . $infos["prenom"] . '</th><th>' . $infos["etat"] . '</th><th>'.
      $infos["Metier_idMetier"] .'</th><th>
      <a class="btn-floating btn-large waves-effect waves-light red" href="ficheOperateur.php?name='.$infos["identifiant"].'">
      <i class="material-icons">person</i></a></th></tr>';
    }
  }
}


$liste = $liste . '</tbody></table><a href="index.php"class="red waves-effect waves-light btn">Retour</a></div>';
echo $liste;
?>

</body>
</html>
