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
                    <a href="edit_departements.php" class="btn" target="_self">Edit Departement</a>
                </li>
                <li>
                    <a href="edit_communes.php" class="btn" target="_self">Edit Commune</a>
                </li>
                <li>
                    <a href=".php" class="btn" target="_self">Edit Plage</a>
                </li>
                <li>
                    <a href=".php" class="btn" target="_self">Edit Espece</a>
                </li>
                <li>
                    <a href="visualiser_etudes.php" class="btn" target="_self">Edit Etude</a>
                </li>
            <?php } ?>
            </ul>
        </div>

    </nav>

</header>