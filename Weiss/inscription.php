<?php
session_start();
require_once 'Start-End.php';
$script = array ();
head('Inscription', 'Page d\'inscription', 'inscription, utilisateur, mail, mot de passe', 'style.css', $script);

if (isset($_SESSION['login']) || isset($_SESSION['password']))
{
    header('Location: ./index.php');
    exit();
}
if (isset ($_GET['Error'])) {
    if ($_GET['Error'] === 'genCond') {
        echo 'Vous n\'avez pas accepté les conditions générales d\'utilisation' . '<br/><br/>';
    } elseif ($_GET['Error'] === 'emptyPwd') {
        echo 'Le mot de passe ne peut être vide' . '<br/><br/>';
    } elseif ($_GET['Error'] === 'shortPwd') {
        echo 'Le mot de passe doit faire au moins 6 caractères' . '<br/><br/>';
    } elseif ($_GET['Error'] === 'diffPwd') {
        echo 'Le mot de passe et la confimation du mot de passe ne sont pas identiques' . '<br/><br/>';
    } elseif ($_GET['Error'] === 'emptyIdent') {
        echo 'L\'identifiant ne peut être vide' . '<br/><br/>';
    } elseif ($_GET['Error'] === 'emptyMail') {
        echo 'L\'e-mail ne peut être vide' . '<br/><br/>';
    } elseif ($_GET['Error'] === 'usedId') {
        echo 'L\'identifiant est déjà utilisé' . '<br/><br/>';
    } elseif ($_GET['Error'] === 'usedEmail') {
        echo 'L\'e-mail est déjà utilisé' . '<br/><br/>';
    } elseif ($_GET['Error'] === 'button') {
        echo 'Boutton non géré' . '<br/><br/>';
    } elseif ($_GET['Error'] === 'db') {
        echo 'Erreur sur la base de donnée, réesseyez plus tard.' . '<br/><br/>';
    }
}
?>

    <div class="formulaires">
        <form id="formulaire" action="./data-processing-inscription.php" method="post">
            <table>
                <tr>
                    <td><label for="identifier">Identifiant</label></td>
                    <td><input id="identifier" type="text" name="identifier" value=""/></td>
                </tr>

                <tr>
                    <td><label for="e-mail">E-mail</label></td>
                    <td><input id="e-mail" type="email" name="e-mail" value=""/></td>
                </tr>

                <tr>
                    <td><label for="mdp">Mot de passe</label></td>
                    <td><input id="mdp" type="password" name="mdp" value=""/></td>
                </tr>

                <tr>
                    <td><label for="vmdp">Vérification mot de passe</label></td>
                    <td><input id="vmdp" type="password" name="vmdp" value=""/></td>
                </tr>

                <tr>
                    <td><label for="Loaction">Location</label></td>
                    <td><input id="location" type="text" name="location" value=""/></td>
                </tr>

                <tr>
                    <td><label for="cg">Condition Générales</label></td>
                    <td><input id="cg" type="checkbox" name="gc" value="checked"/></td>
                </tr>

                <tr>
                    <td><label for="bds"></label></td>
                    <td><input id="bds" type="submit" name="action" value="Submit"/></td>
                </tr>
            </table>
        </form>
    </div>
