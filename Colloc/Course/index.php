<html>
	<head>
		<title>Course Colloc' Des Otaku</title>
		<meta name="author" content="Oyashiro"/>
		<meta name="description" content="Liste de course 'pour se facilité la vie :D"/>
		<meta name="keywords" content="Colloc', collocation, course, produit, achat, patate, weiss, drive, des choses, ..., ok, stop, !"/>
	</head>
	<body>
		<div id="AjoutCourse" style="display: inline-block;">
			<p>Ajout dans la liste de course</p>
			<form action="AjoutCourse.php" method="post">
				<textarea name="Ajout" rows="10" cols="50"></textarea>
				<input type="submit" name="action" value="Envoyer">
			</form>
		</div>
		<div id="AjoutDesc" style="display: inline-block;">
			<p>Un détail à ajouter ?</p>
			<form action="AjoutDesc.php" method="post">
				<textarea name="Ajout" rows="10" cols="50"></textarea>
				<input type="submit" name="action" value="Envoyer">
			</form>
		</div>
		<div id="Precision">
			<p>
				Format de l'ajout dans la liste : <br/>
				_ [produit1] | [quantité1] (nombre de fois le produit)<br/>
				_ [produit2] <br/>
				... <br/>
				<br/>
                <br/>
                <br/>
				Format de l'ajout de description : <br/>
                _ [produit1] | [Description1] <br/>
				(produit1 doit exister dans la liste de course !) <br/>
                <br/>
                <br/>
                Pour voir les descriptions (poids, litre, gout...) laisser le curseur sur le produit 2 secondes. Si aucune bulle de texte n'apparait, il n'y a pas de description
			</p>
		</div>
        <div id="ListeCourse" style="position: fixed;padding: 10px; top: 20px; right: 20px; border: solid black 1px; border-radius: 10px;">
            <p>Liste de course</p>
            <?php
                require_once('../BD/BDProc.php');
                AffichageCourse();
            ?>
        </div>
	</body>
</html>