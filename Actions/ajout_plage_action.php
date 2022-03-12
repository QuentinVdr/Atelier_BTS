<?php
session_start();

//vérifier le token
$token=filter_input(INPUT_POST, "token");

if($token!=$_SESSION["token"]) {
    die("On te voit");
}

//récupration des valeurs
$nom = filter_input(INPUT_POST, "nom");
$commune_id = filter_input(INPUT_POST, "commune_id");

//insertion dans la BDD
//Je vais chercher dans la config (si pas encore fait)
require_once "../config.php";
//Faire une connexion à la BDD
$pdo = new PDO("mysql:host=" . Config::SERVER . ";dbname=" . Config::BDD, Config::USER, Config::PASSWORD);
//Préparer la requête
$requete = $pdo->prepare("INSERT INTO plage(nom, commune_id) VALUES (:nom, :commune_id)");
$requete->bindParam(":nom", $nom);
$requete->bindParam(":commune_id", $commune_id);

$requete->execute();

//var_dump($nom, $id_c, $requete);

header("location: ../edit_plages.php");