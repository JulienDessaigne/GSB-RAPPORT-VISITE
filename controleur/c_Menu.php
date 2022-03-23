<?php
/*
 * Description de c_Menu.php
 * Page principale de l'application, accès aux différents sous menu
 * auteur Julien Dessaigne  
 * Creation 13/09/2021
 * Derniere MAJ 04/10/2021
*/
/**
 * @package ProjectGSB
 * @subpackage controleur
 * @author Julien
 * @version 04/10/2021
 * @include modele/authentification.inc.php
 * @include vue/fond.html.php
 * @include vue/vueMenu.php
 */

//inclue des fonctions d'authentification
require_once "$racine/modele/authentification.inc.php";

$matV=$_SESSION["matV"];
$profil=getInfoVisiteurbyMatV($matV);


require "$racine/vue/fond.html.php";
require "$racine/vue/vueMenu.php";