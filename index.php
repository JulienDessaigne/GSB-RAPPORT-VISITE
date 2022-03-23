<?php
/*
 * Description de index.php
 * 
 * 
 * 
 * 
 */
/**
 * @package ProjectGSB
 * @author Julien Logan
 * @version 04/05/2021
 */

require "getRacine.php";
require "$racine/controleur/controleurPrincipal.php";

if (isset($_GET["action"])){
    $action = $_GET["action"];
}
else{
    
    $action = "defaut";
}

$fichier = controleurPrincipal($action);
include "$racine/controleur/$fichier";