<?php // /!\ RAJOUTER UN CHARACTERE A LA FIN DE L'AVZNT DERNIERE LIGNE DU FICHIER JSON

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

function Add ($Card) {
    $query = 'INSERT INTO YuyuteiCards (`ID`, `TRANSLATION`, `AMOUNT`, `PICLINK`, `PRICE`, `YYTSETCODE`, `RARITY`, `CARDLINK`, `EBFOIL`) VALUES ("' .
              $Card->Card->ID . '", "' . $Card->Card->Translation . '", ' . $Card->Card->Amount . ', "' . $Card->Card->URL . '", ' . $Card->Card->Price . ', "' .
              $Card->Card->YytSetCode . '", "' . $Card->Card->Rarity . '", "' . $Card->Card->CardURL . '", ' . $Card->Card->EBFoil . ');';
    return ExecuteQuery($query);
}

function Update ($Card) {
    $query = 'UPDATE `YuyuteiCards` SET `PRICE`=' . $Card->Card->Price . ' WHERE `ID` = "' . $Card->Card->ID .'" AND `RARITY` = "' . $Card->Card->Rarity . '" ;';
    return ExecuteQuery($query);
}

function InsertOrUpdate ($Card) {
    $query = 'SELECT * FROM YuyuteiCards WHERE ID = "' . $Card->Card->ID . '" AND RARITY = "' . $Card->Card->Rarity . '";';
    $stmt = ExecuteQuery($query);
    if ($stmt->rowCount() == 0)
        return Add($Card);
    else
        return Update($Card);
}



$FILE = fopen("./yyt_infos.json", 'r');
$LigneIgnore = fgets($FILE);
$json = "";
$i = 0;
while (($ligne = fgets($FILE)) !== false)
{
    $json = $json . $ligne;
    $i++;
    if ($i == 1) $json = '{"Card" : {';
    if ($i == 11) {
        $jsonF = substr($json, 0, -3) . '}';
        $Card = json_decode($jsonF);
        InsertOrUpdate($Card);
        $i = 0;
    }
}
echo 'Finish!';
