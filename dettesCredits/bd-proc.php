<?php
/**
 * Created by PhpStorm.
 * User: Links
 * Date: 01/12/2016
 * Time: 22:18
 */

function ConnexionBD ()
{
    try
    {
        $dns = 'mysql:host=mysql-oyashiro.alwaysdata.net;dbname=oyashiro_inscription';
        $pdo = new PDO($dns, 'oyashiro', 'thepassword');
        $pdo->exec('SET CHARACTER SET utf8');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    catch (PDOException $e)
    {
        die('Erreur : '. $e->getMessage());
    }
}

function executeQuery ($rq)
{
    $pdo = ConnexionBD();
    if (!$pdo  || !$rq)
    {
        return false;
    }
    else
    {
        $stmt = $pdo->prepare($rq);
        $id = 1;
        $stmt->bindValue('id', $id, PDO::PARAM_INT);
        try
        {
            $stmt->execute();
            return $stmt;
        }
        catch (PDOException $e)
        {
            echo 'Erreur : ', $e->getMessage(), PHP_EOL;
            echo 'Requete : ', $rq, PHP_EOL;
            die();
        }
    }
}

function ModifierCreance($nomEndette, $nomCreancier, $montant){

    if ($montant > 0)
        $query = 'UPDATE CREANCE SET Endette = \'' . $nomEndette . '\', Creancier = \'' . $nomCreancier . '\', Montant = Montant + '. $montant . ' WHERE Endette = \'' . $nomEndette . '\' AND Creancier = \'' . $nomCreancier . '\';';
    else
        $query = 'UPDATE CREANCE SET Endette = \'' . $nomEndette . '\', Creancier = \'' . $nomCreancier . '\', Montant = Montant - '. -1 * $montant . ' WHERE Endette = \'' . $nomEndette . '\' AND Creancier = \'' . $nomCreancier . '\';';
    executeQuery($query);
}

function AjouterCreance($nomEndette, $nomCreancier, $montant){
    $query = 'INSERT INTO CREANCE VALUE (\'' . $nomEndette . '\', \'' . $nomCreancier . '\', ' . $montant . ');';
    executeQuery($query);
}

function addCreance($nomEndette, $nomCreancier, $montant){
    $Done = false;
    $query = 'SELECT * FROM CREANCE';
    $res = executeQuery($query);
    $listEnde = array();
    $listCrea = array();
    $listMont = array();
    $i = 0;
    while ($res2 = $res->fetch(PDO::FETCH_OBJ)){
        $listEnde[$i] = $res2->Endette;
        $listCrea[$i] = $res2->Creancier;
        $listMont[$i] = $res2->Montant;
        ++$i;
    }

    if (in_array($nomEndette, $listEnde)){
        for ($i = 0; i < count($listEnde); ++$i) {
            if ($listEnde[$i] == $nomEndette && $listCrea[$i] == $nomCreancier) {
                ModifierCreance($nomEndette, $nomCreancier, $montant);
                $Done = true;
                break;
            }
            if ($i != 0 && $listEnde[$i] != $nomEndette && $listEnde[$i-1] == $nomEndette) {
                break;
            }
        }
    }

    if (in_array($nomEndette, $listCrea) && $Done == false){
        for ($i = 0; i < count($listEnde); ++$i) {
            if ($listCrea[$i] == $nomEndette && $listEnde[$i] == $nomCreancier) {
                ModifierCreance($nomCreancier, $nomEndette, -1 * $montant);
                $Done = true;
                break;
            }
        }
        if (!$Done){
            AjouterCreance($nomCreancier, $nomEndette, $montant);
        }

    }

    if (!$Done) {
        AjouterCreance($nomEndette, $nomCreancier, $montant);
    }
}

function DisplayDette (){
    $query = 'SELECT * FROM CREANCE';
    $res = executeQuery($query);
    $listEnde = array();
    $listCrea = array();
    $listMont = array();
    $i = 0;

    while ($res2 = $res->fetch(PDO::FETCH_OBJ)){
        $listMont[$i] = $res2->Montant;

        if ($listMont[$i] > 0){
            $listEnde[$i] = $res2->Endette;
            $listCrea[$i] = $res2->Creancier;
        }
        else {
            $listEnde[$i] = $res2->Creancier;
            $listCrea[$i] = $res2->Endette;
            $listMont[$i] *= -1;
        }
        ++$i;
    }

    for ($i = 0; $i < count($listEnde); ++$i)
        echo $listEnde[$i] . ' doit ' . $listMont[$i] . ' à ' . $listCrea[$i] . '<br/><br/>';
}