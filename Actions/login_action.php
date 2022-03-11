<?php
session_start();

//vérifier le token
$token = filter_input(INPUT_POST, "token");

if ($token != $_SESSION["token"]) {
    die("On te voit");
}

//récupration des valeurs
$login = filter_input(INPUT_POST, "login");
$password = filter_input(INPUT_POST, "password");


require_once "../config.php";
$pdo = new PDO("mysql:host=" . Config::SERVER . ";dbname=" . Config::BDD, Config::USER, Config::PASSWORD);
$requete = $pdo->prepare("select id from groupe where login = :login AND password = :password");
$requete->bindParam(":login", $login);
$requete->bindParam(":password", $password);
$requete->execute();
$result = $requete-> fetch();

//var_dump($email, $password, $result);

if ($result != False){
    $_SESSION["login_groupe"]=True;
    header("location: ../etudes.php");
} else {
    $_SESSION["login_groupe"]=False;
    header("location: ../index.php");
}