<?php
/*
 * Description de vueMenu.php
 * 
 * 
 * 
 * 
 */
/**
 * @package ProjectGSB
 * @subpackage vue
 * @author Julien 
 * @version 13/09/2021
 */
/**
 * Vue affichant le menu 
 */
?>
<html>
    <head><title>GSB : Suivi de la Visite médicale </title></head>
    <body>
        <div id="haut"><h1><a href="./?action=menu" method ="POST"><img src="images/logo.jpg" width="100" height="60"/></a>Gestion des visites</h1></div>
        <div id="gauche">
            <h2>Outils</h2>
            <ul><a href="./?action=menu" method ="POST"><li>Menu</li></a></ul>
            <ul><li>Comptes-Rendus</li>
                <ul>
                    <li><a href="./?action=rapport_visite" method="POST"  >Nouveaux</a></li>
                    <li>Consulter</li>
                </ul>
                <li>Consulter</li>
                <ul><li><a href="./?action=medicaments" method="POST" >Médicaments</a></li>
                    <li><a href="./?action=menu" method="POST"  >Praticiens</a></li>
                    <li><a href="./?action=menu" method="POST"  >Autres visiteurs</a></li>
                </ul>
            </ul>
            <ul><a href="./?action=deconnexion" method ="POST"><li>Deconnexion</li></a></ul>
        </div>
        <div id="droite">
            <div id="bas">
                <div class="connexion">
                    <h1>Informations utilisateur</h1>

                    <?php
                    echo "Nom : " . $profil["VIS_NOM"] . "<br>";
                    echo "Prénom : " . $profil["VIS_PRENOM"] . "<br>";
                    echo "Adresse : " . $profil["VIS_ADRESSE"] . "<br>";
                    echo "Code Postal : " . $profil["VIS_CP"] . "<br>";
                    echo "Ville : " . $profil["VIS_VILLE"] . "<br>";
                    ?>
                    <br />
                </div>
            </div>
        </div>
    </body>
</html>

