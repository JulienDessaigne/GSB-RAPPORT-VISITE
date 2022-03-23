<?php
/*
 * Description de c_Medicaments.php
 * 
 * 
 * 
 * 
 */
/**
 * @package ProjectGSB
 * @subpackage controleur
 * @author  Logan
 * @version 08/10/2021
 * @include modele/authentification.inc.php
 * @include modele/bd.medicament.inc.php
 * @include vue/fond.html.php
 * @include vue/vueMedicaments.php
 */
/**
 * Controleur gérant l'affichage de la vueMedicaments
 */

require_once "$racine/modele/authentification.inc.php";
require_once "$racine/modele/bd.medicament.inc.php";

//création de la liste déroulante des médicaments
$medicaments = getMedicaments();
$liste_deroulante_medicament = "<option selected='selected'>Produit</option>";
for ($i = 0; $i < count($medicaments); $i++) {
    $liste_deroulante_medicament = $liste_deroulante_medicament . "<option value=" . $medicaments[$i]["MED_DEPOTLEGAL"] . ">" . $medicaments[$i]["MED_NOMCOMMERCIAL"] . "</option>";

}


require_once "$racine/vue/fond.html.php";
require_once "$racine/vue/vueMedicaments.php";
