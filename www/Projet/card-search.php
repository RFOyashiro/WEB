<?php
/**
 * Created by PhpStorm.
 * User: s14004402
 * Date: 10/03/16
 * Time: 16:01
 */

require_once 'database-process.php';

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

$obj = new stdClass();

$carte = $_POST['card'];
$carteImg = substr($carte, strrpos($carte, '-'));
$carteImg2 = str_replace ($carteImg, '', $carte);
$carteImg3 = str_replace ('/', '_', $carte);
$carteImg3 = str_replace('-', '_', $carteImg3);
$carteLink = $carteImg2 . '/' . $carteImg3;
$carteLink = 'http://wsdecks.com/static/img/' . $carteLink . '.gif';


$ch = curl_init($carteLink);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
curl_exec($ch);

$result = SearchCard($carte);
$result = $result->fetch(PDO::FETCH_OBJ);
$num = $result->Num;
$name = $result->Name;
$type = $result->Type;
$color = $result->Color;
$level = $result->Level;
$cout = $result->Cout;
$trigger = $result->Trig;

if ($trigger == ""){
	$trigger = "None";
}
$serie = $result->Serie1;

$existe = true;

if ($name == null)  {
        $carteLink = 'https://approachphase.files.wordpress.com/2013/05/148lwsm.png';
        $existe = false;
}

$obj->existe = $existe;
$obj->carte = $carte;
$obj->carteLink = $carteLink;
$obj->numCard = $num;
$obj->nameCard = $name;
$obj->typeCard = $type;
$obj->colorCard = $color;
$obj->levelCard = $level;
$obj->coutCard = $cout;
$obj->triggerCard = $trigger;
$obj->serieCard = $serie;
$obj->success = true;

curl_close($ch);

echo json_encode($obj);