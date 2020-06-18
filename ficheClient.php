<?php
$erreur='';
$id = filter_input(INPUT_GET, "name");
$modif = filter_input(INPUT_GET, "modif");
require_once 'operation/Config.php';

$db = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BASE . "", Config::USER, Config::MDP);
$r = $db->prepare("select * from client where idclient=:id limit 1");
$r->bindParam(":id",$id);
$r->execute();
$info = $r->fetch();

$slogan =  'Fiche de '.$info["nom"].' '.$info["prenom"];
include_once "include/header.php";
$metierAccess=1;
include_once "include/verifSession.php";

if(isset($_GET["e"]) and ($_GET["e"]==0)){
  $erreur="Client Modifier";
}
elseif(isset($_GET["e"]) and ($_GET["e"]==1)){
  $erreur="Client non modifer, erreur";
}
echo "<div class='row center' style='color:#64b5f6;'><h5>$erreur</h5></div>";
?>
<div class="alignement">
  <div class="row center">
    <div class="card blue-grey darken-1">
      <div class="card-content white-text">
        <span class="card-title"><?php echo $info["nom"].' '.$info["prenom"]; ?></span>
        <p><?php echo  $info["nom"].' '.$info["prenom"].' est un client de Chimère.</br>Téléphone: '.$info["tel"].'</br>Adresse: '.$info["adresse"].'</br>Ville: '.$info["ville"].'</br>Mail: '.$info["mail"]; ?></p>
      </div>
      <?php if($modif!='Y') { ?>
        <div class="card-action">
          <a href="ficheClient.php?name=<?php echo $id;?>&modif=Y">Modifier les informations  Client</a>
        </div>
      <?php } ?>
    </div>
    <a href="index.php"class="waves-effect waves-light btn red">Retour</a>
  </div>
</div>
<?php
if(!empty($info) and !empty($modif) and $modif=='Y') {
  ?><div class="container">
    <form method="post" action="operation/modifClient.php" class="center">
      <div class="input-field">
        <input name="nom" id="Nom" type="text" class="validate" value="<?php echo $info["nom"]; ?>" required>
        <label for="Nom">Nom</label>
      </div>
      <div class="input-field">
        <input name="prenom" id="Prénom" type="text" class="validate" value="<?php echo $info["prenom"]; ?>" required>
        <label for="Prénom">Prénom</label>
      </div>
      <div class="input-field">
        <input name="tel" id="Téléphone" type="tel" class="validate" value="<?php echo $info["tel"]; ?>" required>
        <label for="Téléphone">Téléphone</label>
      </div>
      <div class="input-field">
        <input name="mail" id="Email" type="email" class="validate" value="<?php echo $info["mail"]; ?>" required>
        <label for="Email">Email</label>
      </div>
      <div class="input-field">
        <input name="adresse" id="Adresse" type="text" class="validate" value="<?php echo $info["adresse"]; ?>" required>
        <label for="Adresse">Adresse</label>
      </div>
      <div class="input-field">
        <input name="ville" id="Ville" type="text" class="validate" value="<?php echo $info["ville"]; ?>" required>
        <label for="Ville">Ville</label>
      </div>
      <button class="btn waves-effect waves-light" type="submit" value="<?php echo $info["idclient"]; ?>" name="action">Valider</button>
    </form>
  </div>
  <?php
}
?>
</body>
</html>
