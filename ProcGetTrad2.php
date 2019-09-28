<?php
	session_start();
	$All = explode ('/', $_POST['DeckList']);
	$All2 = array();
	$_SESSION['IdCard'] = array();
	for ($i = 0; $i < count($All); $i++)
	{
		array_push($All2, explode(',', $All[$i]));
	}
	for ($i = 0; $i < count($All2); $i++)
	{
		for ($j = 0; $j < count($All2[$i]); $j++)
		{
			echo $All2[$i][$j] . '<br/>';
			array_push($_SESSION['IdCard'], $All2[$i][$j]);
		}
		echo '<br/>';
	}
	header('Location: TestGetTrad2.php');