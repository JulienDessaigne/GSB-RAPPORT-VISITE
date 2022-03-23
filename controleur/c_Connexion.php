<?php

/*
 * Description de c_Connexion.php
 * 
 * 
 * 
 * 
 */
/**
 * @package ProjectGSB
 * @subpackage controleur
 * @author Julien Logan
 * @version 04/05/2021
 * @include modele/authentification.inc.php
 * @include vue/fond.html.php
 * @include c_Profil.php
 * @include vue/vueAuthentification.php
 */
/**
 * Controleur gérant la connexion de l'utilisateur
 */
require_once "$racine/modele/authentification.inc.php";

$fichier="vue/vueAuthentification.php";
$msgErreur="";

if (filter_has_var(INPUT_POST, 'matV') && filter_has_var(INPUT_POST, 'mdpV')) { //on test la présence des données 
    
    //filtrage des informations obtenues
    $matV = filter_input(INPUT_POST,'matV',FILTER_SANITIZE_STRING);
    $mdpV = filter_input(INPUT_POST,'mdpV',FILTER_SANITIZE_STRING);
    
    login($matV, $mdpV);
    
    if (isLoggedOn()) { // si l'utilisateur est connecté on redirige vers le controleur c_profil
        
        $fichier="controleur/c_Menu.php";
        
    } else { 
        
        $msgErreur="Identifiant ou mot de passe incorrect";
        
        
    
    }
    
}



$titre = "authentification";
require "$racine/vue/fond.html.php";
require_once "$racine/$fichier";
