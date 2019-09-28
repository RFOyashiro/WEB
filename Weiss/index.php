<?php
session_start();
require_once 'Start-End.php';

head('Accueil', 'test', 'test', 'style.css',[]);

echo 'Bonjour !<br/>';
echo '<a href="inscription.php">Inscription</a>';

foot();
