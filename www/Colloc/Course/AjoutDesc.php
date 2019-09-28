<?php
require_once('../BD/BDProc.php');

$ProduitDesc = explode('_', $_POST['Ajout']);

$Produit = array();
$Desc = array();
$j = 0;

for ($i = 1; $i < count($ProduitDesc); ++$i)
{
    $Produit[$j] = explode('|', $ProduitDesc[$i])[0];
    $Produit[$j] = rtrim($Produit[$j]);
    $Produit[$j] = ltrim($Produit[$j]);
    $Produit[$j] = ucfirst($Produit[$j]);
    echo $Produit[$j]. '<br/>';
    if (explode('|', $ProduitDesc[$i])[1])
    {
        //echo explode('|', $ProduitQte[$i])[1] . '<br/>';
        $Desc[$j] = ucfirst(rtrim(ltrim(explode('|', $ProduitDesc[$i])[1])));
    }

    echo $Desc[$j]. '<br/>';

    ++$j;
}

AjoutDescBD($Produit, $Desc);
header('Location: ./index.php');