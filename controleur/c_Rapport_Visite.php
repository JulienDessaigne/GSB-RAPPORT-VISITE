<?php
/*
 * Description de c_Rapport_Visite.php
 * 
 * 
 * 
*/

/**
 * @package ProjectGSB
 * @subpackage controleur
 * @author Julien
 * @version 04/10/2021
 * @include modele/authentification.inc.php
 * @include modele/bd.rapportvisite.inc.php
 * @include modele/bd.praticien.inc.php
 * @include modele/bd.medicament.inc.php
 * @include vue/fond.html.php
 * @include vue/vueRapportVisite.php
 */
/**
 * Controleur gérant l'affichage du formulaire de saisi d'un rapport de visite
 */
//include des fonctions
require_once "$racine/modele/authentification.inc.php";
require_once "$racine/modele/bd.rapportvisite.inc.php";
require_once "$racine/modele/bd.praticien.inc.php";
require_once "$racine/modele/bd.medicament.inc.php";


//création de la liste déroulante des praticiens
$praticiens = getPraticien();
$liste_deroulante_praticien = "";
for ($i = 0; $i < count($praticiens); $i++) {
    $liste_deroulante_praticien = $liste_deroulante_praticien . "<option value=" . $praticiens[$i]["PRA_NUM"] . ">" . $praticiens[$i]["PRA_NOM"] . " " . $praticiens[$i]["PRA_PRENOM"] . "</option>";
}

//création de la liste déroulante des médicaments
$medicaments = getMedicaments();
$liste_deroulante_medicament = "<option selected='selected'>Produit</option>";
for ($i = 0; $i < count($medicaments); $i++) {
    $liste_deroulante_medicament = $liste_deroulante_medicament . "<option value=" . $medicaments[$i]["MED_DEPOTLEGAL"] . ">" . $medicaments[$i]["MED_NOMCOMMERCIAL"] . "</option>";
}

//matricule visiteur et numéro du rapport
$matV = $_SESSION["matV"];
$num = getNumeroRapportById($matV);

$num = $num["RapNum"] === null ? $num = 1 : $num = (int) $num["RapNum"] + 1;


require_once "$racine/vue/fond.html.php";
require_once "$racine/vue/vueRapportVisite.php";

