<?php
/**
 * Created by PhpStorm.
 * User: s14004402
 * Date: 23/03/16
 * Time: 15:51
 */
 
session_start();

function Connection (){
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

function SearchSerie($serie){
    $query = 'SELECT Num, Name, Type, Color, Level, Cout, Trig FROM WeissCard WHERE SERIE1 = \'' . $serie . '\' OR SERIE2 = \'' . $serie . '\' ORDER BY Num';
    return ExecuteQuery($query);
}

function SearchCard($num){
    $query = 'SELECT Num, Name, Type, Color, Level, Cout, Trig, Serie1 FROM WeissCard WHERE NUM = \'' . $num . '\'';
    return ExecuteQuery($query);
}

/*function SortBy($sortType){

}*/

function addDeck($deck){
	
	$query2 = 'INSERT INTO DeckList (NomDeck, Auteur) VALUES (\'' .
		$_SESSION['nomDeck'] . '\', \'' . $_SESSION['name'] . '\')';
	ExecuteQuery($query2);

    $query1 = 'SELECT MAX(NumDeck) as NumDeck FROM DeckList WHERE nomDeck = \'' . $_SESSION['nomDeck'] . '\'';
    $numDeck = ExecuteQuery($query1);
    $numDeck2 = $numDeck->fetch(PDO::FETCH_OBJ);
    $idDeck = $numDeck2->NumDeck;
	
	for ($i = 0; $i < count($deck); $i++){
		$query3 = 'INSERT INTO DeckComposition (NumCarte, NbExemplaire, NumDeck) VALUES (\'' .
			$deck[$i]['num'] . '\', ' . $deck[$i]['nbFois'] . ', ' . $idDeck . ')';
		ExecuteQuery ($query3);
	}
}

function Inscription ($username, $password, $mail){
	$query = 'INSERT INTO Users (Username, Password, Mail) VALUES (\'' .
			$username . '\', \'' . $password . '\', \'' . $mail . '\')';
	ExecuteQuery($query);
}

function ConnexionCompte($username, $password) {
	$query = 'SELECT * FROM Users WHERE Username = \'' . $username . '\' AND Password = \'' . $password .'\'';
	$result = ExecuteQuery($query);
	if ($result != 'null'){
		return true;
	}
	else {
		return false;
	}
}

function ShowDeck($name){
	$query = 'SELECT NumCarte, NbExemplaire, NumDeck FROM DeckComposition WHERE NumDeck IN (SELECT NumDeck FROM DeckList WHERE name = \'' . $name . '\'';
	return ExecuteQuery($query);
}

function ExecuteQuery($query){
    $pdo = Connection();
    if (!$pdo  || !$query)
    {
        return false;
    }
    else
    {
        $stmt = $pdo->prepare($query);
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
            echo 'Requete : ', $query, PHP_EOL;
        }
    }
}
