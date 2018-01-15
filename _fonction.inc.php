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


function creerArticle($article_titre, $article_contenu, $idUtilisateur) {
    $reussi = false;
    $pdo = gestionnaireDeConnexion();
    if ($pdo != null) {
        $article_titre  = $pdo->quote($article_titre);
        $article_contenu = $pdo->quote($article_contenu);
        $idUtilisateur = $pdo->quote($idUtilisateur);

        $req = "insert into Article values (null, $article_titre, $article_contenu, NOW(), $idUtilisateur)";

        $resultat = $pdo->exec($req);
        if ($resultat == 1) {
            $reussi = true;
        }
    }
    return $reussi;
}

function listeArticles(){
    $lesArticles = array();
    $pdo = gestionnaireDeConnexion();
   if($pdo != null){
       $req = "select * from Article, Utilisateur where Article.idUtilisateur = Utilisateur.idUtilisateur order by dateArticle DESC";
       $pdoStatement = $pdo->query($req);
       $lesArticles = $pdoStatement->fetchAll(PDO::FETCH_ASSOC) ;
   } 
   return $lesArticles;
}


function lireArticle($codeArticle) {
    $detailArticle = null;
    $pdo = gestionnaireDeConnexion();
    if ($pdo != null) {
        $codeArticle = $pdo->quote($codeArticle);
        $req = "select * from Article, Utilisateur where codeArticle= $codeArticle and Article.idUtilisateur = Utilisateur.idUtilisateur ";
        $resultat = $pdo->query($req);
        $detailArticle = $resultat->fetch();
    }
    return $detailArticle;
}


function modifierEtablissement($id, $nom, $adresseRue, $codePostal, $ville, $tel, $adresseElectronique, $type, $civiliteResponsable, $nomResponsable, $prenomResponsable, $nombreChambresOffertes) {

    $modification = false;
    $pdo = gestionnaireDeConnexion();

    if ($pdo != null) {
        $id = $pdo->quote($id);
        $nom = $pdo->quote($nom);
        $adresseRue = $pdo->quote($adresseRue);
        $codePostal = $pdo->quote($codePostal);
        $ville = $pdo->quote($ville);
        $tel = $pdo->quote($tel);
        $adresseElectronique = $pdo->quote($adresseElectronique);
        $type = $pdo->quote($type);
        $civiliteResponsable = $pdo->quote($civiliteResponsable);
        $nomResponsable = $pdo->quote($nomResponsable);
        $prenomResponsable = $pdo->quote($prenomResponsable);
        $nombreChambresOffertes = $pdo->quote($nombreChambresOffertes);

        $req = "update etablissement set nom=$nom,adresseRue=$adresseRue,
		codePostal=$codePostal,ville=$ville,tel=$tel,
		adresseElectronique=$adresseElectronique,type=$type,
		civiliteResponsable=$civiliteResponsable,nomResponsable=
		$nomResponsable,prenomResponsable=$prenomResponsable,
		nombreChambresOffertes=$nombreChambresOffertes where id=$id";

        $resultat = $pdo->exec($req);
        if ($resultat == 1) {
            $modification = true;
        }
    }

    return $modification;
}



?>