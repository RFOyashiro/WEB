<?php
require_once('../BD/BDProc.php');

$ProduitDesc = explode('_', $_POST['Ajout']);

$Produit = array();
$Qte = array();
$j = 0;

echo 'Before BD ------------- <br/> <br/>';

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
        $Qte[$j] = rtrim(ltrim(explode('|', $ProduitDesc[$i])[1]));
    }
    else
    {
        $Qte[$j] = 1;
    }

    echo $Qte[$j]. '<br/>';

    ++$j;
}

AjoutCourseBD($Produit, $Qte);
header('Location: ./index.php');