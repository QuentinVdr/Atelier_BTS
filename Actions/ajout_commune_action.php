<?php
session_start();

//vérifier le token
$token = filter_input(INPUT_POST, "token");

if ($token != $_SESSION["token"]) {
    die("On te voit");
}

//récupration des valeurs
$nom = filter_input(INPUT_POST, "nom");
$id_d = filter_input(INPUT_POST, "id_departement");

//insertion dans la BDD
//Je vais chercher dans la config (si pas encore fait)
require_once "../config.php";
//Faire une connexion à la BDD
$pdo = new PDO("mysql:host=" . Config::SERVER . ";dbname=" . Config::BDD, Config::USER, Config::PASSWORD);
//Préparer la requête
$requete = $pdo->prepare("insert into commune(nom, departement_id) values (:nom, :id_d)");
$requete->bindParam(":nom", $nom);
$requete->bindParam(":id_d", $id_d);

$requete->execute();

//var_dump($nom, $id_d, $requete);

header("location: ../edit_communes.php");