<?php
include('header.php');

if(isset($_POST['submit_connexion']))
{
    $pseudoconnect = htmlspecialchars($_POST['pseudoconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);
    if(!empty($_POST['pseudoconnect']) AND !empty($_POST['mdpconnect']))
    {
        $requser = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ? AND mdp = ?");
        $requser->execute(array($pseudoconnect, $mdpconnect));
        $userexist = $requser->rowCount();
        if($userexist == 1)
        {
            $userinfo = $requser->fetch();
            $_SESSION['idMembre'] = $userinfo['idMembre'];
            $_SESSION['pseudo'] = $userinfo['pseudo'];
            header("Location: profil.php?id=".$_SESSION['idMembre']);
        }
        else
        {
            $msg = "Mauvais pseudo ou mot de passe !"; 
        }
    }
    else
    {
        $msg = "Tous les champs doivent êtres complétés !";
    }
}


?>
<section>
    <h3>Connexion</h3>
    <form method="post" action="">
        <div class="form-group">
            <input type="text" class="form-control" name="pseudoconnect" placeholder="Votre pseudo" value="<?php if(isset($pseudo)) { echo $pseudo;} ?>"> 
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="mdpconnect" placeholder="Votre mot de passe">
        </div>
        <button type="submit" class="btn btn-default" name="submit_connexion">Se connecter !</button>
    </form>
    <?php 
    if(isset($msg))
    {
        echo '<font color="red">'.$msg."</font>";
    }
    ?> 
</section>
<br />

<b>Pas encore inscrit ? <a href="inscription.php">Inscrivez-vous !</a></b>