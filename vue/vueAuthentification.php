<?php
/*
 * Description de vueAuthentification.php
 * 
 * 
 * 
 * 
 */
/**
 * @package ProjectGSB
 * @subpackage vue
 * @author Julien Logan
 * @version 04/05/2021
 */
/**
 * Vue affichant l'authentification 
 */
echo "Indentifiant = b16 <br> mot de passe = mdp";
?>


<html>
    <head>
        <title>GSB : Suivi de la Visite médicale </title>
    </head>
    <body>
        <div id="haut">
            <h1>
                <img src="images/logo.jpg" width="100" height="60"/>Gestion des visites
            </h1>
        </div>
        <div id="gauche">

        </div>
        <div id="droite">
            <div id="bas">
                <h1>Connexion</h1>



                <form action="./?action=connexion" method="POST">
                    <input type="text" name="matV" placeholder="identifiant" /><br />
                    <input type="password" name="mdpV" placeholder="Mot de passe"  /><br />
                    <span id="alerte">
                        <?php
                        if (isset($msgErreur)) {
                            echo $msgErreur . "<br>";
                        }
                        ?>
                    </span>
                    <input type="submit" />

                </form>
                <a href="./?action=premiereco">Première connexion ?</a>
            </div>
        </div>
    </body>
</html>
<?php 