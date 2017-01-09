<?php
require_once 'connexion.php';


function get_list_inscriptions($pdo) { //je passe en paramètre mon objet PDO précédemment créé afin d'exécuter ma requête
    $sql = "SELECT * FROM Inscriptions";
    $exe = $pdo->query($sql); //création de la requête Sql pour aller chercher tous les articles
    $Liste_article = array(); //création d'un tableau qui va contenir tous nos articles
    while($result = $exe->fetch(PDO::FETCH_OBJ)) { //Exécution de la requête définie plus haut
        array_push($Liste_article, array("civilite" => $result->civilite, "nom" => $result->nom, "prenom" => $result->prenom, "datenaissace" => $result->datenaissace, "email" => $result->email, "contact" => $result->contact, "statusentreprise" => $result->statusentreprise, "adresse" => $result->adresse, "codepostale" => $result->codepostale, "ville" => $result->ville, "VotreMotivation" => $result->VotreMotivation, "nomEntreprise" => $result->nomEntreprise, "tailleEntreprise" => $result->tailleEntreprise, "adresseadministrative" => $result->adresseadministrative, "emailEntreprise" => $result->emailEntreprise, "TelephoneEntreprise" => $result->TelephoneEntreprise, "descriptionEntreprise" => $result->descriptionEntreprise)); //on ajoute tous les articles dans notre tableau
    }
    return $Liste_article; //on renvoie le tableau contenant tous nos articles
}


function get_inscription_by_id($id, $pdo) { //je passe en paramètre de ma fonction l'id de l'article souhaité et l'objet PDO pour exécuter la requête
$sql = "SELECT * FROM Inscriptions WHERE idInscription = ".$id; //je réalise ma requête avec l'ID passée en paramètres
$exe = $pdo->query($sql); //j'exécute ma requête
while($result = $exe->fetch(PDO::FETCH_OBJ)) {
     $Detail_inscription = array("civilite" => $result->civilite, "nom" => $result->nom, "prenom" => $result->prenom, "datenaissace" => $result->datenaissace, "email" => $result->email, "contact" => $result->contact, "statusentreprise" => $result->statusentreprise, "adresse" => $result->adresse, "codepostale" => $result->codepostale, "ville" => $result->ville, "VotreMotivation" => $result->VotreMotivation, "nomEntreprise" => $result->nomEntreprise, "tailleEntreprise" => $result->tailleEntreprise, "adresseadministrative" => $result->adresseadministrative, "emailEntreprise" => $result->emailEntreprise, "TelephoneEntreprise" => $result->TelephoneEntreprise, "descriptionEntreprise" => $result->descriptionEntreprise);//je mets le résultat de ma requête dans une variable
}
return $Detail_inscription; //je retourne l'article en question
}



function set_validate_inscription_by_id($id, $pdo) { //je passe en paramètre de ma fonction l'id de l'article souhaité et l'objet PDO pour exécuter la requête
    $sql = "UPDATE Inscriptions SET satusInscription =1 WHERE idInscription =".$id; //je réalise ma requête avec l'ID passée en paramètres
    $exe = $pdo->query($sql); //j'exécute ma requête
    $sql2 = "SELECT * FROM Inscriptions WHERE idInscription = ".$id;
    $exe2 = $pdo->query($sql2);
    while($result = $exe2->fetch(PDO::FETCH_OBJ)) {
        $validate_inscription = array( "satusInscription" => $result->satusInscription);//je mets le résultat de ma requête dans une variable
    }
    return $validate_inscription; //je retourne l'article en question
}




$possible_url = array("get_list_inscriptions", "get_inscriptions", "set_validate" ); //je définis les URLs valables
$value = "Une erreur est survenue"; //je mets le message d'erreur par défaut dans une variable
if (isset($_GET["action"]) && in_array($_GET["action"], $possible_url)) { //si l'URL est OK
    switch ($_GET["action"]) {
        case "get_list_inscriptions": $value = get_list_inscriptions($pdo); break; //Je récupère la liste des articles

        case "get_inscriptions": if (isset($_GET["idInscription"])) $value = get_inscription_by_id($_GET["idInscription"], $pdo);break;

        case "set_validate": if (isset($_GET["idInscription"])) $value = set_validate_inscription_by_id($_GET["idInscription"], $pdo);

        else $value = "Argument manquant"; break; } //si l'ID n'est pas valable je change mon message d'erreur
}
exit(json_encode($value)); //je retourne ma réponse en JSON