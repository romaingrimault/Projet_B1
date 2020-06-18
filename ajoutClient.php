<?php
$erreur='';
$metierAccess=1;
$slogan = 'Création fiche Client';
include_once "include/header.php";
include_once "include/verifSession.php";
if(isset($_GET["e"])&&($_GET["e"]==0)){
  $erreur="Client enregistrer";
}
elseif(isset($_GET["e"])&&($_GET["e"]==1)){
  if($_GET["rep"]=='tel'){
    $erreur="Client non enregistrer, téléphone non entrer ou mauvais email";
  }
  else {
    $erreur="Client non enregistrer";
  }
}
echo "<div class='row center' style='color:#64b5f6;'><h5>$erreur</h5></div>";
?>
<div class="container">
  <form method="post" action="operation/enregistrementClient.php" class="center">
    <div class="input-field">
      <input name="nom" id="Nom" type="text" class="validate" required>
      <label for="Nom">Nom</label>
    </div>
    <div class="input-field">
      <input name="prenom" id="Prénom" type="text" class="validate" required>
      <label for="Prénom">Prénom</label>
    </div>
    <div class="input-field">
      <input name="tel" id="Téléphone" type="tel" class="validate" required>
      <label for="Téléphone">Téléphone</label>
    </div>
    <div class="input-field">
      <input name="mail" id="Email" type="email" class="validate" required>
      <label for="Email">Email</label>
    </div>
    <div class="input-field">
      <input name="adresse" id="Adresse" type="text" class="validate" required>
      <label for="Adresse">Adresse</label>
    </div>
    <div class="input-field">
      <input name="ville" id="Ville" type="text" class="validate" required>
      <label for="Ville">Ville</label>
    </div>
    <a href="index.php"class="red waves-effect waves-light btn">Retour</a>
    <button class="btn waves-effect waves-light" type="submit" name="action">Valider</button>
  </form>
</div>
</body>
</html>
