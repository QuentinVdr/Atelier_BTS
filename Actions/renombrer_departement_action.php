<?php
session_start();

//vérifier le token
$token = filter_input(INPUT_POST, "token");

if ($token != $_SESSION["token"]) {
    die("On te voit");
}

//récupration des valeurs
$id = filter_input(INPUT_POST, "id");
$numero = filter_input(INPUT_POST, "numero");

//insertion dans la BDD
//Je vais chercher dans la config (si pas encore fait)
require_once "../config.php";
//Faire une connexion à la BDD
$pdo = new PDO("mysql:host=" . Config::SERVER . ";dbname=" . Config::BDD, Config::USER, Config::PASSWORD);
//Préparer la requête
$requete = $pdo->prepare("UPDATE departement SET numero=:numero WHERE id=:id");
$requete->bindParam(":id", $id);
$requete->bindParam(":numero", $numero);

$requete->execute();

//var_dump($id, $numero, $requete);

header("location: ../edit_departements.php");