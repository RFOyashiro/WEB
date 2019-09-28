<?php
    session_start();
    require_once 'base.php';
    $dbLink = connexionBD();
    $Login = $_POST['Login'];
    $Password = md5($_POST['Password']);
    $query = 'SELECT PSEUDO, MDP FROM Utilisateur WHERE PSEUDO = ' . '\'' . $Login . '\'';
    $dbResult = verifRequete($query, $dbLink);
    $dbRow = mysqli_fetch_assoc($dbResult);
    if ($dbRow['PSEUDO'] == $Login && $dbRow['MDP'] == $Password)
    {
        $_SESSION['Login'] = 1;
        $_SESSION['Pseudo'] = $Login;
        header('Location: /TP2/Bienvenue.php?sid=' . session_id());
        exit();
    }
    header('Location: /TP2/login.php?Error=1');
?>
