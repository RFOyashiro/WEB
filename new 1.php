<body>
<form action="ProcGetTrad.php" method="post">
	<textarea name="DeckList" rows="10" cols="50"></textarea>
	<input type="submit" name="action" value="Get Trad">
</form>
<br/>	

<?php
session_start();
/*
$IdCardAll = array();

$IdCardTrop = explode('IM/', $_GET['DeckList']);
$IdCard = explode(' ', $IdCardTrop[1]);*/

//echo count($_SESSION['IdCard']) . '<br/>';

$Serie = '';
for ($i = 0; $i < count($_SESSION['IdCard']); $i++)
{
	if (preg_match('#^[A-Z0-9]+[A-Z0-9]?[A-Z0-9]#', $_SESSION['IdCard'][$i]) && !(preg_match('#^(S|W)(E|P)?[0-9]+-#',$_SESSION['IdCard'][$i])))
	{
		$Serie = $_SESSION['IdCard'][$i];
		//echo $Serie . '<br/>';
	}
	else if (preg_match('#^(S|W)(E|P)?[0-9]+-#',$_SESSION['IdCard'][$i]))
	{
		
		echo '<div style="text-align: center;">Card Num : ' . $_SESSION['IdCard'][$i] . '</div><br/>';
		
		$url = 'http://www.heartofthecards.com/code/cardlist.html?card=WS_' . $Serie . '/' . $_SESSION['IdCard'][$i];
		$content = file_get_contents($url);
		
		$namefs =  explode('<tr', $content);
		
		echo $namefs[19] . '<br/>';
		
		$cardName = explode('<b>', $namefs[19]);
		$cardName2 = explode('</b>', $cardName[1]);
		
		echo $cardName2[0];
		
	}
}