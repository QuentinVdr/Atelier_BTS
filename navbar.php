<header id="header">

    <nav class="navbar" role="navigation">

        <div class="site-brand">
            <a href="index.php">
                <img id="logo-ifrocean" src="Photos/Ifrocean.png" alt="Ifrocean" width="640" height="413">
            </a>
        </div>

        <div class="navbar-btn">
            <ul>
            <?php if($_SESSION["login_admin"]=True){?>
                <li>
                    <a href="edit_departements.php" class="btn" target="_self">Edit Departements</a>
                </li>
                <li>
                    <a href="edit_communes.php" class="btn" target="_self">Edit Communes</a>
                </li>
                <li>
                    <a href="edit_plages.php" class="btn" target="_self">Edit Plages</a>
                </li>
                <li>
                    <a href=".php" class="btn" target="_self">Edit Especes</a>
                </li>
                <li>
                    <a href="edit_etudes.php" class="btn" target="_self">Edit Etude</a>
                </li>
            <?php } ?>
            </ul>
        </div>

    </nav>

</header>