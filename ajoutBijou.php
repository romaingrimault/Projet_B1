<?php
$erreur='';
$metierAccess=1;
$slogan = 'Création Bijou';
include_once "include/header.php";
include_once "include/verifSession.php";
if(isset($_GET["e"])&&($_GET["e"]==0)){
  $erreur="Bijou et Tache enregistrer";
  echo "<div class='row center'><h5><a href='ajoutBijou.php' style='color:#64b5f6;'>$erreur</a></h5></div>";
}
elseif (isset($_GET["e"])&&($_GET["e"]==1)) {
  $erreur="Bijou non enregistrer, erreur";
  echo "<div class='row center'><h5><a href='ajoutBijou.php' style='color:#f44336;'>$erreur</a></h5></div>";
}

?>
<form method="post" action="operation/enregistrementBijou.php" enctype="multipart/form-data">
  <div class="formcreation">
    <div class="input-field col s12">
      <input name="titre" id="titre" type="text" class="validate" data-length="40" required>
      <label for="titre">Titre</label>
    </div>
    <script>
    M.AutoInit();
    $(document).ready(function(){
      $('select').formSelect();
    });
    </script>
    <label>Nom Client</label>
    <select class="browser-default" name="client" required>
      <option value="" disabled selected>Choisir le client</option>
      <?php
      require_once 'operation/Config.php';
      $db = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BASE . "", Config::USER, Config::MDP);

      $r = $db->prepare("select idclient, nom, prenom from client");
      $r->execute();
      $i=1;
      $info = $r->fetchAll();
      foreach ($info as $infos) {
        ?><option value="<?php echo $infos['idclient']; ?>"><?php echo $infos['nom']." ".$infos['prenom']; ?></option>
        <?php
      }
      ?>
    </select>
    <div class="input-field col s12">
      <input name="estim1" id="estim1" type="number" class="validate" required>
      <label for="estim1">Estimation du prix</label>
    </div>
    <div class="input-field col s12">
      <input name="estim2" id="estim2" type="number" class="validate" required>
      <label for="estim2">Estimation temps travail</label>
    </div>
    <div class="file-field input-field">
      <div class="btn">
        <span>Votre Image (Taille Maximale : 1Mo)</span>
        <input type="file" name="file_cv" required>
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
    <p>
      <label>
        <input name="etat" type="radio" value="1" required/>
        <span>Réparation</span>
      </label>
    </p>
    <p>
      <label>
        <input name="etat" type="radio" value="0" required checked/>
        <span>Création</span>
      </label>
    </p>
    <div class="input-field center">
      <a href="index.php"class=" red waves-effect waves-light btn">Retour</a>
      <button class="btn waves-effect waves-light" type="submit">Valider</button>
    </div>
  </div>
</form>
</body>
</html>
