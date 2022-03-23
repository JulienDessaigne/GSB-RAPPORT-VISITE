<?php
/*
 * Description de vueRapportVisite.php
 * 
 * 
 * 
 * 
 */
/**
 * @package ProjectGSB
 * @subpackage vue
 * @author Julien
 * @version 04/10/2021
 */
/**
 * Vue affichant le formulaire afin de saisir un Rapport de visite 
 */
?>
<html><head>
        <title>formulaire RAPPORT_VISITE</title>        
    </head>
    <body onload="envoyerRequeteCoefPraticien(1)">
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
        <div id="droite" >
            <div id="bas">
                <form name="formRAPPORT_VISITE" method="POST" action="./?action=inserer_rapport_visite">
                    <h1> Rapport de visite </h1>
                    <label class="titre">NUMERO :</label> <h2 name="RAP_NUM" > <?php echo $num ?></h2> 
                    <label class="titre">DATE VISITE :</label><input type="text" size="10" name="RAP_DATEVISITE" class="zone" placeholder="AAAA-MM-JJ" />
                    <label class="titre">PRATICIEN :</label><select  name="PRA_NUM" class="zone"  onchange="javascript:envoyerRequeteCoefPraticien(this.value)" ><?php echo $liste_deroulante_praticien ?></select>
                    <label class="titre">COEFFICIENT :</label><input type="text" size="9" id="PRA_COEFF" class="zone" disabled="disabled"/>

                    <label class="titre">DATE :</label><input type="text" size="10" name="RAP_DATE" class="zone" placeholder="AAAA-MM-JJ"/>
                    <label class="titre">MOTIF :</label><select  name="RAP_MOTIF" class="zone" onClick="selectionne('Autre', this.value, 'RAP_MOTIFAUTRE');">
                        <option value="Périodicité">Périodicité</option>
                        <option value="Actualisation">Actualisation</option>
                        <option value="Relance">Relance</option>
                        <option value="Sollicitation praticien">Sollicitation praticien</option>
                        <option value="Autre">Autre</option>
                    </select><input type="text" name="RAP_MOTIFAUTRE" class="zone" disabled="disabled" />
                    <label class="titre">BILAN :</label><textarea rows="5" cols="50" name="RAP_BILAN" class="zone" ></textarea>
                    <label class="titre" ><h3> Eléments présentés </h3></label>
                    <label class="titre" >PRODUIT 1 : </label><select name="PROD1" class="zone"><?php echo $liste_deroulante_medicament ?></select>
                    <label class="titre" >PRODUIT 2 : </label><select name="PROD2" class="zone"><?php echo $liste_deroulante_medicament ?></select>
                    <label class="titre">DOCUMENTATION OFFERTE :</label><input name="RAP_DOC" type="checkbox" class="zone" checked="false" />
                    <label class="titre"><h3>Echanitllons</h3></label>
                    <div class="titre" id="lignes">
                        <label class="titre" >Produit : </label>
                        <select name="PRA_ECH1" class="zone"><?php echo $liste_deroulante_medicament ?></select><input type="text" name="PRA_QTE1" size="2" class="zone"/>
                        <input type="button" id="but1" value="+" onclick="ajoutLigne(1);" class="zone" />			
                    </div>		
                    <label class="titre">SAISIE DEFINITIVE :</label><input name="RAP_LOCK" type="checkbox" class="zone" checked="false" />
                    <label class="titre"></label><div class="zone"><input type="reset" value="annuler"></input><input type="submit"></input>
                        <span id="alerte">
                            <?php
                            if (isset($msgErreur)) {
                                echo $msgErreur;
                            }
                            ?>
                        </span>
                        <span id="succes">
                            <?php
                            if (isset($message)) {
                                echo $message;
                            }
                            ?>
                            
                        </span>
                </form>
            </div>
        </div>
    </body>
</html>