<html>
<head>
    <title>Course Colloc' Des Otaku</title>
    <meta name="author" content="Oyashiro"/>
    <meta name="description" content="Test du défi"/>
    <meta name="keywords" content="Test, Dette"/>
</head>
<body>
<div id="AjoutCreance" style="display: inline-block;">
    <form action="AjoutCreance.php" method="post">
        Creancier :
        <input type="text" name="Creancier"/><br/>
        Endettés :
        <textarea name="Endettes"></textarea><br/>
        Montant Total :
        <input type="text" name="Montant"/><br/>
        Remboursement Complet
        <input type="radio" name="PaieTout"/><br/>
        <input type="submit" name="action" value="Envoyer">
    </form>
</div>
<br/>
<?php
/**
 * Created by PhpStorm.
 * User: Links
 * Date: 01/12/2016
 * Time: 23:17
 */
require_once 'bd-proc.php';
DisplayDette();
?>

</body>
</html>

