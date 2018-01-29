<?php
include('header.php');


if(isset($_SESSION['idMembre']))
{

    $requser = $bdd->prepare("SELECT * FROM membres WHERE idMembre = ? ");
    $requser->execute(array($_SESSION['idMembre']));

    $user = $requser->fetch();

    if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo'])
    {
        $newpseudo = htmlspecialchars($_POST['newpseudo']);

        $insertpseudo = $bdd->prepare("UPDATE membres SET pseudo = ? WHERE idMembre = ?"); 
        $insertpseudo->execute(array($newpseudo, $_SESSION['idMembre']));
        header('Location: profil.php?idMembre='.$_SESSION['idMembre']);
    }

    if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail'])
    {
        $newmail = htmlspecialchars($_POST['newmail']);

        $insertmail = $bdd->prepare("UPDATE membres SET mail = ? WHERE idMembre = ?"); 
        $insertmail->execute(array($newmail, $_SESSION['idMembre']));
        header('Location: profil.php?idMembre='.$_SESSION['idMembre']);
    }


    if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']) )
    {
        $mdp1 = sha1($_POST['newmdp1']);
        $mdp2 = sha1($_POST['newmdp2']);
          
        if($mdp1 == $mdp2)
        {
            $insertmdp = $bdd->prepare("UPDATE membres SET mdp = ? WHERE idMembre = ?");
            $insertmdp->execute(array($mdp1, $_SESSION['idMembre']));
            header('Location: profil.php?idMembre='.$_SESSION['idMembre']);
        }
        else
        {
            $msg = "Vos mots de passes ne correspondent pas !";
        }
    }
    
    if(isset($_POST['newpseudo']) AND $_POST['newpseudo'] == $user['pseudo'])
    {
        header('Location: profil.php?idMembre='.$_SESSION['idMembre']);
    }
if(isset ($msg))
    {
        echo $msg;
    }

?>
<section>
    <h3>Edition de mon profil</h3>
    <br>
    <form method="post" action="">
        <label>Pseudo :</label>
        <input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['pseudo']; ?>" /><br /><br />
        <label>Email :</label>
        <input type="email" name="newmail" placeholder="Mail" value="<?php echo $user['mail']; ?>" /><br /><br />
        <label>Mot de passe :</label>
        <input type="password" name="newmdp1" placeholder="Mot de passe" /><br /><br />
        <label>Confirmation mot de passe :</label>
        <input type="password" name="newmdp2" placeholder="Confirmation du mot de passe" /><br /><br />

        <input type="submit" value="Mettre à jour mon profil"/><br /><br />


    </form>
    <?php
    if(isset ($msg))
    {
        echo $msg;
    }
    ?>
</section>
<?php
}
else
{
    header("Location: connexion.php");
}
?>