<?php
    require_once 'utils.inc.php';
    session_start();
    start_page('Login');
    if ($_GET['Error'])
    {
        echo 'Mauvais Login ou Mot de passe' . '<br/><br/>';
    }
    if ($_SESSION['Login'])
    {
        echo '<form id="Unlog" action="delog.php" method="post">
                <input type="submit" name="Deconnexion" value="Deconnexion"/><br/>';
        die ('Vous êtes déjà identifé.');
    }
?>
<form id="Log" action="test-login.php" method="post">
    <label for="Login">Login</label>
    <input type="text" name="Login" value=""/><br/>
    <label for="Password">Password</label>
    <input type="password" name="Password" value=""/><br/>
    <input type="submit" name="action" value="Connexion">
</form>
<?php
    end_page();
?>