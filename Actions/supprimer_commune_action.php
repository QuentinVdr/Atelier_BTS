<?php
//récupration des valeurs
$id = filter_input(INPUT_GET, "id");

//insertion dans la BDD
//Je vais chercher dans la config (si pas encore fait)
require_once "../config.php";
//Faire une connexion à la BDD
$pdo = new PDO("mysql:host=" . Config::SERVER . ";dbname=" . Config::BDD, Config::USER, Config::PASSWORD);
//Préparer la requête
$requete = $pdo->prepare("DELETE FROM commune WHERE id=:id");
$requete->bindParam(":id", $id);

$requete->execute();

//var_dump($id);

header("location: ../edit_communes.php");