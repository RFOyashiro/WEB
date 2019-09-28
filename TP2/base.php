<?php
    function connexionBD (){
        $dbLink = mysqli_connect('mysql-oyashiro.alwaysdata.net', 'oyashiro', 'thepassword')
        or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

        mysqli_select_db($dbLink , 'oyashiro_inscription')
        or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

        return $dbLink;
    }


    function verifRequete ($query, $dbLink){
        if(!($dbResult = mysqli_query($dbLink, $query)))
        {
            echo 'Erreur de requête<br/>';
            echo 'Erreur : ' . mysqli_error($dbLink) . '<br/>';
            echo 'Requête : ' . $query . '<br/>';
            exit();
        }
        return $dbResult;
    }

    function dispInscSuccess ($dbResult){
        while ($dbRow = mysqli_fetch_assoc($dbResult)) {
            echo 'bienvenue, ' . $dbRow['PSEUDO'] . '<br/>';
            echo 'votre inscription à bien été enregistrée !';
            echo '<br/><br/>';
        }
    }
?>