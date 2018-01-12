<?php
include('_debut.inc.php');
?>
<form action="connexion.traitement.php" method="post">
    <div class="form-group">
        <input name="login" type="text" placeholder="Login" class="form-control">

    </div>
    <div class="form-group">
        <input name="mdp" type="password" placeholder="Mot de passe" class="form-control">
    </div>
    <div> <button type="submit" class="btn btn-primary btn-sm">Connexion</button> </div>
</form>
