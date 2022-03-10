<?php
//pour pouvoir utiliser les sessions
session_start();
//token anti forgery (ou anti faille CSRF)
$token=uniqid();
//je le stocke en session
$_SESSION["token"]=$token;

require_once "config.php";
$pdo = new PDO("mysql:host=" . Config::SERVER . ";dbname=" . Config::BDD, Config::USER, Config::PASSWORD);
$requete = $pdo->prepare("select * from etude");
$requete->execute();
$etudes = $requete-> fetchAll();

//var_dump($lignes);

$title="Accueil - Ifrocean";
require_once "header.php";
require_once "navbar.php";
?>

<h1>Connexion administrateur</h1>

    <form method="post" action="Actions/admin_login_actions.php">
        <input type="hidden" name="token" id="token" value="<?php echo $token ?>">
        <div class="form-group col-md-6">
            <label for="email">Login :</label>
            <input type="text" class="form_control" id="login" name="login" placeholder="exemple@mail.com" required>
        </div>
        <br>
        <div class="form-group col-md-6">
            <label for="password">Mot de passe :</label>
            <input type="password" class="form_control" id="password" name="password" placeholder="password" required>
        </div>
        <br>
        <input type="submit" class="btn btn-primary">
    </form>