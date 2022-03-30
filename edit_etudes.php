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
$requete = $pdo->prepare("SELECT * FROM plageselect INNER JOIN etude ON plageselect.etude_id = etude.id INNER JOIN plage ON plageselect.plage_id = plage.id ORDER BY etude.nom");
$requete->execute();
$etudes = $requete-> fetchAll();

$requete = $pdo->prepare("SELECT * FROM plage");
$requete->execute();
$plages = $requete-> fetchAll();

//&var_dump($_SESSION["login_admin"], $etudes);

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
                <td><?php echo $e["5"]; ?></td>
                <td><?php echo $e["7"]; ?></td>
                <td><?php echo $e["1"]; ?></td>
                <td><a href="" class="btn">visualiser</a></td>
                <td><a href="" class="btn">modifier</a></td>
                <td><a href="" class="btn">supprimer</a></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>

        <form action="Actions/ajout_etude_action.php" method="post">
            <input type="hidden" value="<?php echo $token ?>" name="token" id="token">
            <div class="form-group">
                <label for="nom">Nom de l'étude :</label>
                <input type="text" id="nom" name="nom" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="date">Choisir la date et l'heure de l'étude :</label>
                <input type="datetime-local" id="date" name="date" value="<?php echo date('d/m/Y h:i a'); ?>" required>
            </div>
            <div id="plageSelect" class="form-group">
                <?php foreach($plages as $p){?>
                    <input type="checkbox" name="plageSelect[]" id="plage<?php echo $p['id']?>" value="<?php echo $p['id']?>">
                    <label for="plage<?php echo $p['id']?>"><?php echo $p['nom']?></label>
                    <label for="estranP<?php echo $p['id']?>">Estran etudié :</label>
                    <input type="number" name="estranP[]" id="estranP<?php echo $p['id']?>" step="0.5" value="<?php echo Null ?>">
                <?php } ?>
            </div>
            <input type="submit" class="btn">
        </form>

    </div>

<?php
require_once "footer.php";
?>
