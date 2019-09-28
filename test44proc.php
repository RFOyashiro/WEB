<?php
	session_start();
	$All = explode ("\n", $_POST['DeckList']);
	$_SESSION['IdMusic'] = $All;
	header('Location: test44.php');