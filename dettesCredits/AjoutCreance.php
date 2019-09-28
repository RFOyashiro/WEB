<?php
/**
 * Created by PhpStorm.
 * User: Links
 * Date: 01/12/2016
 * Time: 23:23
 */
require_once "Creance.php";

$Creancier = explode(',', $_POST['Endettes']);

for ($i = 0; $i < count($Creancier); ++$i){
    if ($_POST['PaieTout'])
        $Creance = new Creance($Creancier[$i], $_POST['Creancier'], $_POST['Montant'] / (count($Creancier)));
    else
        $Creance = new Creance($Creancier[$i], $_POST['Creancier'], $_POST['Montant'] / (count($Creancier) + 1));
    $Creance->enregistrement();
}



header('Location: ./rentrerCreance.php');