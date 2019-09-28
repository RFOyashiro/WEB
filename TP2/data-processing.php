<?php
    session_start();
    require_once 'base.php';
    $dbLink = connexionBD();
    $query1 = 'SELECT PSEUDO FROM Utilisateur WHERE PSEUDO = \'' . $_POST['identifiant'] . '\'' ;
    $dbResult = verifRequete($query1, $dbLink);
    $dbRow = mysqli_fetch_assoc($dbResult);
    if ($_POST['identifiant'] == $dbRow['PSEUDO'])
    {
        header ('Location: /TP2/Inscription.php?Error=PseudoUti');
    }
    if (!($_POST['cg']))
    {
        header ('Location: /TP2/Inscription.php?Error=cg');
    }
    if (($_POST['mdp']) != $_POST['vmdp'])
    {
        header ('Location: /TP2/Inscription.php?Error=passD');
    }
    if (!($_POST['mdp']))
    {
        header ('Location: /TP2/Inscription.php?Error=passV');
    }
    if (!($_POST['identifiant']))
    {
        header ('Location: /TP2/Inscription.php?Error=pseudoV');
    }
    if (!($_POST['e-mail']))
    {
        header ('Location: /TP2/Inscription.php?Error=MailV');
    }
    if (!(is_string($_POST['identifiant'])) || !(is_string($_POST['e-mail'])) || !(is_string($_POST['pays'])))
    {
        header ('Location: /TP2/Inscription.php?Error=NonText');
    }
    if (!(is_int($_POST['tel'])))
    {
        header ('Location: TP2/Inscription.php?Error=NonNum');
    }
    if (!(preg_match('[A-Za-z0-9._-]*', $_POST['identifiant'])))
    {
        header ('Location: TP2/Inscription.php?Error=PseudoInv');
    }
    if (!(preg_match('[A-Za-z0-9._-]*', $_POST['mpd'])))
    {
        header ('Location: TP2/Inscription.php?Error=PassInv');
    }


    $action = $_POST['action'];
    $identifiant = $_POST['identifiant'];
    $civ = $_POST['civilite'];
    $email = $_POST['e-mail'];
    $mdp = md5($_POST['mdp']);
    $mdpmail = $_POST['mdp'];
    $tel = $_POST['tel'];
    $pays = $_POST['pays'];

    $query2 = 'INSERT INTO Utilisateur (PSEUDO, MDP, CIVILITE, TEL, MAIL, PAYS, DATE)'
              . 'VALUES (\'' . $identifiant . '\', \''. $mdp . '\', \'' . $civ . '\', ' . $tel . ', \'' . $email . '\', \''
                      . $pays . '\', ' . 'NOW()' . ')';

    $dbResult = verifRequete($query2, $dbLink);



    if($action == 'mailer')
    {
        $message = 'Voici vos identifiants d\'inscription :' . "\n";
        $message .= 'Identifiant : ' . $identifiant . "\n";
        $message .= 'Email : ' . $email . "\n";
        $message .= 'Mot de passe : ' . $mdpmail . "\n";
        $message .= 'Téléphone : ' . $tel . "\n";
        $message2 = $message . 'Civilité : ' . $civ . "\n";
        $message2 .= 'Pays : ' . $pays . "\n";

        $subject = 'Bienvenue ' . $identifiant;
        $subject2 = 'Nouvelle inscription : ' . $identifiant;

        mail($email, $subject, $message);
        mail ('kurt.savio@hotmail.fr', $subject2, $message2);
        header ('Location: /TP2/InscriptionSuccess.php?id=' . $identifiant); //ToDo : charger une nouvelle page confirmant l'envois du mail
    }
    else
    {
        echo '<br/><strong>Bouton non géré !</strong><br/>';
    }
?>