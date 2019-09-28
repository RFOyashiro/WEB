<?php
/**
 * Created by PhpStorm.
 * User: s14004402
 * Date: 30/03/16
 * Time: 15:52
 */

require_once 'database-process.php';

$query = 'SELECT Num FROM WeissCard';
$result = ExecuteQuery($query);

while ($result2 = $result->fetch(PDO::FETCH_OBJ)) {
    $card = $result2->Num;

    $carteImg = substr($card, strrpos($card, '-'));
    $carteImg2 = str_replace ($carteImg, '', $card);
    $carteImg3 = str_replace ('/', '_', $card);
    $carteImg3 = str_replace('-', '_', $carteImg3);

    $carteLink = $carteImg2 . '/' . $carteImg3;
    $carteLink = 'http://wsdecks.com/static/img/' . $carteLink . '.gif';

    $ch = curl_init($carteLink);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
    curl_exec($ch);

    if (curl_errno($ch)){
        echo $card;
    }

    curl_close($ch);
}