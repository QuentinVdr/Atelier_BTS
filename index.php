<?php
//pour pouvoir utiliser les sessions
session_start();
//token anti forgery (ou anti faille CSRF)
$token=uniqid();
//je le stocke en session
$_SESSION["token"]=$token;

$title="Connexion - Ifrocean";
require_once "header.php";
require_once "navbar.php";
?>

<div class="container">

    <div class="login">

        <div class="login_groupe">

            <h2>Connexion groupe d'etude</h2>

            <form method="post" action="Actions/login_action.php">
                <input type="hidden" name="token" id="token" value="<?php echo $token ?>">
                <div class="">
                    <label for="email">Login :</label>
                    <input type="text" class="form_control" id="login" name="login" placeholder="exemple@mail.com" required>
                </div>
                <div class="">
                    <label for="password">Mot de passe :</label>
                    <input type="password" class="form_control" id="password" name="password" placeholder="password" required>
                </div>
                <input type="submit" class="btn">
            </form>

        </div>

        <div class="login_admin">

            <h2>Connexion administrateur</h2>

            <form method="post" action="Actions/admin_login_action.php">
                <input type="hidden" name="token" id="token" value="<?php echo $token ?>">
                <div class="">
                    <label for="email">Login :</label>
                    <input type="text" class="form_control" id="login" name="login" placeholder="exemple@mail.com" required>
                </div>
                <div class="">
                    <label for="password">Mot de passe :</label>
                    <input type="password" class="form_control" id="password" name="password" placeholder="password" required>
                </div>
                <input type="submit" class="btn">
            </form>

        </div>

    </div>

</div>


<?php
require_once "footer.php";
?>
