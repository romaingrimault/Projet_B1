<?php
$erreur='';
$id = filter_input(INPUT_GET, "name");
$modif = filter_input(INPUT_GET, "modif");
$slogan =  'Fiche de '.$id;
include_once "include/header.php";
$metierAccess=1;
include_once "include/verifSession.php";
require_once 'operation/Config.php';

if(isset($_GET["e"]) and ($_GET["e"]==0)){
  $erreur="Operateur Modifier";
}
elseif(isset($_GET["e"]) and ($_GET["e"]==1)){
  $erreur="Operateur non modifer";
}
echo "<div class='row center' style='color:#64b5f6;'><h5>$erreur</h5></div>";

$db = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BASE . "", Config::USER, Config::MDP);

$r = $db->prepare("select * from employee where identifiant=:id");
$r->bindParam(":id",$id);
$r->execute();
$info = $r->fetch();

$r = $db->prepare("select idMetier, nomMetier from metier");
$r->execute();
$metier = $r->fetchAll();
foreach ($metier as $metiers) {
  if( $info['Metier_idMetier']==$metiers['idMetier']){
    $info['Metier_idMetier']=$metiers['nomMetier'];
  }
}
if($info["etat"]==1){
  $info["etat"]='Actif';
}elseif ($info["etat"]==0) {
  $info["etat"]='Inactif';
}
?>
<div class="alignement">
  <div class="row center">
    <div class="card blue-grey darken-1">
      <div class="card-content white-text">
        <span class="card-title"><?php echo $info["nom"].' '.$info["prenom"]; ?></span></span>
        <p><?php echo  $info["prenom"].' est un '.$info["Metier_idMetier"].' qui est '.$info["etat"]." dans l'entreprise Chimère"; ?></p></p>
      </div>
      <?php if($modif!='Y') { ?>
        <div class="card-action">
          <a href="ficheOperateur.php?name=<?php echo $id;?>&modif=Y">Modifier les informations  Opérateur</a>
        </div>
      <?php } ?>
    </div>
    <a href="afficherOperateur.php"class="waves-effect waves-light btn red">Retour</a>
  </div>
</div>
<?php
if(!empty($info)&&!empty($modif)&&$modif=='Y') {
  ?><form action="operation/modifOperateur" method="post" class="alignement reduire">
    <div class="row">
      <h1>Modification de l'opérateur</h1>
      <?php
      foreach ($metier as $metiers) {?>
        <p>
          <label>
            <input name="metier" type="radio" value="<?php echo $metiers['idMetier']; ?>" required <?php if($info["Metier_idMetier"]==$metiers['nomMetier']){echo "checked";} ?> />
            <span><?php echo $metiers['nomMetier']; ?></span>
          </label>
        </p>
        <?php
      }
      ?>
      <input name="nom" placeholder="Nom" id="Nom" type="text" class="textInput" value="<?php echo $info["nom"]; ?>" required>
      <input name="prenom" placeholder="Prénom" id="Prénom" type="text" class="textInput" value="<?php echo $info["prenom"]; ?>" required>
      <input name="identifiant" placeholder="Identifiant" id="Identifiant" type="text" class="textInput" value="<?php echo $info["identifiant"]; ?>" required>
      <input name="mdp" placeholder="Mot de passe" id="Mot de passe" type="password" class="textInput">
      <p>
        <label>
          <input name="etat" type="radio" value="0" required <?php if($info["etat"]=='Inactif'){echo "checked";} ?> />
          <span>Inactif</span>
        </label>
      </p>
      <p>
        <label>
          <input name="etat" type="radio" value="1" required <?php if($info["etat"]=='Actif'){echo "checked";} ?> />
          <span>Actif</span>
        </label>
      </p>
      <button class="btn waves-effect waves-light" type="submit" name="action" value="<?php echo $info["idEmployee"]; ?>">Valider</button>
    </div>
  </form>
  <?php
}
?>
</body>
</html>
