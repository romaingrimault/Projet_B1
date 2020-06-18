<?php
$erreur = '';
$color='white';
include_once "include/header.php";

require_once 'operation/Config.php';
$db = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BASE . "", Config::USER, Config::MDP);

$r = $db->prepare("select nomMetier from metier where idMetier=:id");
$r->bindParam(":id", $_SESSION['metier']);
$r->execute();

$metier = $r->fetch();

if(isset($_GET["e"]) and $_GET["e"]==0){
  $color="#64b5f6";
  if(isset($_GET["id"]) and $_GET["id"]=='newTache'){
    $erreur='Nouvelle tache enregistrer';
  }
  if(isset($_GET["id"]) and $_GET["id"]=='finTache'){
    $erreur='Bijou terminer';
  }
}
if(isset($_GET["e"]) and $_GET["e"]==1){
  $color="#e57373";
  if(isset($_GET["id"]) and $_GET["id"]=='newTache'){
    $erreur='Nouvelle tache non enregistrer';
  }
}
echo "<div class='row center'  style='color:".$color.";'><h5>$erreur</h5></div>";

if(empty($_SESSION["id"])&&empty($_SESSION["metier"])){
  include_once "include/formConnexion.php";
  if(isset($_GET["e"])&&($_GET["e"]==1)){
    $erreur="Mauvais Identifiant ou mauvais mdp";
  }
}
elseif ($_SESSION["metier"]==1) {
  echo "<div class='row center'><h4>Vous êtes un chef</h4></div>";
  include_once "include/accueilChef.php";

}
elseif ($_SESSION["metier"]==2 or $_SESSION["metier"]==5 or $_SESSION["metier"]==4 or $_SESSION["metier"]==3) {
  echo "<div class='row center'><h4>Vous êtes un ". $metier["nomMetier"] ."</h4></div>";
  include_once "include/accueilOperateur.php";
}

if(!empty($_SESSION["metier"])){
  echo "<div class='row center'><a href='operation/deconexion.php'/><h5>Deconnexion</h5></a></div>";
}
?>
</body>
</html>
