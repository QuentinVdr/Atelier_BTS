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
$requete = $pdo->prepare("SELECT * FROM plage INNER JOIN commune ON plage.commune_id = commune.id INNER JOIN departement ON comunne.departement_id = departement.id");
$requete->execute();
$plages = $requete-> fetchAll();

var_dump($_SESSION["login_admin"], $plages);

$title="edit plages - admin";
require_once "header.php";
require_once "navbar.php";
?>

    <div class="container">

        <table class="table">
            <thead>
            <tr>
                <td>Plage</td>
                <td>Commune</td>
                <td>departement</td>
                <td></td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($plages as $p){?>
            <tr>
                <td><?php echo $p["nom"]; ?></td>
                <td><?php echo $p["nom"]; ?></td>
                <td><?php echo $p["nom"]; ?></td>
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
