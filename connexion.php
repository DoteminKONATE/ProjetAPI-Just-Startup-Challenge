<?php
define("USER", "justs791325");//je défini le nom d'utilisateur pour se connecter à la base de donné
define("PASSWORD", "x0fwknahdq");//je défini le mot de passe
define("DNS", 'mysql:host=91.216.107.162;dbname=justs791325');
try { $pdo = new PDO(DNS, USER, PASSWORD); }//je crée mon objet PDO qui va me servir plus tard pour les requêtes
catch (PDOException $e) {
    die($e->getMessage());
}
?>