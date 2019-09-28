<?php
    require_once 'utils.inc.php';
    require_once 'base.php';
    start_page('Inscription');
    echo 'Bienvenue, ' . $_GET['id'] . '<br/>';
    echo 'votre inscription a bien été enregistrée !';
    echo 'Un mail vous a été envoyé confirmant votre inscrption.';
    echo 'cliquez <a href="login.php">ici</a> pour vous connecter.';
    end_page();
?>