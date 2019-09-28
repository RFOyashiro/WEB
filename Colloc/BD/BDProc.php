<?php


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

function Rqt ($rq)
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

function AjoutCourseBD ($Ajout, $AQte)
{
    $Query = 'SELECT Produit, Qte FROM Course;';
    $Result = Rqt($Query);
    $Produit = array();
    $Qte = array();
    $i = 0;

    while ($Result2 = $Result->fetch(PDO::FETCH_OBJ))
    {
        $Produit[$i] = $Result2->Produit;
        $Qte[$i] = $Result2->Qte;

        $i++;
    }

    echo '<br/>Before Rq ------------- <br/> <br/>';

    for ($j = 0; $j < count($Ajout); ++$j)
    {
        echo $Ajout[$j] .' | ' . $AQte[$j] . '<br/>';
    }

    echo '<br/>In BD ------------- <br/> <br/>';

    for ($j = 0; $j < count($Produit); ++$j)
    {
        echo $Produit[$j] . ' | ' . $Qte[$j] . '<br/>';
    }


    for ($j = 0; $j < count($Ajout); ++$j)
    {
        echo '--- ' . in_array($Ajout[$j], $Produit) . ' ---<br/>';
        if(in_array($Ajout[$j], $Produit))
        {
            for ($k = 0; $k < count($Produit); ++$k)
            {
                if ($Ajout[$j] == $Produit[$k])
                {
                    $Qte[$k] += $AQte[$j];
                    break;
                }
            }
        }
        else
        {
            $Produit[count($Produit)] = $Ajout[$j];
            $Qte[count($Qte)] = $AQte[$j];
        }
    }

    for ($j = 0; $j < count($Produit); ++$j)
    {
        $Query = 'DELETE FROM Course WHERE Produit = \'' . $Produit[$j] . '\';';
        $Result = Rqt($Query);
    }

    echo '<br/>In Array ------------- <br/> <br/>';

    for ($j = 0; $j < count($Produit); ++$j)
    {
        echo $Produit[$j] . ' | ' . $Qte[$j] . '<br/>';
    }

    for ($j = 0; $j < count($Produit); ++$j)
    {
        $Query = 'INSERT INTO Course (Produit, Qte) VALUES (\'' . $Produit[$j] . '\',\'' . $Qte[$j] . '\');';
        $Result = Rqt($Query);
    }
}

function AjoutDescBD ($Ajout, $ADesc)
{
    $Query = 'SELECT Produit, Descr FROM Description;';
    $Result = Rqt($Query);
    $Produit = array();
    $Desc = array();
    $i = 0;

    while ($Result2 = $Result->fetch(PDO::FETCH_OBJ))
    {
        $Produit[$i] = $Result2->Produit;
        $Desc[$i] = $Result2->Descr;

        $i++;
    }

    echo '<br/>Before Rq ------------- <br/> <br/>';

    for ($j = 0; $j < count($Ajout); ++$j)
    {
        echo $Ajout[$j] .' | ' . $ADesc[$j] . '<br/>';
    }

    echo '<br/>In BD ------------- <br/> <br/>';

    for ($j = 0; $j < count($Produit); ++$j)
    {
        echo $Produit[$j] . ' | ' . $Desc[$j] . '<br/>';
    }


    for ($j = 0; $j < count($Ajout); ++$j)
    {
        echo '--- ' . in_array($Ajout[$j], $Produit) . ' ---<br/>';
        if(in_array($Ajout[$j], $Produit))
        {
            for ($k = 0; $k < count($Produit); ++$k)
            {
                if ($Ajout[$j] == $Produit[$k])
                {
                    $Desc[$k] = $ADesc[$j];
                    break;
                }
            }
        }
        else
        {
            $Produit[count($Produit)] = $Ajout[$j];
            $Desc[count($Desc)] = $ADesc[$j];
        }
    }

    for ($j = 0; $j < count($Produit); ++$j)
    {
        $Query = 'DELETE FROM Description WHERE Produit = \'' . $Produit[$j] . '\';';
        $Result = Rqt($Query);
    }

    echo '<br/>In Array ------------- <br/> <br/>';

    for ($j = 0; $j < count($Produit); ++$j)
    {
        echo $Produit[$j] . ' | ' . $Desc[$j] . '<br/>';
    }

    for ($j = 0; $j < count($Produit); ++$j)
    {
        $Query = 'INSERT INTO Description (Produit, Descr) VALUES (\'' . $Produit[$j] . '\',\'' . $Desc[$j] . '\');';
        $Result = Rqt($Query);
    }
}

function AffichageCourse(){
    $QueryC = 'SELECT Produit, Qte FROM Course';
    $QueryD = 'SELECT Produit, Descr FROM Description';

    $ResultC = Rqt($QueryC);
    $ResultD = Rqt($QueryD);

    $ProduitC = array();
    $ProduitD = array();
    $Qte = array();
    $Desc = array();

    $i = 0;
    $j = 0;

    while ($ResultC2 = $ResultC->fetch(PDO::FETCH_OBJ))
    {
        $ProduitC[$i] = $ResultC2->Produit;
        $Qte[$i] = $ResultC2->Qte;

        $i++;
    }

    while ($ResultD2 = $ResultD->fetch(PDO::FETCH_OBJ))
    {
        $ProduitD[$j] = $ResultD2->Produit;
        $Desc[$j] = $ResultD2->Descr;

        $j++;
    }

    /*for ($j = 0; $j < count($ProduitD); ++$j)
    {
        echo $ProduitD[$j] . ' | ' . $Desc[$j] . '<br/>';
    }*/

    for ($k = 0; $k < count($ProduitC); ++$k)
    {
        echo '<p';
        if (in_array($ProduitC[$k], $ProduitD))
        {
            for ($l = 0; $l < count($ProduitD); ++$l)
            {
                if ($ProduitC[$k] == $ProduitD[$l])
                {
                    echo ' title="' . $Desc[$l] . '"';
                }
            }
        }
        echo '>- ' . $ProduitC[$k] . ' x ' . $Qte[$k] . '<br/></p>';
    }
}