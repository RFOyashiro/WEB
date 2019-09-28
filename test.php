<?php
	session_start();
	
	echo '<form action="test-proc.php" method="post">
		Numéro Carte : <input type="text" name="card" value=""/>
		<input type="submit" name="submit"/>
		</form>';
		
	if(isset($_GET['Carte'])){	
		$carte = $_GET['Carte'];
		$carteImg = substr($carte, strrpos($carte, '-'));
		$carteImg2 = str_replace ($carteImg, '', $carte);
		$carteImg3 = str_replace ('/', '_', $carte);
		$carteImg3 = str_replace('-', '_', $carteImg3);
		$carteLink = $carteImg2 . '/' . $carteImg3;
		echo '<p>
		Carte ' . $carte . ' : <br/>';
		echo '<img src="http://wsdecks.com/static/img/' . $carteLink . '.gif"/>';
		echo '</p>';
	}
	