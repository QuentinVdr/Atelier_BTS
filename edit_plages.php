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
$requete = $pdo->prepare("SELECT * FROM plage JOIN commune ON plage.commune_id = commune.id JOIN departement ON commune.departement_id = departement.id");
$requete->execute();
$plages = $requete-> fetchAll();

$requete = $pdo->prepare("SELECT * FROM commune ORDER BY nom");
$requete->execute();
$communes = $requete-> fetchAll();

var_dump($_SESSION["login_admin"], $plages, $communes);

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
            <td>Département</td>
            <td></td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($plages as $p){?>
            <tr>
                <td><?php echo $p["1"]; ?></td>
                <td><?php echo $p["4"]; ?></td>
                <td><?php echo $p["7"]; ?></td>
                <td></td>
                <td><a href="Actions/supprimer_plage_action.php?id=<?php echo $p["0"]?>" class="btn">Supprimer</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <form action="Actions/ajout_plage_action.php" method="post">
        <input type="hidden" value="<?php echo $token ?>" name="token" id="token">
        <div class="form-group">
            <label for="id_commune">Sellectionner la commune</label>
            <select name="id_commune" id="id_commune" class="form-control">
                <option selected disabled>Faites un choix</option>
                <?php foreach($communes as $c){?>
                    <option value="<?php echo $c['id']?>"><?php echo $c['nom']?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="nom">Nom de la plage :</label>
            <input type="text" id="nom" name="nom" class="form-control" required>
        </div>
        <input type="submit" class="btn">
    </form>

</div>

<?php
require_once "footer.php";
?>
