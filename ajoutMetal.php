<?php
$erreur='';
$metierAccess=5;
$slogan = 'Ajouter un type de pierre';
include_once "include/header.php";
include_once "include/verifSession.php";
if(isset($_GET["e"])&&($_GET["e"]==0)){
  $erreur="Metal enregistrer";
}
elseif(isset($_GET["e"])&&($_GET["e"]==1)){
    $erreur="Metal non enregistrer";
}
echo "<div class='row center' style='color:#64b5f6;'><h5>$erreur</h5></div>";
?>
<form action="operation/enregistrementMetal.php" method="post" class="alignement reduire">
  <div class="connexion cadre">
    <span class="formtxt">Type de métal</span>
    <input name="typeMetal" placeholder="type de Métal" id="typeMetal" type="text" class="textInput" data-length="255" required>
    <a href="index.php"class="waves-effect waves-light btn">Retour</a>
    <button class="btn-large waves-effect waves-light" type="submit" >Valider</button
  </div>
</form>
</body>
</html>
