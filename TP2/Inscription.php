<?php
    session_start();
    if ($_SESSION['Login'])
    {
        die ('Vous êtes déjà identifié.');
    }
    require_once 'utils.inc.php';
    start_page('TP2');
    if ($_GET['Error'] == 'PseudoUti')
    {
        echo 'L\'identifiant est déjà utilisé' . '<br/><br/>';
    }
    if ($_GET['Error'] == 'cg')
    {
        echo 'Vous n\'avez pas accepté les conditions générales d\'utilisation' . '<br/><br/>';
    }
    if ($_GET['Error'] == 'passD')
    {
        echo 'Le mot de passe et la confimation du mot de passe ne sont pas identique' . '<br/><br/>';
    }
    if ($_GET['Error'] == 'passV')
    {
        echo 'Le mot de passe ne peut être vide' . '<br/><br/>';
    }
    if ($_GET['Error'] == 'pseudoV')
    {
        echo 'L\'identifiant ne peut être vide' . '<br/><br/>';
    }
    if ($_GET['Error'] == 'MailV')
    {
        echo 'L\'e-mail ne peut être vide' . '<br/><br/>';
    }
    if ($_GET['Error'] == 'NonText')
    {
        echo 'L\'identifiant n\'est pas un texte' . '<br/><br/>';
    }
    if ($_GET['Error'] == 'NonNum')
    {
        echo 'Le numéro n\'est pas un texte' . '<br/><br/>';
    }
    if ($_GET['Error'] == 'PseudoInv')
    {
        echo '<p>L\'identifiant est invalide.
                 il ne peux prendre que les caractères entre
                 A-Z, a-z, 0-9 et . _ -
              </p>' . '<br/><br/>';
    }
    if ($_GET['Error'] == 'PassInv')
    {
        echo '<p>L\'identifiant est invalide.
                 il ne peux prendre que les caractères entre
                 A-Z, a-z, 0-9 et . _ -
              </p>' . '<br/><br/>';
    }
?>
<form id="formulaire" action="data-processing.php" method="post">
    <label for="identifiant">Identifiant</label>
    <input type="text" name="identifiant" value=""/><br/>
    <label for="civilite">Civilité</label><br/>
    <input type="radio" name="civilite" value="Homme"/>Homme<br/>
    <input type="radio" name="civilite" value="Femme"/>Femme<br/>
    <label for="e-mail">E-mail</label>
    <input type="text" name="e-mail" value=""/><br/>
    <label for="mdp">Mot de passe</label>
    <input type="password" name="mdp" value=""/><br/>
    <label for="vmdp">Vérification mot de passe</label>
    <input type="password" name="vmdp" value=""/><br/>
    <label for="tel">Téléphone</label>
    <input type="text" name="tel" value=""/><br/>
    <label for="pays">Pays</label>
    <input type="text" name="pays" value=""/><br/>
    <label for="cg">Condition Générales</label>
    <input type="checkbox" name="cg" value="NULL"/><br/>
    <label for="bds">Bouton de soumission</label>
    <input type="submit" name="action" value="mailer"/><br/>
</form>
<?php
    end_page();
?>
