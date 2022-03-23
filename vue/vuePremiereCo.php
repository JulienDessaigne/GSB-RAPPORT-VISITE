<?php
/*
 * Description de vuePremiereCo.php
 * 
 * 
 * 
 * 
 */
/**
 * @package ProjectGSB
 * @subpackage vue
 * @author Julien Logan
 * @version 05/10/2021
 */
/**
 * Vue permettant de changer le mot de passe
 */
?>
<html>
    <head><title>GSB : Suivi de la Visite médicale </title></head>
    <body>
        <div id="haut"><h1><img src="images/logo.jpg" width="100" height="60"/>Gestion des visites</h1></div>
        <div id="gauche">

        </div>
        <div id="droite">
            <div id="bas">
                <h1>Entrez votre identifiant et choisissez un mot de passe</h1>

                <form action="./?action=premiereco" method="POST">
                    <input type="text" name="matV" placeholder="identifiant" /><br />
                    <input type="password" name="mdpV" placeholder="Nouveau mot de passe"  /><br />
                    <input type="password" name="mdpV2" placeholder="Confirmer mot de passe" /><br />
                    <span id="alerte">
                        <?php
                        if (isset($msgErreur)) {
                            echo $msgErreur . "<br>";
                        }
                        ?>
                    </span>
                    <input type="submit" />

                </form>
                <a href="./?action=connexion">Retour à la page d'authentification<a> <br />
                        <span id="valide">
                            <?php
                            if (isset($message)) {
                                echo $message;
                            }
                            ?>
                        </span>
                        </div>
                        </div>
                        </body>
                        </html>