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
$etude = $requete-> fetchAll();

//var_dump($lignes);

$title="Acueil - Ifrocean";
require_once "header.php";
?>

<div class="container">

    <h1>Bienvenue sur le site de releves de ifrocean</h1>
    <p>Nous sommes une assosiation qui realise des releves sur des plages pour analiser les population de crustaser sur les plages</p>


    <h2>Etude realiser :</h2>
    <?php
    if($etude = false){
        echo "<p>Il n'y a pas eu d'etudes recement</p>";
    }
    else{
        echo "<div class='row row-cols-1 row-cols-md-3'>";
        foreach (etudes as $e) { ?>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $e["nom"]; ?></h5>
                    <a href=".php?id=<?php echo $e["id"]; ?>" class="btn btn-primary">Enregistrer relevé</a>
                </div>
            </div>
        <?php }
        echo "</div>";
    } ?>


    <h2>Connexion administrateur</h2>

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

</div>


<?php
require_once "footer.php";
?>
