<?php
require_once 'baseSimple.php';
ini_set('display_errors', 1);
error_reporting(e_all);
function check_str (& $var) {
    return (!empty ($var) && is_string ($var)) ? $var : '';
}
$action  =              check_str($_POST['action']     );
$id      =              check_str($_POST['identifier'] );
$email   =              check_str($_POST['e-mail']     );
$pwd     = hash(sha512, check_str($_POST['mdp'] )      );
$vpwd    = hash(sha512, check_str($_POST['vmdp'])      );
if (!($_POST['gc']))
{
    header ('Location: inscription.php?Error=genCond');
    exit();
}
elseif (!$pwd)
{
    header ('Location: inscription.php?Error=emptyPwd');
    exit();
}
elseif (strlen($_POST['mdp']) < 6)
{
    header ('Location: inscription.php?Error=shortPwd');
    exit();
}
elseif ($pwd != $vpwd)
{
    header ('Location: inscription.php?Error=diffPwd');
    exit();
}
elseif (!$id)
{
    header ('Location: inscription.php?Error=emptyIdent');
    exit();
}
elseif (!$email)
{
    header ('Location: inscription.php?Error=emptyMail');
    exit();
}
if ($action == 'Submit')
{
    try {
        $stmt1 = getAccountById($id);
        if($stmt1->rowCount())
        {
            header ('Location: inscription.php?Error=usedId');
            exit();
        }
        $stmt1 = getAccountByMail($email);
        if($stmt1->rowCount())
        {
            header ('Location: inscription.php?Error=usedEmail');
            exit();
        }
        $idValidation = md5($id);
        $stmt2 = insertAccount($id, $email, $pwd);
    } catch (PDOException $e) {
        header ('Location: inscription.php?Error=db');
        exit();
    }
    $message  = 'Voici vos identifiants d\'inscription :' . "\n";
    $message .= 'Identifiant : ' . $id . "\n";
    $message .= 'Email : ' . $email . "\n";
    $subject  = 'Bienvenue ' . $id;
    mail ($email, $subject, $message);
    header ('Location: index.php');
}
else
{
    header ('Location: inscription.php?Error=button');
    exit();
}