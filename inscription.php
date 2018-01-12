<?php
include("_debut.inc.php");
?>
<html>
<section>
   <h2>Inscription</h2>
   <form method='post' action='inscription.traitement.php'>
    <div class="form-group">
    <label for="email">Nom:</label>
    <input type="text" class="form-control" name="nom">
  </div>
  <div class="form-group">
    <label for="email">Prénom:</label>
    <input type="text" class="form-control" name="prenom">
  </div>
  <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" class="form-control" name="email">
  </div>
  <div class="form-group">
    <label for="email">Adresse</label>
    <input type="text" class="form-control" name="adresse">
  </div>
  <div class="form-group">
    <label for="email">Ville:</label>
    <input type="text" class="form-control" name="ville">
  </div>
  <div class="form-group">
    <label for="email">Code postal:</label>
    <input type="number" class="form-control" name="cp">
  </div>
  <div class="form-group">
    <label for="email">Login:</label>
    <input type="text" class="form-control" name="login" required>
  </div>
  <div class="form-group">
    <label for="pwd">Mot de passe:</label>
    <input type="password" class="form-control" name="mdp" required>
  </div>
  <button type="submit" class="btn btn-default" name="submit">Valider</button>
</form>
</section>
</html>