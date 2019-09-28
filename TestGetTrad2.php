<body>

<?php
session_start();

if ($_SESSION['IdCard'] == '')
{
	echo '<form action="ProcGetTrad2.php" method="post">
	<textarea name="DeckList" rows="10" cols="50"></textarea>
	<input type="submit" name="action" value="Get Trad">
</form>
<br/>	';

}

/*
$IdCardAll = array();

$IdCardTrop = explode('IM/', $_GET['DeckList']);
$IdCard = explode(' ', $IdCardTrop[1]);*/

//echo count($_SESSION['IdCard']) . '<br/>';

$Serie = '';
echo '<table class="Trad"><tr><td>';
$j = 0;
$CX = array();
$CX[0] = false;
for ($i = 0; $i < count($_SESSION['IdCard']); $i++)
{
	if (preg_match('#CX:#',$_SESSION['IdCard'][$i]))
		$CX[0] = true;
		
		
	if (preg_match('#^[A-Z0-9]+[A-Z0-9]?[A-Z0-9]#', $_SESSION['IdCard'][$i]) && !(preg_match('#^(S|W)(E|P)?[0-9]+-#',$_SESSION['IdCard'][$i])))
	{
		$Serie = $_SESSION['IdCard'][$i];
		
	}
	else if (preg_match('#^(S|W)(E|P)?[0-9]+-#',$_SESSION['IdCard'][$i]))
	{		
		$j++;
		$url = 'http://www.heartofthecards.com/code/cardlist.html?card=WS_' . $Serie . '/' . $_SESSION['IdCard'][$i] . '&short=1';
		$content = file_get_contents($url);
		
		$trad =  explode('</body>', explode('<body>' , $content)[1]);
		
		$ImgLink = explode('>', explode ('<img', $trad[0])[1]);
		
		$carteImg3 = str_replace('-', '_', $_SESSION['IdCard'][$i]);
		$carteId = explode('_', $carteImg3);
		
				
		$Img = 'src="https://www.encoredecks.com/images/JP/' . $carteId[0] . '/' . $carteId[1] . '.gif"';
		
		$trad2 = str_replace($ImgLink[0], ' ' . $Img, $trad[0]);
		$trad2 = str_replace('400', '300', $trad2);
		$trad2 = str_replace('12px','15px', $trad2);
		
		if (!$CX[0] && preg_match("#>\n【#", $trad2))
		{
			$trad3 = explode('【', $trad2);
			$trad4 = explode('。', $trad3[count($trad3) - 1]);
			$trad5 = explode('い）', $trad4[count($trad4) - 1]);
			
			
			
			if ($trad5[1] != '') 
			{
				$trad6 = explode('<br>', $trad5[1]);
				$trad7 = explode('</td>', $trad6[0]);
				
				$trad8 = str_replace($trad7[0], '', $trad5[1]);
				
				echo $trad3[0] . $trad8 . '</td>';
			}
			
			else 
			{
				$trad6 = explode('<br>', $trad5[0]);
				$trad7 = explode('</td>', $trad6[0]);
				
				$trad8 = str_replace($trad7[0], '', $trad5[0]);
				
				
				echo $trad3[0] . $trad8 . '</td>';			
			}
		}
		
		//ToDo : Vanilla (Like Event but with "Trait")
		
		else if (preg_match("#>\n-#", $trad2))
		{
			echo $trad2;			
		}
		
		//ToDo : Climax (No "Trait x : None")
		
		else 
		{
					
			$trad3 = explode('Trait', $trad2);
			$trad32 = explode('None', $trad3[2]);
			
			//echo $trad32[1];
			
			$trad4 = explode('。', $trad32[1]);
			
			$trad5 = explode('い）', $trad4[count($trad4) - 1]);
			
			if ($trad5[1] != '') 
			{
				$trad6 = explode('<br>', $trad5[1]);
				$trad7 = explode('</td>', $trad6[0]);
				
				$trad8 = str_replace($trad7[0], '', $trad5[1]);
				
				echo $trad3[0] . $trad8 . '</td>';
			}
			
			else 
			{
				$trad6 = explode('<br>', $trad5[0]);
				$trad7 = explode('</td>', $trad6[0]);
				
				$trad8 = str_replace($trad7[0], '', $trad5[0]);
				
				echo $trad3[0] . $trad8 . '</td>';			
			}
		}
		
		if ($j == 3)
		{
			$j = 0;
			echo '</tr><tr>';
		}
		echo '<td>';
	}
}

echo '</table>';

$_SESSION = array();
?>

</body>
