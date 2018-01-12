<?php

function gestionnaireDeConnexion() {
    $pdo = null;
    try {
        $pdo = new PDO(
                'mysql:host=localhost;dbname=blog', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        );
    } catch (PDOException $err) {
        $messageErreur = $err->getMessage();
        error_log($messageErreur, 0);
    }
    return $pdo;
}

function creerUtilisateur($nom, $prenom, $email, $adresse, $ville, $cp, $login, $mdp) {
    $reussi = false;
    $pdo = gestionnaireDeConnexion();
    if ($pdo != null) {
        $nom = $pdo->quote($nom);
        $prenom = $pdo->quote($prenom);
        $email = $pdo->quote($email);
        $adresse = $pdo->quote($adresse);
        $ville = $pdo->quote($ville);
        $cp = $pdo->quote($cp);
        $login = $pdo->quote($login);
        $mdp = $pdo->quote($mdp);

        $req = "insert into Utilisateur values (null, $nom, $prenom, $email, $adresse, $ville, $cp, $login, $mdp,null)";

        $resultat = $pdo->exec($req);
        if ($resultat == 1) {
            $reussi = true;
        }
    }
    return $reussi;
}

function verification($login, $mdp) {
    $resultat = false;
    $pdo = gestionnaireDeConnexion();
    if ($pdo != false) {
        $sql = "SELECT * FROM Utilisateur WHERE login=:login AND mdp=:mdp";
        $prep = $pdo->prepare($sql);
        $prep->bindParam(':login', $login, PDO::PARAM_STR);
        $prep->bindParam(':mdp', $mdp, PDO::PARAM_STR);

        $prep->execute();
        if ($prep) {
            $resultat = $prep->fetch();
        }
        $prep->closeCursor();
    }
    return $resultat;
}

?>