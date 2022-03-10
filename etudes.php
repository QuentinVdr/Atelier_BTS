<?php
//pour pouvoir utiliser les sessions
session_start();
//token anti forgery (ou anti faille CSRF)
$token=uniqid();
//je le stocke en session
$_SESSION["token"]=$token;

if( $_SESSION["login_groupe"]!=True){
    header("location: index.php");
}
//var_dump($_SESSION["login_groupe"]);

require_once "config.php";
$pdo = new PDO("mysql:host=" . Config::SERVER . ";dbname=" . Config::BDD, Config::USER, Config::PASSWORD);
$requete = $pdo->prepare("select * from etude");
$requete->execute();
$etudes = $requete-> fetchAll();

$title="etudes - Ifrocean";
require_once "header.php";
require_once "navbar.php";
?>

    <div class="container">

        <h1>Bienvenue sur le site de releves de ifrocean</h1>
        <p>Nous sommes une assosiation qui realise des releves sur des plages pour analiser les population de crustaser sur les plages</p>

        <h2>Etude realiser :</h2>
        <?php
        if($etudes == false){
            echo "<p>Il n'y a pas eu d'etudes recement</p>";
        }
        else{
            echo "<div class='row row-cols-1 row-cols-md-3'>";
            foreach ($etudes as $e) { ?>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $e["nom"]; ?></h5>
                        <a href=".php?id=<?php echo $e["id"]; ?>" class="btn">Enregistrer relevé</a>
                    </div>
                </div>
            <?php }
            echo "</div>";
        } ?>

    </div>

<?php
require_once "footer.php";
?>
