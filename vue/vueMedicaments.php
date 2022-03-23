<?php
/*
 * Description de vueMedicaments.php
 * 
 * 
 * 
 * 
 */
/**
 * @package ProjectGSB
 * @subpackage vue
 * @author Logan
 * @version 08/10/2021
 */
/**
 * Vue affichant la page des médicaments 
 */
?>

<html>
    <head>
        <title>formulaire MEDICAMENT</title>
    </head>
    <body>
        <div id="haut"><h1><img src="images/logo.jpg" width="100" height="60"/>Gestion des visites</h1></div>
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
                
                    <h1> Pharmacopee </h1>
                    
                    <label class="titre">MEDICAMENT :</label><select id="select_medicament" onchange="javascript:envoyerRequeteListeMedicaments(this.value)"><?php echo $liste_deroulante_medicament; ?></select><br >
                    <label class="titre">DEPOT LEGAL :</label><input type="text" size="10" id="DepotLegal" name="DepotLegal" class="zone" readonly="readonly" />
                    <label class="titre">NOM COMMERCIAL :</label><input type="text" size="25" id="NomCommercial" name="NomCommercial" class="zone" readonly="readonly"/>
                    <label class="titre">FAMILLE :</label><input type="text" size="3" id="FamilleCode" name="FamilleCode" class="zone" readonly="readonly"/>
                    <label class="titre">COMPOSITION :</label><textarea rows="5" cols="50" id="MedicamentCompo" name="MedicamentCompo" class="zone" readonly="readonly"></textarea>
                    <label class="titre">EFFETS :</label><textarea rows="5" cols="50" id="MedEffets" name="MedEffets" class="zone" readonly="readonly"></textarea>
                    <label class="titre">CONTRE INDIC :</label><textarea rows="5" cols="50" id="MedContrindic" name="MedContrindic" class="zone" readonly="readonly"></textarea>
                    <label class="titre">PRIX ECHANTILLON :</label><input type="text" size="7" id="MedEchantillon" name="MedEchantillon" class="zone" readonly="readonly"/>
                    <label class="titre">&nbsp;</label><input class="zone" id="retour" onclick="boutonsretour()" type="button" value="<"></input><input class="zone" id="avant" onclick="boutonsavant()" type="button" value=">"></input>
                    
                    <label class="titre">MEDICAMENTS EN INTERACTION :</label><table class ="titre" id="interaction"><tbody id="interaction_med"><tbody></table>
                
            </div>

        </div>
    </body>
</html>
<?php



