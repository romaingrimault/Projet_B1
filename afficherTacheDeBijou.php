<?php
$idBijou = filter_input(INPUT_GET, "id");

require_once 'operation/Config.php';
$db = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BASE . "", Config::USER, Config::MDP);

$r = $db->prepare("SELECT b.*,c.nom,c.prenom from bijou b JOIN client c on c.idClient=b.idClient where idBijou=:id");
$r->bindParam(":id", $idBijou);
$r->execute();
$bijou = $r->fetch();
if($bijou["etat"]==0){$etat = 'Le bijou est une création.';}else{$etat='Le bijou est une réparation.';}
$r = $db->prepare("SELECT controleQualite from tache where idBijou=:id order by idtache desc");
$r->bindParam(":id", $idBijou);
$r->execute();
$controle = $r->fetch();

$slogan =  'Fiche de '.$bijou["titre"];
include_once "include/header.php";
if(!isset($_SESSION["id"]) and !isset($_SESSION["metier"]) and empty($_SESSION["id"]) and empty($_SESSION["metier"])){
  header('Location: operation/deconexion.php');
}
?>
<div style="margin-top:10vh;" class="alignement">
  <div class="row center">
      <div class="card ">
        <div class="card-image">
          <img src="operation/imgBijou/<?php echo $bijou["image"]; ?>" >
          <span class="card-title" >
            </span>
          </div>
          <div class="card-content">
            <p><h4><?php echo $bijou["titre"]; ?></h4>
            <?php
            if($controle["controleQualite"]==1){
              echo "Ce bijou est terminer.</br>";
            }
            echo 'Le temps de travail est de '.$bijou["estimationTravail"].'h sur ce bijou qui coutera environ '.$bijou["estimationPrix"].
            ' euros</br> et commander par '.$bijou["nom"].' '.$bijou["prenom"].'. '.$etat; ?></p>
          </div>
        </div>
      </div>
      <a href="afficherBijou.php"class="red waves-effect waves-light btn">Retour</a>
    </div>
  <?php
  $r = $db->prepare("SELECT t.idEmployee,t.idTache,t.titre as nomTache, t.commentaire,t.heureTravail,m.nomMetier,e.nom as nomEmployee,
    e.prenom as prenomEmployee,t.controleQualite from tache t JOIN bijou b on b.idBijou=t.idBijou
    JOIN employee e on e.idEmployee=t.idEmployee JOIN metier m on m.idMetier=t.idMetier
    where t.idBijou=:id order by t.idTache desc");
    $r->bindParam(":id", $idBijou);
    $r->execute();
    $info = $r->fetchAll();

    foreach ($info as $infos) {
      ?>
      <div class="alignement">
        <div class="row center">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title"><?php echo $infos["nomTache"]; ?></span>
              <p><?php if($infos["prenomEmployee"]!='null' and !empty($infos["commentaire"])){
                echo 'La tache a été réaliser par '.$infos["nomEmployee"].' '.$infos["prenomEmployee"].
                ' qui est'.$infos["nomMetier"].', le commentaire est : </br>- '.$infos["commentaire"].'.
                </br> Le tache a durée '.$infos["heureTravail"].'h.</p>
                </div>';
              }elseif($infos["controleQualite"]==0 and $_SESSION["metier"]==1){
                echo "La tache est en attente d'opérateurs qui exercent le metier ".$infos["nomMetier"].".</p>
                </div>
                <div class='card-action'>
                <a href='confirmationTache.php?id=".$infos["idTache"]."'>Controler le bijou</a>
                </div>";
              }elseif (empty($infos["controleQualite"]) and !empty($_SESSION["metier"]) and empty($infos["idEmployee"])) {
                echo "La tache est en attente d'opérateurs qui exercent le metier ".$infos["nomMetier"].".</p>
                </div>
                <form action='operation/enregistrementTache.php' method='post'>
                <div class='card-action'>
                <input type='hidden' name='tache' value='".$infos["idTache"]."' />
                <button name='idEmployee' value='".$_SESSION["id"]."' class='btn waves-effect waves-light' type='submit' name='action'>Prendre la tache
                <i class='material-icons right'>send</i>
                </button>
                </div>
                </form>";
              }elseif ($infos["idEmployee"]==$_SESSION["id"]) {
                echo "Vous travaillez sur cette tache.</p>
                </div>
                <div class='card-action'>
                <a href='confirmationTache.php?id=".$infos["idTache"]."'>Confirmer la fin fin de la tache</a>
                </div>";
              }
              else{
                echo "La tache est en attente d'opérateurs qui exercent le metier ".$infos["nomMetier"].".</p>
                </div>";
              } ?>
            </div>
          </div>
        </div>
      <?php } ?>
    </body>
    </html>
