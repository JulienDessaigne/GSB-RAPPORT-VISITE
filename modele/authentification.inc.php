<?php
/*
 * Description de authentification.inc.php
 * 
 * 
 * 
 * 
 */

/**
 * @package ProjectGSB
 * @subpackage modele
 * @author Julien Logan
 * @version 04/05/2021
 * @include bd.visiteur.inc.php
 */

require_once "bd.visiteur.inc.php";
/**
 *Fonctions et procédures concernant l'authentification
 *
 */

/**
 * Procédure login
 * @param string $matV
 * @param string $mdpV
 * @return void
 */
function login(string $matV, string $mdpV) {
    if (!isset($_SESSION)) {
        session_start();
    }
    //recupère les infos du visiteur via la BDD
    $visiteur = getVisiteurByMatV($matV);

    if (isset($visiteur["VIS_MDP"])){
        $mdpBD = $visiteur["VIS_MDP"];
        $mdpV=sha1($mdpV);
    
        if ($mdpBD === $mdpV) {
            // le mot de passe est celui de l'utilisateur dans la base de donnees
            $_SESSION["matV"] = $matV;
            $_SESSION["mdpV"] = $mdpBD;
        }
    }
}
/**
 * Procédure permettant de déconnecter l'utilisateur en supprimant les variables de session
 * @return void
 */
function logout() { // deconnecte en supprimant les variables de session
    if (!isset($_SESSION)) {
        session_start();
    }
    unset($_SESSION["matV"]);
    unset($_SESSION["mdpV"]);
}


/**
 * Procédure vérifiant si un utilisateur est connecté et si les  infos sont compatibles
 * @return boolean
 */

function isLoggedOn() { // vérifie si un utilisateur est connecté et si les infos sont compatibles
    if (!isset($_SESSION)) {
        session_start();
    }
    $ret = false;

    if (isset($_SESSION["matV"])) {
        $visiteur = getVisiteurByMatV($_SESSION["matV"]);
        if ($visiteur["VIS_MATRICULE"] === $_SESSION["matV"] && $visiteur["VIS_MDP"] === $_SESSION["mdpV"]) {
            $ret = true;
        }
    }
    return $ret;
}

?>