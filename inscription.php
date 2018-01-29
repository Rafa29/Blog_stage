<?php
include('header.php');


if(isset($_POST['submit_inscription']))  
{
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);

    if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
    {

        $reqpseudo = $bdd->prepare("SELECT * FROM membres where pseudo = ? ");
        $reqpseudo->execute(array($pseudo));
        $pseudoexist = $reqpseudo->rowCount();
        if($pseudoexist == 0)
        {

            $pseudolength = strlen($pseudo);
            if($pseudolength <= 255)
            {


                $reqmail = $bdd->prepare("SELECT * FROM membres where mail = ? ");
                $reqmail->execute(array($mail));
                $mailexist = $reqmail->rowCount();
                if($mailexist == 0)
                {

                    if($mdp == $mdp2)
                    {
                        $insertmbr = $bdd->prepare("INSERT INTO membres (pseudo, mail, mdp) VALUES (?,?,?)");
                        $insertmbr->execute(array($pseudo,$mail,$mdp));
                        $msg = "<span style='color:green'>Votre compte a bien été créé !</span> <a href=\"connexion.php\">Me connecter</a>";
                    }
                    else
                    {
                        $msg = "Vos mots de passes ne correspondent pas !";
                    }

                }
                else
                {
                    $msg = "Adresse mail déja utilisée !";
                }
            }
            else
            {
                $msg = "Votre pseudo ne doit pas dépasser 255 caractères !";
            }
        }
        else
        {
            $msg = "Pseudo déja utilisé !";
        }
    }
    else
    {
        $msg = "Tous les champs doivent êtres complétés !";
    }
}  


?>
<section>
    <h3>Inscription</h3>
    <form method="post" action="">
        <div class="form-group">
            <input type="text" class="form-control" name="pseudo" placeholder="Votre pseudo" value="<?php if(isset($pseudo)) { echo $pseudo;} ?>"> </div>
        <div class="form-group">
            <input type="email" class="form-control" name="mail" placeholder="Votre mail" value="<?php if(isset($mail)) { echo $mail;} ?>"> </div>
        <div class="form-group">
            <input type="password" class="form-control" name="mdp" placeholder="Votre mot de passe"> </div>
        <div class="form-group">
            <input type="password" class="form-control" name="mdp2" placeholder="Confirmer votre mot de passe"> </div>
        <button type="submit" class="btn btn-default" name="submit_inscription">Je m'inscris</button>
    </form>
    <?php 
    if(isset($msg))
    {
        echo '<font color="red">'.$msg."</font>";
    }
    ?> 
</section>
