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
$requete = $pdo->prepare("SELECT * FROM commune JOIN departement WHERE commune.departement_id = departement.id");
$requete->execute();
$commune = $requete-> fetchAll();

$requete = $pdo->prepare("SELECT * FROM departement");
$requete->execute();
$departement = $requete-> fetchAll();

//var_dump($_SESSION["login_admin"], $commune, $departement);

$title="edit cummune - admin";
require_once "header.php";
require_once "navbar.php";
?>

    <div class="container">

        <table class="table">
            <thead>
            <tr>
                <td>Département</td>
                <td>Nom</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($commune as $c){?>
            <tr>
                <td><?php echo $c["4"]; ?></td>
                <td><?php echo $c["1"]; ?></td>
                <td>
                    <form action="Actions/renommer_commune_action.php" method="post">
                        <input type="hidden" id="token" name="token" value="<?php echo $token ?>">
                        <input type="hidden" id="id" name="id" value="<?php echo$c["0"] ?>">
                        <input type="text" id="nom" name="nom" class="form-control" required>
                        <input type="submit" class="btn" value="Renommer">
                    </form>
                </td>
                <td><a href="Actions/supprimer_commune_action.php?id=<?php echo $c["0"]?>" class="btn">Supprimer</a></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>

        <form action="Actions/ajout_commune_action.php" method="post">
            <input type="hidden" value="<?php echo $token ?>" name="token" id="token">
            <div class="form-group">
                <label for="id_departement">Sellectionner le departement</label>
                <select name="id_departement" id="id_departement" class="form-control">
                    <option selected disabled>Faites un choix</option>
                    <?php foreach($departement as $d){?>
                        <option value="<?php echo $d['id']?>"><?php echo $d['nom']?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nom">Nom de la commune :</label>
                <input type="text" id="nom" name="nom" class="form-control" required>
            </div>
            <input type="submit" class="btn">
        </form>

    </div>

<?php
require_once "footer.php";
?>
