<?php
session_start();

//vérifier le token
$token=filter_input(INPUT_POST, "token");

if($token!=$_SESSION["token"]) {
    die("On te voit");
}

//récupration des valeurs
$nom = filter_input(INPUT_POST, "nom");
$date = filter_input(INPUT_POST, "date");
$plageSelct = $_POST['plageSelect'];
$estranPA = $_POST['estranP'];
$estranP = array();
foreach ($estranPA as $e) {
    if ($e != Null) array_push($estranP, $e);
}

//insertion dans la BDD
//Je vais chercher dans la config (si pas encore fait)
require_once "../config.php";
//Faire une connexion à la BDD
$pdo = new PDO("mysql:host=" . Config::SERVER . ";dbname=" . Config::BDD, Config::USER, Config::PASSWORD);
//Préparer la requête
$requete = $pdo->prepare("INSERT INTO etude(nom) VALUES(:nom)");
$requete->bindParam(":nom", $nom);
$requete->execute();

$etude_id=$pdo->lastInsertId();

//Préparer requete pour chaque plage selectionner et leurs estrain
for ($i = 0; $i < count($plageSelct); $i++) {
    $requeteP = $pdo->prepare("INSERT INTO plageselect(estran, etude_id, plage_id) VALUES(:estran, :etude_id, :plage_id))");
    $requeteP->bindParam(":etude_id", $etude_id);
    $requeteP->bindParam(":plage_id", $plageSelct[$i]);
    $requeteP->bindParam(":estran", $estranP[$i]);

    $requeteP->execute();
}

//var_dump($nom, $date, $plageSelct, $estranP, $etude_id);

header("location: ../edit_etudes.php");