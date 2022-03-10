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
$requete = $pdo->prepare("SELECT * FROM departement ORDER BY numero");
$requete->execute();
$departement = $requete-> fetchAll();

//var_dump($_SESSION["login_admin"], $departement);

$title="edit departement - admin";
require_once "header.php";
require_once "navbar.php";
?>

    <div class="container">

        <table class="table">
            <thead>
            <tr>
                <td>Numéro</td>
                <td>Nom</td>
                <td></td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($departement as $d){?>
            <tr>
                <td><?php echo $d["numero"]; ?></td>
                <td><?php echo $d["nom"]; ?></td>
                <td><a href="" class="btn">modifier</a></td>
                <td><a href="" class="btn">supprimer</a></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>

        <form action="Actions/ajout_departement.php" method="post">
            <input type="hidden" value="<?php echo $token ?>" name="token" id="token">
            <div class="form-group">
                <label for="numero">Numéro du département :</label>
                <input type="text" id="numero" name="numero" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nom">Nom du département :</label>
                <input type="text" id="nom" name="nom" class="form-control" required>
            </div>
            <input type="submit" class="btn">
        </form>

    </div>

<?php
require_once "footer.php";
?>
