<?php
//pour pouvoir utiliser les sessions
session_start();
//token anti forgery (ou anti faille CSRF)
$token=uniqid();
//je le stocke en session
$_SESSION["token"]=$token;

if($_SESSION["login_admin"]!=True){
    header("location: index.php");
}

require_once "config.php";
$pdo = new PDO("mysql:host=" . Config::SERVER . ";dbname=" . Config::BDD, Config::USER, Config::PASSWORD);
$requete = $pdo->prepare("SELECT * FROM etude INNER JOIN plageselect ON etude.id = plageselect.etude_id INNER JOIN plage ON plageselect.plage_id = plage.id");
$requete->execute();
$etudes = $requete-> fetchAll();

var_dump($_SESSION["login_admin"], $etudes);

$title="edit etudes - admin";
require_once "header.php";
require_once "navbar.php";
?>

    <div class="container">

        <table class="table">
            <thead>
            <tr>
                <td>Nom</td>
                <td>Plage</td>
                <td>Estran</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($etudes as $e){?>
            <tr>
                <td><?php echo $e["nom"]; ?></td>
                <td><?php echo $e["nom"]; ?></td>
                <td><?php echo $e["estrain"]; ?></td>
                <td><a href="" class="btn">visualiser</a></td>
                <td><a href="" class="btn">modifier</a></td>
                <td><a href="" class="btn">supprimer</a></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>

    </div>

<?php
require_once "footer.php";
?>
