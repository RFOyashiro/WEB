<body>
<form action="test44proc.php" method="post">
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
for ($i = 0; $i < count($_SESSION['IdMusic']); $i++)
{
			
		$url = 'http://www.smashcustommusic.com/' . rtrim($_SESSION['IdMusic'][$i]);
		$content = file_get_contents($url);
		
		$NameMusic =  explode('</h1>', explode('<h1 style="text-align:center;">', $content)[1]);
		
		echo $NameMusic[0] . '</br>';
		
	/*
	else if (!preg_match('#^+[0-9]$#')
		echo $_SESSION['IdCard'][$i] . ' Nope <br/>';*/
}

?>

</body>
