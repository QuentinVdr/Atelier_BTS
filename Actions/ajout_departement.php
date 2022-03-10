<?php
session_start();

//vérifier le token
$token=filter_input(INPUT_POST, "token");

if($token!=$_SESSION["token"]){
    die("On te voit");
}

//récupration des valeurs
$nom = filter_input(INPUT_POST, "nom");
$numero = filter_input(INPUT_POST, "numero");

var_dump($nom, $numero);

//insertion dans la BDD
//Je vais chercher dans la config (si pas encore fait)
require_once "../config.php";
//Faire une connexion à la BDD
$pdo = new PDO("mysql:host=" . Config::SERVER . ";dbname=" . Config::BDD, Config::USER, Config::PASSWORD);
//Préparer la requête
$requete = $pdo->prepare("insert into departement(nom, numero) values (:nom, :numero)");
$requete->bindParam(":nom", $nom);
$requete->bindParam(":numero", $numero);

//$requete->execute();

//header("location: ../edit_departements.php");