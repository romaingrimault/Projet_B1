<?php
$erreur='';
$metierAccess=1;
$slogan = 'Création Opérateur';
include_once "include/header.php";
include_once "include/verifSession.php";
if(isset($_GET["e"])&&($_GET["e"]==0)){
  $erreur="Operateur enregistrer";
}
elseif(isset($_GET["e"])&&($_GET["e"]==1)){
  $erreur="Operateur non enregistrer";
}
echo "<div class='row center' style='color:#64b5f6;'><h5>$erreur</h5></div>";
?>
<form action="operation/enregistrementEmployee" method="post" class="alignement reduire">
  <div class="connexion cadre">
    <span class="formtxt">Metier</span>
    <p>
      <label>
        <input name="metier" type="radio" value="3" required/>
        <span>Tailleur</span>
      </label>
    </p>
    <p>
      <label>
        <input name="metier" type="radio" value="5" required/>
        <span>Fondeur</span>
      </label>
    </p>
    <p>
      <label>
        <input name="metier" type="radio" value="4" required/>
        <span>Polisseur</span>
      </label>
    </p>
    <p>
      <label>
        <input name="metier" type="radio" value="1" required/>
        <span>Chef d'atelier</span>
      </label>
    </p>
    <p>
      <label>
        <input name="metier" type="radio" value="2" required/>
        <span>Sertisseur</span>
      </label>
    </p>
  </div>
  <div class="connexion cadre">
    <span class="formtxt">Informations</span>
    <input name="nom" placeholder="Nom" id="Nom" type="text" class="textInput" required>
    <input name="prenom" placeholder="Prénom" id="Prénom" type="text" class="textInput" required>
    <input name="identifiant" placeholder="Identifiant" id="Identifiant" type="text" class="textInput" required>
    <input name="mdp" placeholder="Mot de passe" id="Mot de passe" type="password" class="textInput" required>
    <p>
      <label>
        <input name="etat" type="radio" value="0" required/>
        <span>Inactif</span>
      </label>
    </p>
    <p>
      <label>
        <input name="etat" type="radio" value="1" required/>
        <span>Actif</span>
      </label>
    </p>
    <div class="row">
      <a href="index.php"class="red waves-effect waves-light btn">Retour</a>
      <button class="btn waves-effect waves-light" type="submit" name="action">Valider</button>
    </div>
  </div>
</form>
</body>
</html>
