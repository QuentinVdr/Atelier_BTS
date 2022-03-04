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
$err = filter_input(INPUT_POST, "err");

require_once "../config.php";
$pdo = new PDO("mysql:host=" . Config::SERVER . ";dbname=" . Config::BDD, Config::USER, Config::PASSWORD);
$requete = $pdo->prepare("select id from admin where email = :email AND MDP = :password");
$requete->bindParam(":email", $login);
$requete->bindParam(":password", $password);
$requete->execute();
$result = $requete-> fetch();

//var_dump($email, $password, $result);

if ($result != False){
    $_SESSION["login"]=True;
    header("location: ../.php");
} else {
    $_SESSION["login"]=False;
    header("location: ../index.php");
}