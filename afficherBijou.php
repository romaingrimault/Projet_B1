<?php
$slogan = 'Opérateur de Chimere';
include_once "include/header.php";

if(!isset($_SESSION["id"]) and !isset($_SESSION["metier"]) and empty($_SESSION["id"]) and empty($_SESSION["metier"])){
  header('Location: operation/deconexion.php');
}

require_once 'operation/Config.php';
$db = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BASE . "", Config::USER, Config::MDP);

if ($_SESSION["metier"]==1) {
  include_once "include/affichageBijouChef.php";
}
elseif ($_SESSION["metier"]==2 or $_SESSION["metier"]==3 or $_SESSION["metier"]==4 or $_SESSION["metier"]==5) {
  include_once "include/affichageBijouOperateur.php";
}
else{

}
?>
</body>
</html>
