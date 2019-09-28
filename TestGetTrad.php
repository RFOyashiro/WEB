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
		
		$cardName = explode('<b>', $namefs[19]);
		$cardName2 = explode('</b>', $cardName[1]);
		
		echo '<div style="text-align: center;">Card Name : ' . $cardName2[0] . '</div><br/>';		
		
		$carteImg3 = str_replace('-', '_', $_SESSION['IdCard'][$i]);
		$carteId = explode('_', $carteImg3);
		
		
		
		echo '<img style="display: block; margin-left: auto; margin-right: auto" src="http://wsdecks.com/static/img/' . $Serie . '/' . $carteId[0] . '/' . $Serie . '_' . $carteImg3 . '.gif"/><br/>';

		
		
		$first_stepTrad = explode('<td class="cards3">', $content);
		$second_stepTrad = explode('</td>', $first_stepTrad[1]);

		echo '<div style="text-align: center;">' . $second_stepTrad[0] . '</div><br/><br/><br/><br/>';
	}/*
	else if (!preg_match('#^+[0-9]$#')
		echo $_SESSION['IdCard'][$i] . ' Nope <br/>';*/
}

?>

</body>
