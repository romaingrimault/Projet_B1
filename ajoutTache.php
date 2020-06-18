<?php
$id=filter_input(INPUT_GET, "id");
require_once 'operation/Config.php';
$db = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BASE . "", Config::USER, Config::MDP);
/*$r = $db->prepare("select * from bijou  where idBijou=:id");
$r->bindParam(":id", $id);
$r->execute();
$info = $r->fetch();*/
$r = $db->prepare("SELECT t.* from tache t where t.idBijou=:id order by idTache desc limit 1");
$r->bindParam(":id", $id);
$r->execute();
$tache = $r->fetch();

$erreur='';

$slogan = 'Création Tache';
include_once "include/header.php";
if(!isset($_SESSION["id"]) and !isset($_SESSION["metier"]) and empty($_SESSION["id"]) and empty($_SESSION["metier"])){
  header('Location: operation/deconexion.php');
}
?>
<form method="post" action="operation/enregistrementTache.php" enctype="multipart/form-data">
  <div class="formcreation">
    <div class="input-field col s12">
      <input name="titre" id="titre" type="text" class="validate" data-length="40" required>
      <label for="titre">Titre</label>
    </div>
    <label>Metier</label>
    <select class="browser-default" name="metier" required>
    <?php
      if($tache["controleQualite"]==2){
        echo "<option value='1' >Chef d'Atelier</option>";
    }else{
    ?>
      <option value="" disabled selected>Choisir le Metier</option>
      <?php
      $r = $db->prepare("select * from metier");
      $r->execute();
      $metier = $r->fetchAll();
      foreach ($metier as $metiers) {
        ?><option value="<?php echo $metiers['idMetier']; ?>" ><?php echo $metiers['nomMetier']; ?></option><?php
      }
}
      ?>
    </select>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="input-field center">
      <button class="btn waves-effect waves-light" name="bijou" value="<?php echo $id;?>" type="submit">Envoyer Tache</button>
    </div>
  </div>
</form>
</body>
</html>
