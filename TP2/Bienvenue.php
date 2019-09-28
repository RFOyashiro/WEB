<?php
    require_once 'utils.inc.php';
    start_page('Bienvenue');
    session_start();
    if (!($_SESSION['Login']))
    {
        echo '<a href="Inscription.php">Inscription</a>' . '<br/>';
        echo '<a href="login.php">Connexion</a>' . '<br/><br/>';
        die ('Il faut être inscrit pour voir cette page.');
    }
    echo 'Bienvenue ' . $_SESSION['Pseudo'];
    end_page();
