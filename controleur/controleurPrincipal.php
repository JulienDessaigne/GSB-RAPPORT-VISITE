<?php

/*
 * Description de controleurPrincipal.php
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
 */
/**
 * Controleur principal
 */
/**
 * Fonction controleur principal
 * @param string $action
 * @return string
 */
session_start();
function controleurPrincipal(string $action){
    $lesActions = array();
    $lesActions["defaut"] = "c_Connexion.php";
    $lesActions["connexion"] = "c_Connexion.php";
    $lesActions["premiereco"] = "c_PremiereCo.php";
    $lesActions["menu"]="c_Menu.php";
    $lesActions["rapport_visite"]="c_Rapport_Visite.php";
    $lesActions["inserer_rapport_visite"]="c_Inserer_Rapport_Visite.php";
    $lesActions["medicaments"]="c_Medicaments.php";
    $lesActions["visiteurs"]="c_Visiteurs.php";
    $lesActions["deconnexion"]="c_Deconnexion.php";
    if (array_key_exists ( $action , $lesActions )){
        return $lesActions[$action];
    }
    else{
        return $lesActions["defaut"];
    }

}