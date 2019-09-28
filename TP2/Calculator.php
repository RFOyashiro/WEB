<?php
    require 'utils.inc.php';
    session_start();
    start_page('Calculator');
    if (!($_SESSION['Login']))
    {
        echo '<a href="Inscription.php">Inscription</a>' . '<br/>';
        echo '<a href="login.php">Connexion</a>' . '<br/><br/>';
        die ('Il faut être inscrit pour voir cette page.');
    }
    if(isset($_GET['op1']) && isset($_GET['op']) && isset($_GET['op2']))
    {
        $op1 = $_GET['op1'];
        $op = $_GET['op'];
        $op2 = $_GET['op2'];
        echo $op1 . ' ' . $op . ' ' . $op2 . ' = ';
        //echo $op1 . ("$op") . $op2;
    }
    $operateurs = '*+-/';
?>
<form action="Calcul.php" method="post">
    <label for="op1">Operateur 1</label>
    <input type="text" name="op1"/><br/>
    <?php
        for($cpt = 0 ; $cpt <= 3 ; ++$cpt)
        {
            echo '<input ';
            if($cpt == 0)
            {
                echo 'checked="checked" ';
            }
            echo 'type="radio" name="op" value="' . $operateurs[$cpt] . '"/>' . $operateurs[$cpt] . "\n";
        }
    ?><br/>
    <label for="op2">Operateur 2</label>
    <input type="text" name="op2"/><br/>
    <input type="submit" name="submit"/><br/>
</form>
<?php end_page(); ?>