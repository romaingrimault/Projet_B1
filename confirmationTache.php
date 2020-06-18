<?php
$idTache = filter_input(INPUT_GET, "id");
require_once 'operation/Config.php';
$db = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BASE . "", Config::USER, Config::MDP);

$r = $db->prepare("SELECT t.*, b.titre as titreBijou from tache t JOIN bijou b on b.idBijou=t.idBijou where idTache=:id");
$r->bindParam(":id", $idTache);
$r->execute();
$tache = $r->fetch();

$slogan =  'Controle de '.$tache["titreBijou"];
include_once "include/header.php";
if(!isset($_SESSION["id"]) and !isset($_SESSION["metier"]) and empty($_SESSION["id"]) and empty($_SESSION["metier"])){
  header('Location: operation/deconexion.php');
}
?>
<form action="operation/enregistrementTache.php" method="post" class="alignement reduire">
  <div class="row">
    <h1>Information de controle</h1>
    <?php
if($_SESSION["metier"]==2){
?>
<label>Pierre</label>
<select class="browser-default" name="pierre">
  <option value="" disabled selected>Choisir le type de pierre</option>
  <?php
  require_once 'operation/Config.php';
  $db = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BASE . "", Config::USER, Config::MDP);

  $r = $db->prepare("select idPierre,typePierre from pierre");
  $r->execute();
  $i=1;
  $info = $r->fetchAll();
  foreach ($info as $infos) {
    ?><option value="<?php echo $infos['idPierre']; ?>"><?php echo $infos['typePierre']; ?></option>
    <?php
  }
  ?>
</select>
<div class="input-field col s12">
  <label class="active" for="carat">Nombre de carat</label>
  <input name="carat" placeholder="carat" id="carat" type="number" min='1' max='100' class="validate">
</div>
<div class="input-field col s12">
  <label class="active" for="carat">Prix</label>
  <input name="prix" placeholder="prix" id="prix" type="number" min='1' max='10000' class="validate">
</div>
<?php
}elseif($_SESSION["metier"]==5){
?>
<label>Métal</label>
<select class="browser-default" name="metal">
  <option value="" disabled selected>Choisir le type de Métal</option>
  <?php
  require_once 'operation/Config.php';
  $db = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BASE . "", Config::USER, Config::MDP);

  $r = $db->prepare("select * from metal");
  $r->execute();
  $i=1;
  $info = $r->fetchAll();
  foreach ($info as $infos) {
    ?><option value="<?php echo $infos['idMetal']; ?>"><?php echo $infos['typeMetal']; ?></option>
    <?php
  }
  ?>
</select>
<div class="input-field col s12">
  <label class="active" for="carat">Nombre de carat</label>
  <input name="carat" placeholder="carat" id="carat" type="number" min='1' max='100' class="validate">
</div>
<div class="input-field col s12">
  <label class="active" for="carat">Prix</label>
  <input name="prix" placeholder="prix" id="prix" type="number" min='1' max='10000' class="validate">
</div>
<?php
}
 ?>
    <div class="input-field col s12">
      <label class="active" for="Titre">Titre de la tache</label>
      <input name="titre" placeholder="Titre" id="Titre" type="text" class="validate" value='<?php echo $tache["titre"]; ?>' required>
    </div>
    <div class="input-field col s12">
      <label class="active" for="commentaire">Commentaire</label>
      <textarea name="commentaire" placeholder="commentaire" id="commentaire" type="text" class="materialize-textarea" required></textarea>
    </div>
    <div class="input-field col s12">
      <label class="active" for="heure">Heure de travail</label>
      <input name="heure" placeholder="heure" id="heure" type="number" min='1' max='100' class="validate" required>
    </div>
    <p>
      <label>
        <input name="controle" type="radio" value="0" required checked />
        <span>Bijou non terminer</span>
      </label>
    </p>
    <p>
      <label>
        <input name="controle" type="radio" value="1" required />
        <span>Bijou terminer</span>
      </label>
    </p>
    <input type="hidden" name="tache" value="<?php echo $tache["idTache"]; ?>" />
    <a href="index.php"class="waves-effect waves-light btn red">Retour</a>
    <button class="btn waves-effect waves-light" type="submit" name="operateur" value="<?php echo $_SESSION["id"]; ?>">Valider</button>
  </div>
</form>

</body>
</html>
